<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat user admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password123'),
            'role' => 'admin',
        ]);

        // Buat user kasir
        User::create([
            'name' => 'Operator',
            'email' => 'operator@example.com',
            'password' => bcrypt('password123'),
            'role' => 'kasir',
        ]);
    }
}
