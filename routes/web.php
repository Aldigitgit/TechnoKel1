<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authcontroller;
use App\Http\Controllers\admincontroller;
use App\Http\Controllers\mitracontroller;
use App\Http\Controllers\pesancontroller;
use App\Http\Controllers\produkcontroller;
use App\Http\Controllers\dashboardcontroller;
use App\Http\Controllers\pelanggancontroller;

// ========== ROUTE TANPA MIDDLEWARE (PUBLIC) ==========
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/register', [authcontroller::class, 'register'])->name('register');
Route::post('/register/kirim', [authcontroller::class, 'kirimregister'])->name('kirimregister');

Route::get('/login', [authcontroller::class, 'login'])->name('login');
Route::post('/login/kirim', [authcontroller::class, 'kirimlogin'])->name('kirimlogin');

// ========== ROUTE YANG MEMERLUKAN LOGIN ==========
Route::group(['middleware' => ['checkislogin']], function () {

    // Dashboard
    Route::get('/dashboard', [dashboardcontroller::class, 'index'])->name('dashboard');
    Route::get('/logout', [authcontroller::class, 'logout'])->name('logout');

    Route::prefix('mitra')->name('mitra.')->group(function () {
        Route::get('/', [mitracontroller::class, 'index'])->name('list');
        Route::get('/create', [mitracontroller::class, 'create'])->name('create');
        Route::post('/store', [mitracontroller::class, 'store'])->name('store');
        Route::get('/edit/{mitra_id}', [mitracontroller::class, 'edit'])->name('edit');
        Route::post('/update', [mitracontroller::class, 'update'])->name('update');
        Route::delete('/destroy/{mitra_id}', [mitracontroller::class, 'destroy'])->name('destroy');
    });

    Route::prefix('produk')->name('produk.')->group(function () {
        Route::get('/', [produkcontroller::class, 'index'])->name('list');
        Route::get('/create', [produkcontroller::class, 'create'])->name('create');
        Route::post('/store', [produkcontroller::class, 'store'])->name('store');
        Route::get('/edit/{produk_id}', [produkcontroller::class, 'edit'])->name('edit');
        Route::post('/update', [produkcontroller::class, 'update'])->name('update');
        Route::delete('/destroy/{produk_id}', [produkcontroller::class, 'destroy'])->name('destroy');
    });

    Route::prefix('pelanggan')->name('pelanggan.')->group(function () {
        Route::get('/', [pelanggancontroller::class, 'index'])->name('list');
        Route::get('/create', [pelanggancontroller::class, 'create'])->name('create');
        Route::post('/store', [pelanggancontroller::class, 'store'])->name('store');
        Route::get('/edit/{pelanggan_id}', [pelanggancontroller::class, 'edit'])->name('edit');
        Route::post('/update', [pelanggancontroller::class, 'update'])->name('update');
        Route::delete('/destroy/{pelanggan_id}', [pelanggancontroller::class, 'destroy'])->name('destroy');
    });

    Route::prefix('pesan')->name('pesan.')->group(function () {
        Route::get('/', [pesancontroller::class, 'index'])->name('list');
        Route::get('/create', [pesancontroller::class, 'create'])->name('create');
        Route::post('/store', [pesancontroller::class, 'store'])->name('store');
        Route::get('/edit/{pesanan_id}', [pesancontroller::class, 'edit'])->name('edit');
        Route::post('/update', [pesancontroller::class, 'update'])->name('update');
        Route::delete('/destroy/{pesanan_id}', [pesancontroller::class, 'destroy'])->name('destroy');
        Route::get('/detail/{pesanan_id}', [pesancontroller::class, 'show'])->name('show');
        Route::get('/success/{pesanan_id}', [pesancontroller::class, 'success'])->name('success');
    });

    Route::group(['middleware' => ['checkrole:administrator']], function () {
        Route::prefix('admin')->name('admin.')->group(function () {
            Route::get('/', [admincontroller::class, 'index'])->name('list');
            Route::get('/create', [admincontroller::class, 'create'])->name('create');
            Route::post('/store', [admincontroller::class, 'store'])->name('store');
            Route::get('/edit/{user_id}', [admincontroller::class, 'edit'])->name('edit');
            Route::post('/update', [admincontroller::class, 'update'])->name('update');
            Route::delete('/destroy/{user_id}', [admincontroller::class, 'destroy'])->name('destroy');
        });
    });
});