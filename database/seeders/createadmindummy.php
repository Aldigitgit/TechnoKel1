<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateadminDummy extends Seeder
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
                'role' => $faker->randomElement(['administrator', 'pelanggan', 'mitra']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
