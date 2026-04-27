<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Seeder;

class CreateProduk extends Seeder
{
    public function run(): void
    {
        $produkData = [
            // Bakpao Manis
            ['nama_produk' => 'Bakpao Coklat', 'jumlah' => 100, 'kategori' => 'Bakpao Manis', 'harga' => 5000, 'tgl_masuk' => '2024-01-01', 'tgl_expired' => '2024-12-31'],
            ['nama_produk' => 'Bakpao Kacang', 'jumlah' => 80, 'kategori' => 'Bakpao Manis', 'harga' => 5000, 'tgl_masuk' => '2024-01-01', 'tgl_expired' => '2024-12-31'],
            ['nama_produk' => 'Bakpao Keju', 'jumlah' => 60, 'kategori' => 'Bakpao Manis', 'harga' => 6000, 'tgl_masuk' => '2024-01-01', 'tgl_expired' => '2024-12-31'],
            ['nama_produk' => 'Bakpao Kelapa', 'jumlah' => 50, 'kategori' => 'Bakpao Manis', 'harga' => 5000, 'tgl_masuk' => '2024-01-01', 'tgl_expired' => '2024-12-31'],
            
            // Bakpao Gurih
            ['nama_produk' => 'Bakpao Ayam', 'jumlah' => 90, 'kategori' => 'Bakpao Gurih', 'harga' => 7000, 'tgl_masuk' => '2024-01-01', 'tgl_expired' => '2024-12-31'],
            ['nama_produk' => 'Bakpao Daging', 'jumlah' => 70, 'kategori' => 'Bakpao Gurih', 'harga' => 7000, 'tgl_masuk' => '2024-01-01', 'tgl_expired' => '2024-12-31'],
            ['nama_produk' => 'Bakpao Ayam Keju', 'jumlah' => 55, 'kategori' => 'Bakpao Gurih', 'harga' => 8000, 'tgl_masuk' => '2024-01-01', 'tgl_expired' => '2024-12-31'],
            ['nama_produk' => 'Bakpao Sosis', 'jumlah' => 65, 'kategori' => 'Bakpao Gurih', 'harga' => 7000, 'tgl_masuk' => '2024-01-01', 'tgl_expired' => '2024-12-31'],
            
            // Bakpao Spesial
            ['nama_produk' => 'Bakpao Strawberry', 'jumlah' => 45, 'kategori' => 'Bakpao Spesial', 'harga' => 6000, 'tgl_masuk' => '2024-01-01', 'tgl_expired' => '2024-12-31'],
            ['nama_produk' => 'Bakpao Matcha', 'jumlah' => 40, 'kategori' => 'Bakpao Spesial', 'harga' => 7000, 'tgl_masuk' => '2024-01-01', 'tgl_expired' => '2024-12-31'],
            ['nama_produk' => 'Bakpao Pandan', 'jumlah' => 50, 'kategori' => 'Bakpao Spesial', 'harga' => 6000, 'tgl_masuk' => '2024-01-01', 'tgl_expired' => '2024-12-31'],
            ['nama_produk' => 'Bakpao Red Velvet', 'jumlah' => 35, 'kategori' => 'Bakpao Spesial', 'harga' => 8000, 'tgl_masuk' => '2024-01-01', 'tgl_expired' => '2024-12-31'],
            
            // Dimsum
            ['nama_produk' => 'Dimsum Ayam', 'jumlah' => 120, 'kategori' => 'Dimsum Goreng', 'harga' => 8000, 'tgl_masuk' => '2024-01-01', 'tgl_expired' => '2024-12-31'],
            ['nama_produk' => 'Dimsum Udang', 'jumlah' => 100, 'kategori' => 'Dimsum Goreng', 'harga' => 9000, 'tgl_masuk' => '2024-01-01', 'tgl_expired' => '2024-12-31'],
            ['nama_produk' => 'Dimsum Keju', 'jumlah' => 85, 'kategori' => 'Dimsum Goreng', 'harga' => 9000, 'tgl_masuk' => '2024-01-01', 'tgl_expired' => '2024-12-31'],
            ['nama_produk' => 'Dimsum Mix', 'jumlah' => 60, 'kategori' => 'Dimsum Goreng', 'harga' => 45000, 'tgl_masuk' => '2024-01-01', 'tgl_expired' => '2024-12-31'],
        ];

        foreach ($produkData as $data) {
            if (!Produk::where('nama_produk', $data['nama_produk'])->exists()) {
                Produk::create($data);
            }
        }
    }
}