<?php

namespace Database\Seeders;

use App\Models\user;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class createadministrator extends Seeder
{
    public function run(): void
    {
        if (!user::where('email', 'admin@gmail.com')->exists()) {
            user::create([
                'name' => 'administrator',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
                'role' => 'administrator'
            ]);
            $this->command->info('admin user created successfully!');
        }
    }
}