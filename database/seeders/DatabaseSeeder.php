<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            Createadministrator::class,
            Createmitra::class,
            Createpelanggan::class,
            produkSeeder::class,
            // CreateUserDummy::class,  // Uncomment jika butuh data dummy
            // CreatemitraDummy::class,
            // CreatepelangganDummy::class,
        ]);
    }
}