<?php

namespace Database\Factories;

use App\Models\Pesan;
use Illuminate\Database\Eloquent\Factories\Factory;

class PesanFactory extends Factory
{
    protected $model = Pesan::class;

    public function definition(): array
    {
        $hargaproduk = [
            'Bakpao Kacang Merah' => 5000,
            'Bakpao Coklat Lumer' => 5000,
            'Bakpao Keju' => 6000,
            'Dimsum Ayam' => 6000,
            'Sosis Mayo' => 2000,
        ];

        $varian = fake()->randomElement(array_keys($hargaproduk));
        $jumlah = fake()->numberBetween(1, 20);
        $totalHarga = $hargaproduk[$varian] * $jumlah;

        return [
            'jenis_produk' => 'Bakpao Manis',
            'varian_produk' => $varian,
            'jumlah_pesanan' => $jumlah,
            'tanggal_pengambilan' => fake()->dateTimeBetween('+1 day', '+1 month'),
            'catatan_pesanan' => fake()->optional()->sentence(),
            'ambil_di_toko' => fake()->boolean(),
            'alamat_pengiriman' => fake()->optional()->address(),
            'nama_penerima' => fake()->optional()->name(),
            'kontak_penerima' => fake()->optional()->numerify('08##########'),
            'nama_pemesan' => fake()->name(),
            'kontak_pemesan' => fake()->numerify('08##########'),
            'email_pemesan' => fake()->safeEmail(),
            'status' => 'pending',
            'total_harga' => $totalHarga,
            'dp_dibayar' => fake()->optional()->numberBetween(10000, 50000),
            'metode_pembayaran' => fake()->optional()->randomElement(['transfer', 'ewallet', 'cash', 'cod']),
            'instruksi_khusus' => fake()->optional()->sentence(),
        ];
    }
}
