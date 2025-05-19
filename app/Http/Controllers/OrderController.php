<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;
use Midtrans\Snap;
use Midtrans\Config;
use Illuminate\Support\Facades\Log; // Perbaiki di sini

class OrderController extends Controller
{
    public function create()
    {
        $cart = session()->get('cart', []);
        return view('orders.create', compact('cart'));
    }

    public function store(Request $request)
{
    $request->validate([
        'alamat' => 'required|string|max:255',
        'no_hp' => 'required|string|max:20',
    ]);

    $cart = session()->get('cart', []);
    if (empty($cart)) {
        return redirect()->route('cart.index')->with('error', 'Keranjang kosong.');
    }

    $order = Order::create([
        'user_id' => Auth::id(),
        'alamat' => $request->alamat,
        'no_hp' => $request->no_hp,
        'total_harga' => array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart)),
        'status' => 'Pembayaran Gagal'
    ]);

    foreach ($cart as $menuId => $item) {
        OrderItem::create([
            'order_id' => $order->id,
            'menu_id' => $menuId,
            'quantity' => $item['quantity'],
            'price' => $item['price'],
        ]);
    }

    session()->forget('cart');

    return redirect()->route('orders.payment', $order->id); // 🔁 Ganti route redirect
}


public function showPayment($orderId)
{
    $order = Order::findOrFail($orderId);

    Config::$serverKey = config('services.midtrans.server_key');
    Config::$isProduction = config('services.midtrans.is_production');
    Config::$isSanitized = true;
    Config::$is3ds = true;

    $params = [
        'transaction_details' => [
            'order_id' => $order->id,
            'gross_amount' => $order->total_harga,
        ],
        'customer_details' => [
            'first_name' => $order->user->name,
            'email' => $order->user->email,
        ],
    ];

    $snapToken = Snap::getSnapToken($params);

    return view('orders.payment', compact('order', 'snapToken'));
}


    
public function history()
{
    // Memperbarui status pesanan yang sudah lebih dari 15 menit dan tidak memiliki status "Pembayaran Gagal"
    $ordersToUpdate = Order::where('status', '!=', 'selesai')
                           ->where('status', '!=', 'Pembayaran Gagal') // Pastikan tidak diubah jika statusnya "Pembayaran Gagal"
                           ->where('created_at', '<', now()->subMinutes(15))
                           ->get();

    foreach ($ordersToUpdate as $order) {
        $order->status = 'selesai';
        $order->save();
    }

    // Memperbarui status pesanan yang sudah lebih dari 2 menit dan masih "disiapkan" dan tidak memiliki status "Pembayaran Gagal"
    $ordersToUpdate = Order::where('status', 'disiapkan')
                           ->where('status', '!=', 'Pembayaran Gagal') // Pastikan tidak diubah jika statusnya "Pembayaran Gagal"
                           ->where('created_at', '<', now()->subMinutes(2))
                           ->get();

    foreach ($ordersToUpdate as $order) {
        $order->status = 'diantarkan';
        $order->save();
    }

    // Mengambil data pesanan yang akan ditampilkan
    $orders = auth()->user()->orders;  // Menampilkan pesanan milik user yang sedang login

    return view('orders.history', compact('orders'));
}



public function markAsPaid(Request $request, Order $order)
{
    if ($order->status === 'Pembayaran Gagal') {
        $order->status = 'disiapkan'; // atau langsung ke 'selesai' kalau kamu mau
        $order->save();
    }

    return response()->json(['message' => 'Order status updated to disiapkan']);
}

    public function index()
    {
        // Ambil semua pesanan (atau bisa ditambahkan pagination)
        $orders = Order::latest()->get();

        return view('orders.index', compact('orders'));
    }
    
}
