<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateAdministrator extends Seeder
{
    public function run(): void
    {
        if (!User::where('email', 'admin@gmail.com')->exists()) {
            User::create([
                'name' => 'Administrator',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
                'role' => 'Administrator'
            ]);
            $this->command->info('Admin user created successfully!');
        }
    }
}