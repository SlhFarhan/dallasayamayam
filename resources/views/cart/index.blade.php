<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Keranjang Belanja</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>
<body class="bg-gray-50">
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

    <div class="max-w-5xl mx-auto py-8 px-4 sm:px-6">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Keranjang Belanja</h1>
            <a href="{{ route('menus.user') }}" class="text-blue-600 hover:text-blue-800 transition flex items-center">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Menu
            </a>
        </div>

        @if(session('cart') && count($cart))
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="grid grid-cols-12 bg-gray-100 px-6 py-3 font-semibold text-gray-700 hidden md:grid">
                    <div class="col-span-5">Produk</div>
                    <div class="col-span-2 text-center">Harga</div>
                    <div class="col-span-2 text-center">Jumlah</div>
                    <div class="col-span-2 text-center">Subtotal</div>
                </div>
                
                <div class="divide-y divide-gray-200">
    @php $grandTotal = 0; @endphp
    @foreach($cart as $id => $item)
        @php
            $total = $item['price'] * $item['quantity'];
            $grandTotal += $total;
        @endphp
        <div class="cart-item grid grid-cols-1 md:grid-cols-12 items-center px-4 py-6 md:px-6">
            <div class="col-span-5 flex items-center mb-4 md:mb-0">
                <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" class="w-20 h-20 rounded-lg object-cover border border-gray-200">
                <div class="ml-4">
                    <h3 class="font-medium text-gray-800">{{ $item['name'] }}</h3>
                    <p class="text-sm text-gray-500 md:hidden">Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                </div>
            </div>
            
            <div class="col-span-2 text-center hidden md:block">
                <p class="text-gray-700">Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
            </div>
            
            <div class="col-span-2 flex justify-center my-4 md:my-0">
                <div class="flex items-center border border-gray-300 rounded-lg">
                    <!-- Form to decrease the quantity -->
                    <form action="{{ route('cart.update', ['id' => $id, 'quantity' => $item['quantity'] - 1]) }}" method="POST" class="quantity-btn">
                        @csrf
                        <button type="submit" class="px-3 py-1 text-gray-600 hover:bg-gray-100 rounded-l-lg" @if($item['quantity'] <= 1) disabled @endif>
                            <i class="fas fa-minus"></i>
                        </button>
                    </form>

                    <!-- Quantity Display -->
                    <span class="w-12 text-center text-gray-800 bg-white border-gray-300 rounded-lg">{{ $item['quantity'] }}</span>

                    <!-- Form to increase the quantity -->
                    <form action="{{ route('cart.update', ['id' => $id, 'quantity' => $item['quantity'] + 1]) }}" method="POST" class="quantity-btn">
                        @csrf
                        <button type="submit" class="px-3 py-1 text-gray-600 hover:bg-gray-100 rounded-r-lg">
                            <i class="fas fa-plus"></i>
                        </button>
                    </form>
                </div>
            </div>
            
            <div class="col-span-2 text-center font-medium text-gray-800 hidden md:block">
                Rp {{ number_format($total, 0, ',', '.') }}
            </div>
            
            <div class="col-span-1 flex justify-end">
                <!-- Optional space for remove button (already inside form) -->
            </div>
            
            <!-- Mobile view for subtotal -->
            <div class="col-span-12 md:hidden flex justify-between items-center mt-4 pt-4 border-t border-gray-200">
                <span class="font-medium text-gray-800">Subtotal</span>
                <span class="font-medium text-gray-800">Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>
        </div>
    @endforeach
</div>


            <div class="mt-8 flex flex-col sm:flex-row justify-between items-center">
                <a href="{{ route('menus.user') }}" class="text-blue-600 hover:text-blue-800 transition flex items-center mb-4 sm:mb-0">
                    <i class="fas fa-arrow-left mr-2"></i> Lanjutkan Belanja
                </a>
                <a href="{{ route('orders.create') }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg shadow-md hover:shadow-lg transition flex items-center">
                    <span>Lanjut ke Pembayaran</span>
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        @else
            <div class="bg-white p-8 rounded-lg shadow text-center">
                <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-shopping-cart text-gray-400 text-3xl"></i>
                </div>
                <h3 class="text-xl font-medium text-gray-800 mb-2">Keranjang Anda kosong</h3>
                <p class="text-gray-600 mb-6">Mulai belanja dan tambahkan menu favorit Anda</p>
                <a href="{{ route('menus.user') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition">
                    Lihat Menu
                </a>
            </div>
        @endif
    </div>

    <script>
        // Dropdown toggle
        const userMenuButton = document.getElementById('userMenuButton');
        const userDropdown = document.getElementById('userDropdown');

        userMenuButton.addEventListener('click', () => {
            const isHidden = userDropdown.classList.contains('hidden');
            
            if (isHidden) {
                userDropdown.classList.remove('hidden', 'opacity-0', 'scale-95');
                userDropdown.classList.add('opacity-100', 'scale-100');
            } else {
                userDropdown.classList.add('hidden', 'opacity-0', 'scale-95');
                userDropdown.classList.remove('opacity-100', 'scale-100');
            }
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', (e) => {
            if (!userMenuButton.contains(e.target) && !userDropdown.contains(e.target)) {
                userDropdown.classList.add('hidden', 'opacity-0', 'scale-95');
                userDropdown.classList.remove('opacity-100', 'scale-100');
            }
        });
    </script>
</body>
</html>
