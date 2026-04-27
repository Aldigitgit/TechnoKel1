<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreatemitraDummy extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        foreach (range(1, 5) as $index) {
            DB::table('mitra')->insert([
                'Nama_mitra' => $faker->company,
                'Alamat' => $faker->Address,
                'email' => $faker->unique()->safeEmail,
                'Nomor_Telepon' => $faker->phoneNumber,
                'Kemitraan' => $faker->randomElement(['Platinum', 'Gold', 'Silver']),
                'Bergabung' => $faker->date('Y-m-d', '2005-12-31'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
