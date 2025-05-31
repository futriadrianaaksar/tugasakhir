<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            // Admin
            [
                'name' => 'Admin Utama',
                'email' => 'admin1@ana.com',
                'password' => Hash::make('12345678'),
                'role' => 'admin',
            ],
            [
                'name' => 'Admin Kedua',
                'email' => 'admin2@example.com',
                'password' => Hash::make('12345678'),
                'role' => 'admin',
            ],
            // Petugas
            [
                'name' => 'Petugas Satu',
                'email' => 'petugas1@example.com',
                'password' => Hash::make('12345678'),
                'role' => 'petugas',
            ],
            [
                'name' => 'Petugas Dua',
                'email' => 'petugas2@example.com',
                'password' => Hash::make('12345678'),
                'role' => 'petugas',
            ],
            [
                'name' => 'Petugas Tiga',
                'email' => 'petugas3@example.com',
                'password' => Hash::make('12345678'),
                'role' => 'petugas',
            ],
            // Mahasiswa
            [
                'name' => 'Mahasiswa Satu',
                'email' => 'mahasiswa1@example.com',
                'password' => Hash::make('12345678'),
                'role' => 'mahasiswa',
            ],
            [
                'name' => 'Mahasiswa Dua',
                'email' => 'mahasiswa2@example.com',
                'password' => Hash::make('12345678'),
                'role' => 'mahasiswa',
            ],
            [
                'name' => 'Mahasiswa Tiga',
                'email' => 'mahasiswa3@example.com',
                'password' => Hash::make('12345678'),
                'role' => 'mahasiswa',
            ],
        ];

        foreach ($users as $data) {
            if (!User::where('email', $data['email'])->exists()) {
                User::create($data);
            }
        }

        $this->call(BookSeeder::class);
    }
}
