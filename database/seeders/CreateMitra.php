<?php

namespace Database\Seeders;

use App\Models\Mitra;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateMitra extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Mitra::create([
            'Nama_Mitra'=>'tokopedia',
            'Alamat'=>'jakarta',
            'Email'=>'tokopedia@gmail.com',
            'Nomor_Telepon'=>'0852',
            'Kemitraan'=>'Gold',
            'Bergabung'=>date('2005-12-31')
        ]);
    }
}
