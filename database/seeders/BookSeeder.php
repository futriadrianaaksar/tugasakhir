<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    public function run()
    {
        Book::create([
            'title' => 'Belajar Laravel untuk Pemula',
            'isbn' => '978-623-01-1234-5',
            'author' => 'Budi Santoso',
            'stock' => 15,
        ]);

        Book::create([
            'title' => 'Dasar-Dasar Pemrograman Python',
            'isbn' => '978-602-02-5678-9',
            'author' => 'Ani Rahayu',
            'stock' => 10,
        ]);

        Book::create([
            'title' => 'Pengantar Sistem Basis Data',
            'isbn' => '978-979-29-8765-2',
            'author' => 'Joko Widodo',
            'stock' => 8,
        ]);

        Book::create([
            'title' => 'Algoritma dan Struktur Data',
            'isbn' => '978-623-00-3456-7',
            'author' => 'Siti Aminah',
            'stock' => 12,
        ]);

        Book::create([
            'title' => 'Desain UI/UX Modern',
            'isbn' => '978-602-03-7890-0',
            'author' => 'Rina Permata',
            'stock' => 5,
        ]);
    }
}
