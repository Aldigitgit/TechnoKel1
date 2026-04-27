<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\mitraController;
use App\Http\Controllers\pesanController;
use App\Http\Controllers\produkController;
use App\Http\Controllers\dashboardcontroller;
use App\Http\Controllers\pelangganController;

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
        Route::get('/', [mitraController::class, 'index'])->name('list');
        Route::get('/create', [mitraController::class, 'create'])->name('create');
        Route::post('/store', [mitraController::class, 'store'])->name('store');
        Route::get('/edit/{mitra_Id}', [mitraController::class, 'edit'])->name('edit');
        Route::post('/update', [mitraController::class, 'update'])->name('update');
        Route::delete('/destroy/{mitra_Id}', [mitraController::class, 'destroy'])->name('destroy');
    });

    // ========== ROUTE PRODUK ==========
    Route::prefix('produk')->name('produk.')->group(function () {
        Route::get('/', [produkController::class, 'index'])->name('list');
        Route::get('/create', [produkController::class, 'create'])->name('create');
        Route::post('/store', [produkController::class, 'store'])->name('store');
        Route::get('/edit/{produk_id}', [produkController::class, 'edit'])->name('edit');
        Route::post('/update', [produkController::class, 'update'])->name('update');
        Route::delete('/destroy/{produk_id}', [produkController::class, 'destroy'])->name('destroy');
    });

    // ========== ROUTE PELANGGAN ==========
    Route::prefix('pelanggan')->name('pelanggan.')->group(function () {
        Route::get('/', [pelangganController::class, 'index'])->name('list');
        Route::get('/create', [pelangganController::class, 'create'])->name('create');
        Route::post('/store', [pelangganController::class, 'store'])->name('store');
        Route::get('/edit/{pelanggan_id}', [pelangganController::class, 'edit'])->name('edit');
        Route::post('/update', [pelangganController::class, 'update'])->name('update');
        Route::delete('/destroy/{pelanggan_id}', [pelangganController::class, 'destroy'])->name('destroy');
    });

    // ========== ROUTE PESANAN ==========
    Route::prefix('pesan')->name('pesan.')->group(function () {
        Route::get('/', [pesanController::class, 'index'])->name('list');
        Route::get('/create', [pesanController::class, 'create'])->name('create');
        Route::post('/store', [pesanController::class, 'store'])->name('store');
        Route::get('/edit/{pesanan_id}', [pesanController::class, 'edit'])->name('edit');
        Route::post('/update', [pesanController::class, 'update'])->name('update');
        Route::delete('/destroy/{pesanan_id}', [pesanController::class, 'destroy'])->name('destroy');
        Route::get('/detail/{pesanan_id}', [pesanController::class, 'show'])->name('show');
        Route::get('/success/{pesanan_id}', [pesanController::class, 'success'])->name('success');
    });

    // ========== ROUTE ADMIN (HANYA UNTUK ROLE ADMINISTRATOR) ==========
    Route::group(['middleware' => ['checkrole:administrator']], function () {
        Route::prefix('admin')->name('admin.')->group(function () {
            Route::get('/', [adminController::class, 'index'])->name('list');
            Route::get('/create', [adminController::class, 'create'])->name('create');
            Route::post('/store', [adminController::class, 'store'])->name('store');
            Route::get('/edit/{user_id}', [adminController::class, 'edit'])->name('edit');
            Route::post('/update', [adminController::class, 'update'])->name('update');
            Route::delete('/destroy/{user_id}', [adminController::class, 'destroy'])->name('destroy');
        });
    });
});