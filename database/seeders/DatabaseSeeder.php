<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            CreateAdministrator::class,
            CreateMitra::class,
            CreatePelanggan::class,
            ProdukSeeder::class,
            // CreateUserDummy::class,  // Uncomment jika butuh data dummy
            // CreateMitraDummy::class,
            // CreatePelangganDummy::class,
        ]);
    }
}