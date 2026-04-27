<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Seeder;

class CreateProduk extends Seeder
{
    public function run(): void
    {
        $produkData = [
            // ========== BAKPAO MANIS ==========
            ['nama_produk' => 'Bakpao Coklat Lumer', 'jumlah' => 100, 'kategori' => 'Bakpao Manis', 'harga' => 5000, 'tgl_masuk' => '2025-01-01', 'tgl_expired' => '2025-12-31'],
            ['nama_produk' => 'Bakpao Kacang Merah', 'jumlah' => 100, 'kategori' => 'Bakpao Manis', 'harga' => 5000, 'tgl_masuk' => '2025-01-01', 'tgl_expired' => '2025-12-31'],
            ['nama_produk' => 'Bakpao Keju', 'jumlah' => 100, 'kategori' => 'Bakpao Manis', 'harga' => 6000, 'tgl_masuk' => '2025-01-01', 'tgl_expired' => '2025-12-31'],
            ['nama_produk' => 'Bakpao Durian', 'jumlah' => 100, 'kategori' => 'Bakpao Manis', 'harga' => 5000, 'tgl_masuk' => '2025-01-01', 'tgl_expired' => '2025-12-31'],
            ['nama_produk' => 'Bakpao Kelapa Gula Merah', 'jumlah' => 100, 'kategori' => 'Bakpao Manis', 'harga' => 5000, 'tgl_masuk' => '2025-01-01', 'tgl_expired' => '2025-12-31'],
            ['nama_produk' => 'Bakpao Coklat Keju', 'jumlah' => 100, 'kategori' => 'Bakpao Manis', 'harga' => 6000, 'tgl_masuk' => '2025-01-01', 'tgl_expired' => '2025-12-31'],

            // ========== BAKPAO GURIH ==========
            ['nama_produk' => 'Bakpao Ayam Suwir', 'jumlah' => 100, 'kategori' => 'Bakpao Gurih', 'harga' => 6000, 'tgl_masuk' => '2025-01-01', 'tgl_expired' => '2025-12-31'],

            // ========== RISOL MAYO ==========
            ['nama_produk' => 'Sosis Mayo', 'jumlah' => 100, 'kategori' => 'Risol Mayo', 'harga' => 2000, 'tgl_masuk' => '2025-01-01', 'tgl_expired' => '2025-12-31'],
            ['nama_produk' => 'Beef Mayo', 'jumlah' => 100, 'kategori' => 'Risol Mayo', 'harga' => 2000, 'tgl_masuk' => '2025-01-01', 'tgl_expired' => '2025-12-31'],
            ['nama_produk' => 'Telor Mayo', 'jumlah' => 100, 'kategori' => 'Risol Mayo', 'harga' => 2000, 'tgl_masuk' => '2025-01-01', 'tgl_expired' => '2025-12-31'],
            ['nama_produk' => 'Ayam Suwir Mayo', 'jumlah' => 100, 'kategori' => 'Risol Mayo', 'harga' => 2000, 'tgl_masuk' => '2025-01-01', 'tgl_expired' => '2025-12-31'],
            ['nama_produk' => 'Risol Combo Mayo', 'jumlah' => 100, 'kategori' => 'Risol Mayo', 'harga' => 3000, 'tgl_masuk' => '2025-01-01', 'tgl_expired' => '2025-12-31'],

            // ========== DIMSUM GORENG ==========
            ['nama_produk' => 'Dimsum Ayam', 'jumlah' => 100, 'kategori' => 'Dimsum Goreng', 'harga' => 6000, 'tgl_masuk' => '2025-01-01', 'tgl_expired' => '2025-12-31'],
            ['nama_produk' => 'Dimsum Udang', 'jumlah' => 100, 'kategori' => 'Dimsum Goreng', 'harga' => 6000, 'tgl_masuk' => '2025-01-01', 'tgl_expired' => '2025-12-31'],
            ['nama_produk' => 'Dimsum Keju', 'jumlah' => 100, 'kategori' => 'Dimsum Goreng', 'harga' => 6000, 'tgl_masuk' => '2025-01-01', 'tgl_expired' => '2025-12-31'],
            ['nama_produk' => 'Dimsum Mix', 'jumlah' => 100, 'kategori' => 'Dimsum Goreng', 'harga' => 6000, 'tgl_masuk' => '2025-01-01', 'tgl_expired' => '2025-12-31'],
        ];

        foreach ($produkData as $data) {
            if (!Produk::where('nama_produk', $data['nama_produk'])->exists()) {
                Produk::create($data);
            }
        }
    }
}