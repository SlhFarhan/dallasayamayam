<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak Kami</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-200">
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
    
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Hubungi Dallas Fried Chicken</h1>
            <p class="text-xl text-gray-600">Kami siap melayani Anda dengan sepenuh hati</p>
        </div>

        <!-- Profile Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-16">
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Profil Kami</h2>
                    <div class="prose prose-lg text-gray-600">
                        <p>Dallas Fried Chicken adalah restoran ayam goreng kekinian yang menghadirkan cita rasa Amerika dengan sentuhan rempah-rempah Indonesia.</p>
                        <p>Berdiri sejak 2015, kami telah berkembang menjadi salah satu jaringan restoran ayam goreng terfavorit di Indonesia dengan lebih dari 50 outlet di seluruh negeri.</p>
                        <p>Komitmen kami adalah menyajikan ayam goreng dengan kualitas terbaik, menggunakan bahan-bahan pilihan dan proses memasak yang higienis.</p>
                    </div>
                </div>
                <div class="bg-gray-100 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Jam Operasional</h3>
                    <ul class="space-y-2">
                        <li class="flex justify-between">
                            <span class="text-gray-600">Senin - Jumat</span>
                            <span class="font-medium">09:00 - 22:00</span>
                        </li>
                        <li class="flex justify-between">
                            <span class="text-gray-600">Sabtu - Minggu</span>
                            <span class="font-medium">10:00 - 23:00</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Kontak Kami</h2>
                    <div class="space-y-6">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 bg-red-100 rounded-lg p-3">
                                <i class="fas fa-map-marker-alt text-red-600 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-gray-900">Alamat</h3>
                                <p class="mt-1 text-gray-600">Jl. Raya Batujajar, Bandung Barat 40561</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="flex-shrink-0 bg-red-100 rounded-lg p-3">
                                <i class="fas fa-phone-alt text-red-600 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-gray-900">Telepon</h3>
                                <p class="mt-1 text-gray-600">0812-3456-7890 (WhatsApp)</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="flex-shrink-0 bg-red-100 rounded-lg p-3">
                                <i class="fas fa-envelope text-red-600 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-gray-900">Email</h3>
                                <p class="mt-1 text-gray-600">info@dallasfriedchicken.com</p>
                                <p class="mt-1 text-gray-600">cs@dallasfriedchicken.com</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Social Media Section -->
        

        <!-- Developer Credits -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Tim Pengembang</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <img src="https://via.placeholder.com/80" alt="Developer" class="h-20 w-20 rounded-full">
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900">Mochammad Tontowi Jauhari</h3>
                            <p class="text-gray-600"></p>
                            <div class="mt-2 flex space-x-4">
                                <a href="#" class="text-gray-500 hover:text-gray-700">
                                    <i class="fab fa-github"></i>
                                </a>
                                <a href="#" class="text-gray-500 hover:text-gray-700">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="#" class="text-gray-500 hover:text-gray-700">
                                    <i class="fas fa-globe"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <img src="https://via.placeholder.com/80" alt="Developer" class="h-20 w-20 rounded-full">
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900">Farhan Solih</h3>
                            <p class="text-gray-600"></p>
                            <div class="mt-2 flex space-x-4">
                                <a href="#" class="text-gray-500 hover:text-gray-700">
                                    <i class="fab fa-github"></i>
                                </a>
                                <a href="#" class="text-gray-500 hover:text-gray-700">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="#" class="text-gray-500 hover:text-gray-700">
                                    <i class="fas fa-globe"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <p>&copy; 2023 Dallas Fried Chicken. All rights reserved.</p>
            </div>
        </div>
    </footer>

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