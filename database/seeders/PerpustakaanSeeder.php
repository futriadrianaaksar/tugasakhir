<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class PerpustakaanSeeder extends Seeder
{
    public function run(): void
    {
        // Seed users
        DB::table('user')->insert([
            [
                'name' => 'Ana',
                'email' => 'admin@perpus.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Alvin',
                'email' => 'petugas@perpus.com',
                'password' => Hash::make('password'),
                'role' => 'petugas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'ical',
                'email' => 'anggota@perpus.com',
                'password' => Hash::make('password'),
                'role' => 'anggota',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Seed books
        DB::table('books')->insert([
            [
                'title' => 'Laskar Pelangi',
                'author' => 'Andrea Hirata',
                'isbn' => '9789791227200',
                'stock' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Bumi Manusia',
                'author' => 'Pramoedya Ananta Toer',
                'isbn' => '9786024244222',
                'stock' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Seed fines_rules
        DB::table('fines_rules')->insert([
            'amount' => 1000,
            'description' => 'Denda keterlambatan per hari',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
