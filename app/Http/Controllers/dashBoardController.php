<?php

namespace App\Http\Controllers;

use App\Models\Mitra;
use App\Models\pesan;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class dashBoardController extends Controller
{
    public function index()
    {

        $produk = Produk::select('nama_produk', 'jumlah', 'tgl_masuk', 'tgl_expired')->get();

        // Data untuk chart
        $labels = $produk->pluck('nama_produk');
        $data = $produk->pluck('jumlah');
        $tglMasuk = $produk->pluck('tgl_masuk')->map(fn($d) => strtotime($d));
        $tglExpired = $produk->pluck('tgl_expired')->map(fn($d) => strtotime($d));

        // Statistik utama
        $Mitra = Mitra::count();
        $Pelanggan = User::where('role', 'Pelanggan')->count();
        $admin = User::where('role', 'administrator')->count();
        $pesan = pesan::count();
        $TotalProduk = Produk::count();

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
