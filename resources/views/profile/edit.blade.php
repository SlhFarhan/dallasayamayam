<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <!-- Navigation -->
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
                        <span class="absolute -top-2 -right-2 bg-blue-600 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center animate-bounce">{{ $cartCount }}</span>
                        @endif
                    </a>

                    <div class="relative inline-block text-left">
                        <button id="userMenuButton" class="flex items-center space-x-1 text-gray-700 hover:text-blue-600 transition focus:outline-none">
                            <span class="font-medium">{{ Auth::user()->name }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div id="userDropdown" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden z-40 transition-all duration-200 transform opacity-0 scale-95">
                            <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="userMenuButton">
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition" role="menuitem"><i class="fas fa-user-circle mr-2"></i>Profile</a>
                                <a href="{{ route('orders.history') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition" role="menuitem"><i class="fas fa-history mr-2"></i>Riwayat Pesanan</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition" role="menuitem">
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

    <!-- Main Content -->
    <main class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6 px-4 sm:px-0">
                <h1 class="text-2xl font-bold text-gray-800">Edit Profil</h1>
            </div>

            <!-- Profile Information -->
            <div class="bg-white shadow rounded-lg overflow-hidden mb-6">
                <div class="p-6">
                    <h2 class="text-lg font-medium text-gray-800 mb-4">Informasi Profil</h2>
                    <form method="post" action="{{ route('profile.update') }}" class="space-y-4">
                        @csrf
                        @method('patch')

                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                Simpan Perubahan
                            </button>

                            @if (session('status') === 'profile-updated')
                            <p class="text-sm text-green-600">Profil berhasil diperbarui.</p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <!-- Update Password -->
        

            <!-- Address Management -->
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <div class="p-6">
                    <h2 class="text-lg font-medium text-gray-800 mb-4">Kelola Alamat Anda</h2>

                    @if ($addresses->isEmpty())
                    <p class="text-gray-600 mb-4">Anda belum memiliki alamat. Silakan tambah alamat baru.</p>
                    @else
                    <ul class="divide-y divide-gray-200 mb-6">
                        @foreach ($addresses as $address)
                        <li class="py-4 flex justify-between items-center">
                            <span class="text-gray-800">{{ $address->alamat }}</span>
                            <form action="{{ route('address.destroy', $address) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 text-sm">
                                    <i class="fas fa-trash-alt"></i> Hapus
                                </button>
                            </form>
                        </li>
                        @endforeach
                    </ul>
                    @endif

                    <h3 class="text-md font-medium text-gray-800 mb-2">Tambah Alamat Baru</h3>
                    <form action="{{ route('address.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                            <textarea name="alamat" id="alamat" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Masukkan alamat lengkap" required></textarea>
                        </div>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            <i class="fas fa-plus mr-2"></i> Tambah Alamat
                        </button>
                    </form>
                </div>
            </div>

            <!-- Delete Account -->
            <div class="bg-white shadow rounded-lg overflow-hidden mt-6">
                <div class="p-6">
                    <h2 class="text-lg font-medium text-gray-800 mb-4">Hapus Akun</h2>
                    <p class="text-sm text-gray-600 mb-4">Setelah akun Anda dihapus, semua data akan dihapus secara permanen.</p>
                    <form method="POST" action="{{ route('profile.destroy') }}">
    @csrf
    @method('DELETE')

    <label for="password" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
    <input type="password" name="password" id="password" required class="mt-1 block w-full px-4 py-2 border rounded-md">

    @error('userDeletion.password')
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
    @enderror

    <button type="submit" class="mt-4 bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
        Hapus Akun
    </button>
</form>

                </div>
            </div>
        </div>
    </main>

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
