<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class CartController extends Controller
{
    public function add(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $menu->name,
                "quantity" => 1,
                "price" => $menu->price,
                "image" => $menu->image
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Menu berhasil ditambahkan ke keranjang!');
    }

    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

   public function update(Request $request)
{
    if ($request->id && $request->quantity) {
        $cart = session()->get('cart', []);

        // Pastikan quantity yang dimasukkan valid
        if ($request->quantity > 0) {
            // Jika item sudah ada di keranjang, update jumlahnya
            if (isset($cart[$request->id])) {
                $cart[$request->id]["quantity"] = $request->quantity;
                session()->put('cart', $cart);
                session()->flash('success', 'Keranjang berhasil diperbarui!');
            } else {
                // Jika item belum ada di keranjang, tambahkan sebagai item baru
                $item = [
                    'name' => $request->name, // Pastikan untuk mengirimkan nama produk
                    'price' => $request->price, // Pastikan untuk mengirimkan harga produk
                    'image' => $request->image, // Pastikan untuk mengirimkan gambar produk
                    'quantity' => $request->quantity
                ];
                $cart[$request->id] = $item;
                session()->put('cart', $cart);
                session()->flash('success', 'Item baru berhasil ditambahkan ke keranjang!');
            }
        } else {
            session()->flash('error', 'Jumlah tidak valid!');
        }
    }

    return redirect()->route('cart.index');
}


    public function remove(Request $request)
    {
        if ($request->has('id')) {
            $cart = session()->get('cart', []);
    
            // Cek apakah item ada di dalam keranjang
            if (isset($cart[$request->id])) {
                // Hapus item dari keranjang
                unset($cart[$request->id]);
    
                // Simpan kembali keranjang setelah penghapusan
                session()->put('cart', $cart);
    
                session()->flash('success', 'Menu berhasil dihapus dari keranjang!');
            } else {
                session()->flash('error', 'Item tidak ditemukan di keranjang!');
            }
        } else {
            session()->flash('error', 'ID item tidak ditemukan!');
        }
    
        return redirect()->route('cart.index');
    }
    
}
