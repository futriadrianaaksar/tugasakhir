<?php
namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        Book::create(['title' => 'Pemrograman Laravel', 'author' => 'John Doe', 'isbn' => '1234567890123', 'stock' => 10]);
        Book::create(['title' => 'Desain UI/UX', 'author' => 'Jane Smith', 'isbn' => '9876543210987', 'stock' => 5]);
        Book::create(['title' => 'Basis Data', 'author' => 'Alice Johnson', 'isbn' => '4567891234567', 'stock' => 8]);
        Book::create(['title' => 'Algoritma', 'author' => 'Bob Brown', 'isbn' => '7891234567891', 'stock' => 3]);
        Book::create(['title' => 'Jaringan Komputer', 'author' => 'Carol White', 'isbn' => '3216549871234', 'stock' => 7]);
    }
}
