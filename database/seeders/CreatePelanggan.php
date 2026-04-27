<?php

namespace Database\Seeders;

use App\Models\Pelanggan;
use Illuminate\Database\Seeder;

class CreatePelanggan extends Seeder
{
    public function run(): void
    {
        $pelangganData = [
            [
                'first_name' => 'Aldi',
                'last_name' => 'Wiranto',
                'birthday' => '1995-12-31',
                'gender' => 'Male',
                'email' => 'aldi.wiranto@example.com',
                'phone' => '081234567890',
            ],
            [
                'first_name' => 'Siti',
                'last_name' => 'Nurhaliza',
                'birthday' => '1998-05-15',
                'gender' => 'Female',
                'email' => 'siti.nur@example.com',
                'phone' => '081298765432',
            ],
            [
                'first_name' => 'Budi',
                'last_name' => 'Santoso',
                'birthday' => '1990-08-20',
                'gender' => 'Male',
                'email' => 'budi.santoso@example.com',
                'phone' => '085678901234',
            ],
        ];

        foreach ($pelangganData as $data) {
            if (!Pelanggan::where('email', $data['email'])->exists()) {
                Pelanggan::create($data);
            }
        }
    }
}