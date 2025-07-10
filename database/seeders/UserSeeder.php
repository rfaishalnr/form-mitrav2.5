<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat admin default
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Buat beberapa user biasa untuk testing
        User::create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'email_verified_at' => now(),
        ]);

        // User::create([
        //     'name' => 'Jane Smith',
        //     'email' => 'jane@example.com',
        //     'password' => Hash::make('password'),
        //     'role' => 'user',
        //     'email_verified_at' => now(),
        // ]);

        // Atau bisa menggunakan factory untuk generate banyak user sekaligus
        // User::factory(10)->create(['role' => 'user']);
    }
}