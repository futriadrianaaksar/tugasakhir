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

        // Seed loans
        DB::table('loans')->insert([
            [
                'user_id' => 3, // ical (anggota)
                'book_id' => 1, // Laskar Pelangi
                'loan_date' => Carbon::now()->subDays(3),
                'return_due_date' => Carbon::now()->addDays(4),
                'status' => 'dipinjam',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3, // ical (anggota)
                'book_id' => 2, // Bumi Manusia
                'loan_date' => Carbon::now()->subDays(10),
                'return_due_date' => Carbon::now()->subDays(2),
                'status' => 'dikembalikan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
