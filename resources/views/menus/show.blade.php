<!-- resources/views/menus/show.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Detail Menu</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
<nav class="bg-gray-300 sticky top-0 z-30 shadow-md">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-20 items-center">
      <div class="flex-shrink-0">
        <a href="{{ route('user.dashboard') }}">
          <img src="{{ asset('storage/images/logo.png') }}" class="h-16" alt="Logo" />
        </a>
      </div>

      <div class="hidden md:flex space-x-12">
        <a href="{{ route('menus.user') }}" class="text-black font-semibold hover:underline">Menu</a>
        <a href="{{ route('promo.index') }}" class="text-black font-semibold hover:underline">Promo</a>
        <a href="#" class="text-black font-semibold hover:underline">Kontak</a>
      </div>

      @auth
      <div class="flex items-center space-x-4 relative">
        @php
        $cart = session()->get('cart');
        $cartCount = $cart ? array_sum(array_column($cart, 'quantity')) : 0;
        @endphp

        <a href="{{ route('cart.index') }}" class="relative text-black hover:text-gray-700">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 
              1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 
              0 2 2 0 014 0z" />
          </svg>
          @if($cartCount > 0)
          <span
            class="absolute -top-2 -right-2 bg-red-600 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">{{
            $cartCount }}</span>
          @endif
        </a>


        </a>

        <div class="relative inline-block text-left">
          <button id="userMenuButton" class="text-black font-semibold hover:underline focus:outline-none">
            {{ Auth::user()->name }}
          </button>

          <div id="userDropdown"
            class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden z-40">
            <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="userMenuButton">
              <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                role="menuitem">Profile</a>
              <a href="{{ route('orders.history') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                role="menuitem">Riwayat Pesanan</a>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                  role="menuitem">
                  Logout
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
      @else
      <a href="{{ route('login') }}" class="text-black font-semibold hover:underline">Login</a>
      @endauth
    </div>
  </div>
</nav>
<div class="max-w-xl mx-auto p-4">
    <h2 class="text-xl font-bold mb-4">{{ $menu->name }}</h2>

    @if ($menu->image)
        <img src="{{ asset('storage/' . $menu->image) }}" class="w-32 h-32 object-cover rounded mb-4">
    @endif

    <p><strong>Kategori:</strong> {{ $menu->category }}</p>
    <p><strong>Deskripsi:</strong> {{ $menu->description }}</p>
    <p><strong>Harga:</strong> Rp {{ number_format($menu->price, 0, ',', '.') }}</p>

    <a href="{{ route('menus.index') }}" class="mt-4 inline-block text-blue-600">← Kembali ke daftar</a>
</div>


</body>
</html>
