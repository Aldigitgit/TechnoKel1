<?php

namespace Database\Factories;

use App\Models\Mitra;
use Illuminate\Database\Eloquent\Factories\Factory;

class MitraFactory extends Factory
{
    protected $model = Mitra::class;

    public function definition(): array
    {
        return [
            'nama_mitra' => fake()->company(),
            'alamat' => fake()->address(),
            'email' => fake()->unique()->safeEmail(),
            'nomor_telepon' => fake()->numerify('08##########'),
            'kemitraan' => fake()->randomElement(['Platinum', 'Gold', 'Silver']),
            'bergabung' => fake()->date(),
        ];
    }
}
