<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class Createadministrator extends Seeder
{
    public function run(): void
    {
        if (!User::where('email', 'admin@gmail.com')->exists()) {
            User::create([
                'name' => 'administrator',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
                'role' => 'administrator'
            ]);
            $this->command->info('admin user created successfully!');
        }
    }
}