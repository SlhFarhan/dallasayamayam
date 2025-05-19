<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans antialiased">

<!-- Main Container -->
<div class="min-h-screen flex flex-col">
    <!-- Header -->
    <header class="bg-white shadow-md px-6 py-4">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-gray-800">Selamat datang di halaman Admin!</h1>

            <!-- Dropdown Menu untuk Admin -->
            <div class="relative">
                <button id="adminDropdownButton" class="flex items-center space-x-2 text-sm text-gray-600 hover:text-gray-900 focus:outline-none">
                    <span>{{ Auth::user()->name ?? 'Admin' }}</span> <!-- Nama Admin -->
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
    </header>

    <!-- Dashboard Content -->
    <div class="py-6 px-8 bg-white flex-grow">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Data Statistik Admin</h2>
        <p class="text-sm text-gray-600 mb-6">Berikut adalah berbagai informasi dan kontrol untuk administrator.</p>

        <!-- Admin Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Total Pesanan -->
            <div class="bg-blue-50 p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold text-gray-800">Laporan Pesanan</h3>
                <p class="mt-2 text-sm text-gray-600">Jumlah total pesanan yang diterima selama ini.</p>
                <a href="{{ route('orders.index') }}" class="text-blue-500 hover:underline text-sm mt-2 inline-block">Lihat pesanan</a>
            </div>

            <!-- Total Pengguna -->
            <div class="bg-green-50 p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold text-gray-800">Total Pengguna</h3>
                <p class="mt-2 text-sm text-gray-600">Jumlah pengguna yang terdaftar di sistem.</p>
                <a href="{{ route('users.list') }}" class="text-blue-500 hover:underline text-sm mt-2 inline-block">Kelola pengguna</a>
            </div>

            <!-- Laporan Keuangan -->
            <div class="bg-yellow-50 p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold text-gray-800">Laporan Keuangan</h3>
                <p class="mt-2 text-sm text-gray-600">Laporan keuangan terbaru dari sistem admin.</p>
                <a href="{{ route('reports.index') }}" class="text-blue-500 hover:underline text-sm mt-2 inline-block">Lihat laporan</a>
            </div>

            <!-- Total Menu -->
            <div class="bg-purple-50 p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold text-gray-800">Kelola Menu</h3>
                <p class="mt-2 text-sm text-gray-600">Jumlah dan daftar menu makanan yang tersedia.</p>
                <a href="{{ route('menus.index') }}" class="text-blue-500 hover:underline text-sm mt-2 inline-block">Lihat semua menu</a>
            </div>
        </div>
    </div>
</div>

<!-- Script untuk dropdown -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const button = document.getElementById('adminDropdownButton');
        const menu = document.getElementById('adminDropdownMenu');

        button.addEventListener('click', function (e) {
            e.stopPropagation();
            menu.classList.toggle('hidden');
        });

        // Klik di luar dropdown akan menutupnya
        window.addEventListener('click', function () {
            if (!menu.classList.contains('hidden')) {
                menu.classList.add('hidden');
            }
        });

        // Cegah form dalam dropdown dari menutup menu saat diklik
        menu.addEventListener('click', function (e) {
            e.stopPropagation();
        });
    });
</script>

</body>
</html>
