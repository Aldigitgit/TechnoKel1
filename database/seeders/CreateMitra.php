<?php

namespace Database\Seeders;

use App\Models\Mitra;
use Illuminate\Database\Seeder;

class CreateMitra extends Seeder
{
    public function run(): void
    {
        $mitraData = [
            [
                'nama_mitra' => 'PT. Bakpao Sejahtera',
                'alamat' => 'Jl. Sudirman No. 123, Jakarta',
                'email' => 'info@bakpaosejahtera.com',
                'nomor_telepon' => '081234567890',
                'kemitraan' => 'Platinum',
                'bergabung' => '2020-01-15',
            ],
            [
                'nama_mitra' => 'CV. Dimsum Raya',
                'alamat' => 'Jl. Gatot Subroto No. 45, Bandung',
                'email' => 'cs@dimsumraya.com',
                'nomor_telepon' => '081298765432',
                'kemitraan' => 'Gold',
                'bergabung' => '2021-03-20',
            ],
            [
                'nama_mitra' => 'UD. Kue Nusantara',
                'alamat' => 'Jl. Diponegoro No. 78, Surabaya',
                'email' => 'admin@kuenusantara.com',
                'nomor_telepon' => '085678901234',
                'kemitraan' => 'Silver',
                'bergabung' => '2022-06-10',
            ],
        ];

        foreach ($mitraData as $data) {
            if (!Mitra::where('email', $data['email'])->exists()) {
                Mitra::create($data);
            }
        }
    }
}