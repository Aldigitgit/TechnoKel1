<?php

namespace App\Http\Controllers;

use App\Models\mitra;
use App\Models\pesan;
use App\Models\produk;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class dashboardcontroller extends Controller
{
    public function index()
    {

        $produk = produk::select('nama_produk', 'jumlah', 'tgl_masuk', 'tgl_expired')->get();

        // Data untuk chart
        $labels = $produk->pluck('nama_produk');
        $data = $produk->pluck('jumlah');
        $tglMasuk = $produk->pluck('tgl_masuk')->map(fn($d) => strtotime($d));
        $tglExpired = $produk->pluck('tgl_expired')->map(fn($d) => strtotime($d));

        // Statistik utama
        $Mitra = mitra::count();
        $Pelanggan = user::where('role', 'Pelanggan')->count();
        $admin = user::where('role', 'administrator')->count();
        $pesan = pesan::count();
        $TotalProduk = produk::count();

        // 5 pesanan terbaru
        $pesanTerbaru = pesan::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'Mitra',
            'Pelanggan',
            'admin',
            'pesan',
            'TotalProduk',
            'pesanTerbaru',
            'labels',
            'data',
            'tglMasuk',
            'tglExpired'
        ));
    }
}
