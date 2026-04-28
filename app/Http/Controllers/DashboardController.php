<?php

namespace App\Http\Controllers;

use App\Models\Mitra;
use App\Models\Pesan;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class DashboardController extends Controller
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
        $mitra = Mitra::count();
        $pelanggan = User::where('role', 'Pelanggan')->count();
        $admin = User::where('role', 'administrator')->count();
        $pesan = Pesan::count();
        $Totalproduk = Produk::count();

        // 5 pesanan terbaru
        $pesanTerbaru = Pesan::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'mitra',
            'pelanggan',
            'admin',
            'pesan',
            'Totalproduk',
            'pesanTerbaru',
            'labels',
            'data',
            'tglMasuk',
            'tglExpired'
        ));
    }
}
