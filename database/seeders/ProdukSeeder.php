<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    public function run(): void
    {
        $produkData = [
            // ========== BAKPAO MANIS ==========
            ['nama_produk' => 'Bakpao Coklat Lumer', 'jumlah' => 50, 'kategori' => 'Bakpao Manis', 'harga' => 5000, 'tgl_masuk' => '2025-04-01', 'tgl_expired' => '2025-10-01'],
            ['nama_produk' => 'Bakpao Kacang Merah', 'jumlah' => 45, 'kategori' => 'Bakpao Manis', 'harga' => 5000, 'tgl_masuk' => '2025-04-02', 'tgl_expired' => '2025-10-02'],
            ['nama_produk' => 'Bakpao Keju', 'jumlah' => 40, 'kategori' => 'Bakpao Manis', 'harga' => 6000, 'tgl_masuk' => '2025-04-03', 'tgl_expired' => '2025-10-03'],
            ['nama_produk' => 'Bakpao Durian', 'jumlah' => 35, 'kategori' => 'Bakpao Manis', 'harga' => 5000, 'tgl_masuk' => '2025-04-04', 'tgl_expired' => '2025-10-04'],
            ['nama_produk' => 'Bakpao Kelapa Gula Merah', 'jumlah' => 30, 'kategori' => 'Bakpao Manis', 'harga' => 5000, 'tgl_masuk' => '2025-04-05', 'tgl_expired' => '2025-10-05'],
            ['nama_produk' => 'Bakpao Coklat Keju', 'jumlah' => 40, 'kategori' => 'Bakpao Manis', 'harga' => 6000, 'tgl_masuk' => '2025-04-06', 'tgl_expired' => '2025-10-06'],

            // ========== BAKPAO GURIH ==========
            ['nama_produk' => 'Bakpao Ayam Suwir', 'jumlah' => 50, 'kategori' => 'Bakpao Gurih', 'harga' => 6000, 'tgl_masuk' => '2025-04-07', 'tgl_expired' => '2025-10-07'],
            ['nama_produk' => 'Bakpao Sapi Lada Hitam', 'jumlah' => 40, 'kategori' => 'Bakpao Gurih', 'harga' => 7000, 'tgl_masuk' => '2025-04-08', 'tgl_expired' => '2025-10-08'],
            ['nama_produk' => 'Bakpao Jamur', 'jumlah' => 35, 'kategori' => 'Bakpao Gurih', 'harga' => 6000, 'tgl_masuk' => '2025-04-09', 'tgl_expired' => '2025-10-09'],

            // ========== BAKPAO SPESIAL ==========
            ['nama_produk' => 'Bakpao Telur Asin', 'jumlah' => 30, 'kategori' => 'Bakpao Spesial', 'harga' => 8000, 'tgl_masuk' => '2025-04-10', 'tgl_expired' => '2025-10-10'],
            ['nama_produk' => 'Bakpao Rendang', 'jumlah' => 25, 'kategori' => 'Bakpao Spesial', 'harga' => 9000, 'tgl_masuk' => '2025-04-11', 'tgl_expired' => '2025-10-11'],
            ['nama_produk' => 'Bakpao Kari Ayam', 'jumlah' => 25, 'kategori' => 'Bakpao Spesial', 'harga' => 8500, 'tgl_masuk' => '2025-04-12', 'tgl_expired' => '2025-10-12'],

            // ========== DIMSUM GORENG ==========
            ['nama_produk' => 'Dimsum Ayam', 'jumlah' => 60, 'kategori' => 'Dimsum Goreng', 'harga' => 6000, 'tgl_masuk' => '2025-04-13', 'tgl_expired' => '2025-10-13'],
            ['nama_produk' => 'Dimsum Udang', 'jumlah' => 55, 'kategori' => 'Dimsum Goreng', 'harga' => 7000, 'tgl_masuk' => '2025-04-14', 'tgl_expired' => '2025-10-14'],
            ['nama_produk' => 'Dimsum Keju', 'jumlah' => 50, 'kategori' => 'Dimsum Goreng', 'harga' => 6500, 'tgl_masuk' => '2025-04-15', 'tgl_expired' => '2025-10-15'],
            ['nama_produk' => 'Dimsum Mix', 'jumlah' => 45, 'kategori' => 'Dimsum Goreng', 'harga' => 7000, 'tgl_masuk' => '2025-04-16', 'tgl_expired' => '2025-10-16'],

            // ========== RISOL MAYO ==========
            ['nama_produk' => 'Sosis Mayo', 'jumlah' => 50, 'kategori' => 'Risol Mayo', 'harga' => 3000, 'tgl_masuk' => '2025-04-17', 'tgl_expired' => '2025-10-17'],
            ['nama_produk' => 'Beef Mayo', 'jumlah' => 45, 'kategori' => 'Risol Mayo', 'harga' => 3500, 'tgl_masuk' => '2025-04-18', 'tgl_expired' => '2025-10-18'],
            ['nama_produk' => 'Telor Mayo', 'jumlah' => 40, 'kategori' => 'Risol Mayo', 'harga' => 3000, 'tgl_masuk' => '2025-04-19', 'tgl_expired' => '2025-10-19'],
            ['nama_produk' => 'Ayam Suwir Mayo', 'jumlah' => 40, 'kategori' => 'Risol Mayo', 'harga' => 3500, 'tgl_masuk' => '2025-04-20', 'tgl_expired' => '2025-10-20'],
            ['nama_produk' => 'Risol Combo Mayo', 'jumlah' => 30, 'kategori' => 'Risol Mayo', 'harga' => 5000, 'tgl_masuk' => '2025-04-21', 'tgl_expired' => '2025-10-21'],
        ];

        foreach ($produkData as $data) {
            if (!Produk::where('nama_produk', $data['nama_produk'])->exists()) {
                Produk::create($data);
            }
        }
    }
}