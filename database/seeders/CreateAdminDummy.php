<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateAdminDummy extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        foreach (range(1, 5) as $index) {
            DB::table('Users')->insert([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => $faker->password,
                'role' => $faker->randomElement(['Administrator','Pelanggan','Mitra']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
