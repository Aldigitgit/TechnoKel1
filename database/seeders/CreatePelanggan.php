<?php

namespace Database\Seeders;

use App\Models\Pelanggan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreatePelanggan extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pelanggan::create([
        'first_name'=>'Aldi',
        'last_name'=>'Wiranto',
        'birthday'=>date('2005-12-31'),
        'gender'=>'Male',
        'email'=>'Aldi23si@mahasiswa.pcr.ac.id',
        'phone'=>'085211473156'
    ]);
    }
}
