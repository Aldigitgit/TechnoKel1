<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\dashboardcontroller;
use App\Http\Controllers\PelangganController;

// ========== ROUTE TANPA MIDDLEWARE (PUBLIC) ==========
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register/kirim', [AuthController::class, 'kirimregister'])->name('kirimregister');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login/kirim', [AuthController::class, 'kirimlogin'])->name('kirimlogin');

// ========== ROUTE YANG MEMERLUKAN LOGIN ==========
Route::group(['middleware' => ['checkislogin']], function () {
    
    // Dashboard
    Route::get('/dashboard', [dashboardcontroller::class, 'index'])->name('dashboard');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // ========== ROUTE MITRA ==========
    Route::prefix('mitra')->name('mitra.')->group(function () {
        Route::get('/', [MitraController::class, 'index'])->name('list');
        Route::get('/create', [MitraController::class, 'create'])->name('create');
        Route::post('/store', [MitraController::class, 'store'])->name('store');
        Route::get('/edit/{Mitra_Id}', [MitraController::class, 'edit'])->name('edit');
        Route::post('/update', [MitraController::class, 'update'])->name('update');
        Route::delete('/destroy/{Mitra_Id}', [MitraController::class, 'destroy'])->name('destroy');
    });
    
    // ========== ROUTE PRODUK ==========
    Route::prefix('produk')->name('produk.')->group(function () {
        Route::get('/', [ProdukController::class, 'index'])->name('list');
        Route::get('/create', [ProdukController::class, 'create'])->name('create');
        Route::post('/store', [ProdukController::class, 'store'])->name('store');
        Route::get('/edit/{produk_id}', [ProdukController::class, 'edit'])->name('edit');
        Route::post('/update', [ProdukController::class, 'update'])->name('update');
        Route::delete('/destroy/{produk_id}', [ProdukController::class, 'destroy'])->name('destroy');
    });
    
    // ========== ROUTE PELANGGAN ==========
    Route::prefix('pelanggan')->name('pelanggan.')->group(function () {
        Route::get('/', [PelangganController::class, 'index'])->name('list');
        Route::get('/create', [PelangganController::class, 'create'])->name('create');
        Route::post('/store', [PelangganController::class, 'store'])->name('store');
        Route::get('/edit/{pelanggan_id}', [PelangganController::class, 'edit'])->name('edit');
        Route::post('/update', [PelangganController::class, 'update'])->name('update');
        Route::delete('/destroy/{pelanggan_id}', [PelangganController::class, 'destroy'])->name('destroy');
    });
    
    // ========== ROUTE PESANAN ==========
    Route::prefix('pesan')->name('pesan.')->group(function () {
        Route::get('/', [PesanController::class, 'index'])->name('list');
        Route::get('/create', [PesanController::class, 'create'])->name('create');
        Route::post('/store', [PesanController::class, 'store'])->name('store');
        Route::get('/edit/{pesanan_id}', [PesanController::class, 'edit'])->name('edit');
        Route::post('/update', [PesanController::class, 'update'])->name('update');
        Route::delete('/destroy/{pesanan_id}', [PesanController::class, 'destroy'])->name('destroy');
        Route::get('/detail/{pesanan_id}', [PesanController::class, 'show'])->name('show');
        Route::get('/success/{pesanan_id}', [PesanController::class, 'success'])->name('success');
    });
    
    // ========== ROUTE ADMIN (HANYA UNTUK ROLE ADMINISTRATOR) ==========
    Route::group(['middleware' => ['checkrole:Administrator']], function () {
        Route::prefix('admin')->name('admin.')->group(function () {
            Route::get('/', [AdminController::class, 'index'])->name('list');
            Route::get('/create', [AdminController::class, 'create'])->name('create');
            Route::post('/store', [AdminController::class, 'store'])->name('store');
            Route::get('/edit/{user_id}', [AdminController::class, 'edit'])->name('edit');
            Route::post('/update', [AdminController::class, 'update'])->name('update');
            Route::delete('/destroy/{user_id}', [AdminController::class, 'destroy'])->name('destroy');
        });
    });
});