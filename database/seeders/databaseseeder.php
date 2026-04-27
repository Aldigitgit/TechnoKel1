<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class databaseseeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            createadministrator::class,
            createmitra::class,
            createpelanggan::class,
            produkseeder::class,
            // createuserdummy::class,  // Uncomment jika butuh data dummy
            // createmitradummy::class,
            // createpelanggandummy::class,
        ]);
    }
}