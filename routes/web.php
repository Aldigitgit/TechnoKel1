<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\dashBoardController;
use App\Http\Controllers\PelangganController;

Route::get('/', function () {
    return view('home');
});

Route::get('/register', [AuthController::class,'register'])->name('register');

Route::post('/register/kirim', [AuthController::class,'kirimregister'])->name('kirimregister');

Route::get('/login', [AuthController::class,'login'])->name('login');

Route::post('/login/kirim', [AuthController::class,'kirimlogin'])->name('kirimlogin');


Route::group(['middleware'=>['checkislogin']],function(){
    // List Route yang ingin diterapkan
    Route::get('/dashboard', [dashBoardController::class, 'index'])->name('dashboard');

    Route::get('/Mitra', [MitraController::class, 'index'])->name('Mitra.list');
    Route::get('/Mitra/create', [MitraController::class, 'create'])->name('Mitra.create');
    Route::get('/Mitra/edit/{param1}', [MitraController::class, 'edit'])->name('Mitra.edit');

    Route::get('/produk', [ProdukController::class, 'index'])->name('produk.list');
    Route::get('/produk/create', [ProdukController::class, 'create'])->name('produk.create');
    Route::get('/produk/edit/{param1}', [ProdukController::class, 'edit'])->name('produk.edit');

    Route::get('/pelanggan', [PelangganController::class, 'index'])->name('pelanggan.list');
    Route::get('/pelanggan/create', [PelangganController::class, 'create'])->name('pelanggan.create');
    Route::get('/pelanggan/edit/{param1}', [PelangganController::class, 'edit'])->name('pelanggan.edit');

});
Route::post('/Mitra/store', [MitraController::class, 'store'])->name('Mitra.store');
Route::post('/Mitra/update', [MitraController::class, 'update'])->name('Mitra.update');
Route::get('/Mitra/destroy/{param1}', [MitraController::class, 'destroy'])->name('Mitra.destroy');

Route::post('/produk/store', [ProdukController::class, 'store'])->name('produk.store');
Route::post('/produk/update', [ProdukController::class, 'update'])->name('produk.update');
Route::get('/produk/destroy/{param1}', [ProdukController::class, 'destroy'])->name('produk.destroy');

Route::post('/Admin/store', [AdminController::class, 'store'])->name('Admin.store');
Route::post('/Admin/update', [AdminController::class, 'update'])->name('Admin.update');
Route::get('/Admin/destroy/{param1}', [AdminController::class, 'destroy'])->name('Admin.destroy');

Route::post('/pelanggan/store', [PelangganController::class, 'store'])->name('pelanggan.store');
Route::post('/pelanggan/update', [PelangganController::class, 'update'])->name('pelanggan.update');
Route::get('/pelanggan/destroy/{param1}', [PelangganController::class, 'destroy'])->name('pelanggan.destroy');


Route::group(['middleware'=>['checkrole:Administrator']],function(){
    Route::get('/Admin', [AdminController::class, 'index'])->name('Admin.list');
    Route::get('/Admin/create', [AdminController::class, 'create'])->name('Admin.create');
    Route::get('/Admin/edit/{param1}', [AdminController::class, 'edit'])->name('Admin.edit');
});


Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/Pesan', [PesanController::class, 'index'])->name('Pesan.list');
Route::get('/Pesan/create', [PesanController::class, 'create'])->name('Pesan.create');
Route::post('/Pesan/store', [PesanController::class, 'store'])->name('Pesan.store');
Route::get('/Pesan/edit/{param1}', [PesanController::class, 'edit'])->name('Pesan.edit');
Route::post('/Pesan/update', [PesanController::class, 'update'])->name('Pesan.update');
Route::get('/Pesan/destroy/{param1}', [PesanController::class, 'destroy'])->name('Pesan.destroy');

