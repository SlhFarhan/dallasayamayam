<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Dallas Fried Chicken</title>
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

<div class="bg-white py-8 sm:py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"> 
      <div class="bg-gray-800 rounded-2xl shadow-xl overflow-hidden relative">
        <div class="h-64 sm:h-96 w-full bg-gray-900 relative overflow-hidden">
        <img src="{{ asset('storage/images/banner2.jpg') }}" alt="" class="absolute inset-0 w-full h-full object-cover object-center">
        </div>
      </div>
    </div>
  </div>
  
  <!-- banner promo -->
  <div class="bg-white py-2 sm:py-4">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
      <div class="mx-auto max-w-2xl lg:mx-0">
        <h2 class="text-4xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-1xl">Promo dan Paket Unggulan Dallas Friend Chicken</h2>
        <!-- Added text/link below the heading -->
        <div class="mt-4">
          <a href="{{ route('promo.index') }}" class="text-blue-600 hover:text-blue-800 font-medium inline-flex items-center">
            Lihat Menu Promo Dallas Fried Chicken
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
          </a>
        </div>
      </div>
  
      <div class="mx-auto mt-6 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-12 sm:mt-8 lg:mx-0 lg:max-w-none lg:grid-cols-3"> <!-- Menyesuaikan margin-top -->
        <!-- Blog Post 1 -->
        <article class="flex flex-col items-start">
            <div class="relative w-full aspect-[16/9]">
              <img src="{{ asset('storage/images/promo_burger.png') }}" 
                  alt="Sales meeting" 
                  class="w-full h-full rounded-2xl object-cover">
            </div>
            <div class="flex items-center gap-x-4 mt-4 text-sm">
              <time datetime="2020-03-10" class="text-gray-500">Mar 10, 2020</time>
              <span class="relative z-10 rounded-full bg-gray-100 px-3 py-1.5 font-medium text-gray-600">Burger</span>
            </div>
          </article>
  
        <!-- Blog Post 2 -->
          <article class="flex flex-col items-start">
            <div class="relative w-full aspect-[16/9]">
              <img src="{{ asset('storage/images/promo_ayam.png') }}" 
                  alt="Sales meeting" 
                  class="w-full h-full rounded-2xl object-cover">
            </div>
            <div class="flex items-center gap-x-4 mt-4 text-sm">
              <time datetime="2020-03-10" class="text-gray-500">Mar 10, 2020</time>
              <span class="relative z-10 rounded-full bg-gray-100 px-3 py-1.5 font-medium text-gray-600">Fried Chicken</span>
            </div>
          </article>

  
        <!-- Blog Post 3 -->
          <article class="flex flex-col items-start">
            <div class="relative w-full aspect-[16/9]">
              <img src="{{ asset('storage/images/promo_nugget.png') }}" 
                  alt="Sales meeting" 
                  class="w-full h-full rounded-2xl object-cover">
            </div>
            <div class="flex items-center gap-x-4 mt-4 text-sm">
              <time datetime="2020-03-10" class="text-gray-500">Mar 10, 2020</time>
              <span class="relative z-10 rounded-full bg-gray-100 px-3 py-1.5 font-medium text-gray-600">Nugget</span>
            </div>
          </article>
      </div>
    </div>
  </div>

  
  <div class="bg-white py-2 sm:py-4"> <!-- Mengurangi padding di sini -->
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
      <div class="mx-auto max-w-2xl lg:mx-0">
        <h2 class="text-4xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-1xl">Cara Pesan di Dallas Fried Chicken</h2>
        <div class="mt-4">
            <a href="{{ route('menus.user') }}" class="text-blue-600 hover:text-blue-800 font-medium inline-flex items-center">
              Pilih menu sekarang
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
              </svg>
            </a>
          </div>
      </div>
    </div>
    <div class="bg-white py-8 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"> 
          <div class="bg-gray-800 rounded-2xl shadow-xl overflow-hidden relative">
            <div class="w-full overflow-hidden">
                <img 
                src="{{ asset('storage/images/deliv2.jpg') }}"  
                  alt="Delivery Process"
                  class="w-full min-h-[300px] object-scale-down" >
              </div>
          </div>
        </div>
      </div>
</div>

<footer class="bg-white py-12">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
      <div class="flex flex-col items-center justify-center gap-8">
        <!-- Navigation Links -->
        <nav class="flex flex-wrap justify-center gap-6">
          <a href="#" class="text-sm font-medium text-gray-600 hover:text-gray-900">About</a>
          <a href="#" class="text-sm font-medium text-gray-600 hover:text-gray-900">Blog</a>
          <a href="#" class="text-sm font-medium text-gray-600 hover:text-gray-900">Jobs</a>
          <a href="#" class="text-sm font-medium text-gray-600 hover:text-gray-900">Press</a>
          <a href="#" class="text-sm font-medium text-gray-600 hover:text-gray-900">Accessibility</a>
          <a href="#" class="text-sm font-medium text-gray-600 hover:text-gray-900">Partners</a>
        </nav>
  
        <!-- Copyright -->
        <p class="text-sm text-gray-500">© 2024 Dallas Fried Chicken, Inc. All rights reserved.</p>
  
        <!-- Get the Code Button -->
        <a href="#" class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-800">
          Get the code
          <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
          </svg>
        </a>
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


