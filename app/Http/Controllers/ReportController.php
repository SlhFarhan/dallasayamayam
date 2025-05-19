<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // Ambil parameter tanggal dari request
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Query untuk mendapatkan data pesanan berdasarkan rentang tanggal
        $query = Order::where('status', 'selesai');  // Hanya ambil pesanan yang selesai

        if ($startDate) {
            $query->whereDate('created_at', '>=', $startDate);
        }
        if ($endDate) {
            $query->whereDate('created_at', '<=', $endDate);
        }

        // Ambil data pesanan
        $orders = $query->get();

        // Hitung total pendapatan, pengeluaran, dan laba
        $totalRevenue = $orders->sum('total_harga');
        $totalExpense = 0.3 * $totalRevenue; // misal 30% pengeluaran
        $netProfit = $totalRevenue - $totalExpense;

        // Kirim data ke view
        return view('reports.index', compact('orders', 'totalRevenue', 'totalExpense', 'netProfit'));
    }
}
