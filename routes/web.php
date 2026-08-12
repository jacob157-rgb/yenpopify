<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\FrontendTransaksiController;
use App\Http\Controllers\FrontendHistoriController;
use App\Http\Controllers\FrontendPembayaranController;
use App\Http\Controllers\DashboardController;

Route::get('/cek', function () {
    return view('welcome');
});

Route::get('/', [FrontendController::class, 'index'])->name('frontend.index');

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

    Route::resource('user', UserController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('produk', ProdukController::class);   // aman, tidak tabrakan
    Route::resource('transaksi', TransaksiController::class);
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/admin/transaksi/{id}/cetak', [TransaksiController::class, 'cetak'])
    ->name('transaksi.cetak');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    // detail produk (frontend)
    Route::get('/produk/{id}', [FrontendController::class, 'show'])
        ->name('frontend.produk.show');
    // kategori produk (frontend)
    Route::get('/kategori/{id}', [FrontendController::class, 'kategori'])
        ->name('frontend.kategori');

    Route::get('/cart', [FrontendController::class, 'index'])->name('frontend.cart');
    Route::post('/cart/add', [FrontendController::class, 'add'])->name('frontend.cart.add');
    Route::post('/transaksi/store-frontend', [FrontendTransaksiController::class, 'store'])
    ->name('frontend.transaksi.store');
    Route::get('/histori', [FrontendHistoriController::class, 'index'])
        ->name('frontend.histori.index');

    Route::post('/histori/{id}/upload', [FrontendHistoriController::class, 'uploadFile'])
        ->name('frontend.histori.upload');

Route::delete('/histori/file/{id}', [FrontendHistoriController::class, 'deleteFile'])
    ->name('frontend.histori.file.delete');

});
Route::post('/admin/transaksi/{id}/approve', [TransaksiController::class, 'approve'])
    ->name('admin.transaksi.approve');

Route::post('/admin/transaksi/{id}/reject', [TransaksiController::class, 'reject'])
    ->name('admin.transaksi.reject');

Route::get('/pembayaran/{transaksi}', [FrontendPembayaranController::class, 'show'])
    ->name('frontend.pembayaran.show');

Route::post('/pembayaran/{transaksi}/confirm', [FrontendPembayaranController::class, 'confirm'])
    ->name('frontend.pembayaran.confirm');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');



