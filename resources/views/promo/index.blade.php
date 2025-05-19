<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Promo - Dallas Fried Chicken</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
<nav class="bg-white sticky top-0 z-30 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">
            <div class="flex-shrink-0">
                <a href="{{ route('user.dashboard') }}">
                    <img src="{{ asset('storage/images/logo.png') }}" class="h-16" alt="Logo" />
                </a>
            </div>

            <div class="hidden md:flex space-x-12">
                <a href="{{ route('menus.user') }}" class="text-gray-700 font-medium hover:text-blue-600 transition">Menu</a>
                <a href="{{ route('promo.index') }}" class="text-gray-700 font-medium hover:text-blue-600 transition">Promo</a>
                <a href="{{ route('kontak.index') }}" class="text-gray-700 font-medium hover:text-blue-600 transition">Kontak</a>
            </div>

            @auth
            <div class="flex items-center space-x-6 relative">
                @php
                $cart = session()->get('cart');
                $cartCount = $cart ? array_sum(array_column($cart, 'quantity')) : 0;
                @endphp

                <a href="{{ route('cart.index') }}" class="relative text-gray-700 hover:text-blue-600 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 
                        1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 
                        0 2 2 0 014 0z" />
                    </svg>
                    @if($cartCount > 0)
                    <span
                        class="absolute -top-2 -right-2 bg-blue-600 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center animate-bounce">{{ $cartCount }}</span>
                    @endif
                </a>

                <div class="relative inline-block text-left">
                    <button id="userMenuButton" class="flex items-center space-x-1 text-gray-700 hover:text-blue-600 transition focus:outline-none">
                        <span class="font-medium">{{ Auth::user()->name }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div id="userDropdown"
                        class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden z-40 transition-all duration-200 transform opacity-0 scale-95">
                        <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="userMenuButton">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition"
                            role="menuitem"><i class="fas fa-user-circle mr-2"></i>Profile</a>
                            <a href="{{ route('orders.history') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition"
                            role="menuitem"><i class="fas fa-history mr-2"></i>Riwayat Pesanan</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition"
                                role="menuitem">
                                    <i class="fas fa-sign-out-alt mr-2"></i>Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <a href="{{ route('login') }}" class="text-gray-700 font-medium hover:text-blue-600 transition">Login</a>
            @endauth
        </div>
    </div>
</nav>
    <div class="max-w-7xl mx-auto py-10 px-4">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Promo Menarik Untuk Anda!</h1>

        @if($promos->isEmpty())
            <p class="text-gray-600">Belum ada promo tersedia saat ini.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($promos as $promo)
                    <div class="bg-white rounded-lg shadow p-4">
                    <div class="bg-white rounded-lg shadow p-4">
    <img src="{{ asset('storage/' . $promo->image) }}" alt="{{ $promo->name }}" class="w-full h-40 object-cover rounded-md mb-4">
    <h2 class="text-lg font-semibold text-gray-800">{{ $promo->name }}</h2>
    <p class="text-gray-800 line-through text-sm">Rp {{ number_format($promo->price * 1.2, 0, ',', '.') }}</p>
    <p class="text-gray-500 font semibold">Rp {{ number_format($promo->price, 0, ',', '.') }}</p>
    <p class="text-sm text-gray-500 mt-2">{{ $promo->description }}</p>
</div>

<form action="{{ route('cart.add', $promo->id) }}" method="POST" class="mt-4">
    @csrf
    <input type="hidden" name="quantity" value="1">
    <button type="submit"
        class="w-full bg-yellow-500 hover:bg-yellow-600 text-white py-2 px-4 rounded-lg font-semibold transition duration-300">
        Tambah ke Keranjang
    </button>
</form>

                    </div>
                @endforeach
            </div>
        @endif
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const userMenuButton = document.getElementById('userMenuButton');
        const userDropdown = document.getElementById('userDropdown');

        // Pastikan elemen yang diperlukan ada
        if (userMenuButton && userDropdown) {
            // Event untuk toggle dropdown saat tombol diklik
            userMenuButton.addEventListener('click', function (event) {
                event.stopPropagation(); // Cegah event klik menyebar ke luar
                userDropdown.classList.toggle('hidden'); // Toggle visibilitas dropdown
                userDropdown.classList.toggle('opacity-100'); // Tambahkan efek transisi opasitas
                userDropdown.classList.toggle('scale-100'); // Tambahkan efek transisi skala
            });

            // Event untuk menutup dropdown saat klik di luar
            window.addEventListener('click', function (e) {
                // Tutup dropdown hanya jika klik terjadi di luar tombol atau dropdown
                if (!userMenuButton.contains(e.target) && !userDropdown.contains(e.target)) {
                    userDropdown.classList.add('hidden');
                    userDropdown.classList.remove('opacity-100', 'scale-100'); // Menghapus efek transisi saat menutup
                }
            });
        }
    });
</script>


</body>
</html>
