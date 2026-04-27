<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mitra;
use App\Models\Produk;
use App\Models\Pesan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class dashboardcontroller extends Controller
{
    public function index() {

        $produk = Produk::select('nama_produk', 'jumlah','tgl_masuk', 'tgl_expired')->get();

        // Data untuk chart
        $labels     = $produk->pluck('nama_produk');
        $data       = $produk->pluck('jumlah');
        $tglMasuk   = $produk->pluck('tgl_masuk')->map(fn($d) => strtotime($d));
        $tglExpired = $produk->pluck('tgl_expired')->map(fn($d) => strtotime($d));

        // Statistik utama
        $Mitra       = Mitra::count();
        $Pelanggan   = User::where('role', 'Pelanggan')->count();
        $Admin       = User::where('role', 'Administrator')->count();
        $Pesan       = Pesan::count();
        $TotalProduk = Produk::count();

        // 5 Pesanan terbaru
        $pesanTerbaru = Pesan::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'Mitra', 'Pelanggan', 'Admin', 'Pesan', 'TotalProduk',
            'pesanTerbaru',
            'labels', 'data', 'tglMasuk', 'tglExpired'
        ));
    }
}
