<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        Book::create([
            'judul' => 'Buku Contoh 1',
            'isbn' => '1234567890123',
            'penulis' => 'John Doe',
            'penerbit' => 'Penerbit ABC',
            'tahun_terbit' => 2020,
        ]);

        Book::create([
            'judul' => 'Buku Contoh 2',
            'isbn' => '9876543210987',
            'penulis' => 'Jane Smith',
            'penerbit' => 'Penerbit XYZ',
            'tahun_terbit' => 2021,
        ]);
    }
}
