<?php

namespace Database\Factories;

use App\Models\Produk;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProdukFactory extends Factory
{
    protected $model = Produk::class;

    public function definition(): array
    {
        $tglMasuk = fake()->dateTimeBetween('-1 month', 'now');
        
        return [
            'nama_produk' => fake()->unique()->words(3, true),
            'jumlah' => fake()->numberBetween(1, 100),
            'kategori' => fake()->randomElement(['Bakpao Manis', 'Bakpao Gurih', 'Bakpao Spesial', 'Dimsum Goreng', 'Risol Mayo']),
            'harga' => fake()->numberBetween(2000, 10000),
            'tgl_masuk' => $tglMasuk->format('Y-m-d'),
            'tgl_expired' => fake()->dateTimeBetween($tglMasuk, '+6 months')->format('Y-m-d'),
        ];
    }
}
