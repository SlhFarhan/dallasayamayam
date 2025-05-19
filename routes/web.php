<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsUser;

// Rute untuk admin
Route::middleware(['auth', IsAdmin::class])->group(function () {
    // Admin Dashboard
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Rute untuk mengelola menu (Admin)
    Route::resource('menus', MenuController::class)->except(['show']);

    // Rute untuk melihat laporan
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

    // Rute untuk melihat daftar pengguna
    Route::get('/userlist', [UserController::class, 'list'])->name('users.list');

    // Rute untuk melihat pesanan (Admin)
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
});

// Rute untuk user
Route::middleware(['auth', IsUser::class])->group(function () {
    // Route untuk user dashboard
    Route::get('/user', function () {
        return view('user.dashboard');
    })->name('user.dashboard');

    // Rute untuk melihat menu (User)
    Route::get('/menususer', [MenuController::class, 'userIndex'])->name('menus.user');
    Route::get('/menus/{menu}', [MenuController::class, 'show'])->name('menus.show');
    Route::get('/menus/category/{category}', [MenuController::class, 'filterByCategory'])->name('menus.filter');

    // Rute untuk keranjang belanja
    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

    // Rute untuk melihat riwayat pesanan
    Route::get('/orders/history', [OrderController::class, 'history'])->name('orders.history');

    // Rute untuk membuat pesanan
    Route::get('/order/create', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/order/store', [OrderController::class, 'store'])->name('orders.store');

    // Rute untuk mengelola alamat
    Route::post('/address', [AddressController::class, 'store'])->name('address.store');
    Route::patch('/address/{address}', [AddressController::class, 'update'])->name('address.update');
    Route::delete('/address/{address}', [AddressController::class, 'destroy'])->name('address.destroy');

    // Rute untuk melihat promo
    Route::get('/promo', [PromoController::class, 'index'])->name('promo.index');

    // Rute untuk melihat kontak
    Route::get('/kontak', function () {
        return view('kontak.index');
    })->name('kontak.index');
});

// Rute untuk login dan logout
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Logout
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

// Rute untuk pembayaran pesanan
Route::get('/orders/{order}/payment', [OrderController::class, 'showPayment'])->name('orders.payment');

// Rute untuk menandai pesanan sebagai terbayar
Route::post('/orders/{order}/mark-paid', [OrderController::class, 'markAsPaid'])->name('orders.markPaid');

// Rute untuk halaman dashboard utama
Route::get('/', function () {
    return view('welcome');
});

// Rute untuk dashboard yang memeriksa role pengguna
Route::get('/dashboard', function () {
    if (Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard'); // Redirect ke halaman admin
    }

    return redirect()->route('user.dashboard'); // Redirect ke halaman user
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
