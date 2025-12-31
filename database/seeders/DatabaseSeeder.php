<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Membuat 1 Akun Admin Otomatis
        User::create([
            'name' => 'Admin',
            'email' => 'admin@pemuda.com',         // Email login
            'password' => Hash::make('password123'), // Password login
        ]);
    }
}