<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuangan - Dallas Fried Chicken</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Dropdown functionality
            const dropdownButton = document.getElementById('adminDropdownButton');
            const dropdownMenu = document.getElementById('adminDropdownMenu');
            
            dropdownButton.addEventListener('click', function() {
                dropdownMenu.classList.toggle('hidden');
            });
            
            // Close dropdown when clicking outside
            document.addEventListener('click', function(event) {
                if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                    dropdownMenu.classList.add('hidden');
                }
            });
        });
    </script>
</head>
<body class="bg-gray-50">
    <header class="bg-white shadow-md">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-gray-800">
    <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-600 transition duration-300">
        Dallas Fried Chicken Admin
    </a>
</h1>

                <div class="flex items-center space-x-6">
                    <!-- Navigation Links -->
                    <nav class="hidden md:flex space-x-4">
                        <a href="{{ route('menus.index') }}" class="px-3 py-2 text-gray-700 hover:text-blue-600 transition duration-300 {{ request()->routeIs('menus.*') ? 'text-blue-600 font-medium' : '' }}">Kelola Menu</a>
                        <a href="{{ route('users.list') }}" class="px-3 py-2 text-gray-700 hover:text-blue-600 transition duration-300 {{ request()->routeIs('users.*') ? 'text-blue-600 font-medium' : '' }}">User List</a>
                        <a href="{{ route('orders.index') }}" class="px-3 py-2 text-gray-700 hover:text-blue-600 transition duration-300 {{ request()->routeIs('orders.*') ? 'text-blue-600 font-medium' : '' }}">Laporan Pesanan</a>
                        <a href="{{ route('reports.index') }}" class="px-3 py-2 text-gray-700 hover:text-blue-600 transition duration-300 {{ request()->routeIs('reports.*') ? 'text-blue-600 font-medium' : '' }}">Laporan Keuangan</a>
                    </nav>

                    <!-- Dropdown Menu untuk Admin -->
                    <div class="relative">
                        <button id="adminDropdownButton" class="flex items-center space-x-2 text-sm text-gray-600 hover:text-gray-900 focus:outline-none">
                            <span>{{ Auth::user()->name ?? 'Admin' }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div id="adminDropdownMenu" class="hidden absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50">
                            <div class="py-1">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        Log Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="container mx-auto px-6 py-8">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Laporan Keuangan</h1>

        <!-- Filter Tanggal -->
        <div class="mb-8 bg-white p-4 rounded-lg shadow">
            <form method="GET" action="{{ route('reports.index') }}" class="space-y-4 md:space-y-0">
                <div class="flex flex-col md:flex-row md:items-center md:space-x-4 space-y-4 md:space-y-0">
                    <div class="flex-1">
                        <label for="start_date" class="block text-gray-700 text-sm font-medium mb-1">Tanggal Awal:</label>
                        <input type="date" id="start_date" name="start_date" class="w-full border border-gray-300 p-2 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" value="{{ request('start_date') }}" />
                    </div>
                    <div class="flex-1">
                        <label for="end_date" class="block text-gray-700 text-sm font-medium mb-1">Tanggal Akhir:</label>
                        <input type="date" id="end_date" name="end_date" class="w-full border border-gray-300 p-2 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" value="{{ request('end_date') }}" />
                    </div>
                    <div class="self-end">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white p-2 px-4 rounded-md transition duration-300">
                            Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="font-semibold text-gray-800 mb-2">Total Pendapatan</h2>
                <p class="text-green-600 text-2xl font-bold">Rp {{ number_format($totalRevenue, 0) }}</p>
                <p class="text-gray-500 text-sm mt-1">Pendapatan kotor dari penjualan</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="font-semibold text-gray-800 mb-2">Total Pengeluaran</h2>
                <p class="text-red-600 text-2xl font-bold">Rp {{ number_format($totalExpense, 0) }}</p>
                <p class="text-gray-500 text-sm mt-1">Biaya produksi (30% dari pendapatan)</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="font-semibold text-gray-800 mb-2">Laba Bersih</h2>
                <p class="text-blue-600 text-2xl font-bold">Rp {{ number_format($netProfit, 0) }}</p>
                <p class="text-gray-500 text-sm mt-1">Pendapatan bersih setelah pengeluaran</p>
            </div>
        </div>

        <!-- Tabel Laporan Keuangan Per Pesanan -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Detail Per Pesanan</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No Pesanan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pendapatan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pengeluaran</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Laba</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($orders as $order)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#{{ $order->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $order->created_at->format('d M Y H:i') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600 font-medium">Rp {{ number_format($order->total_harga, 0) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-red-600 font-medium">Rp {{ number_format(0.3 * $order->total_harga, 0) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-600 font-medium">Rp {{ number_format($order->total_harga - (0.3 * $order->total_harga), 0) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">Tidak ada data untuk periode ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
        
        </div>
    </main>
</body>
</html>