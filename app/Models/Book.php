<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['title', 'isbn', 'author', 'stock'];
    // Ganti 'title', 'isbn', 'author', 'stock' dengan nama kolom yang sesuai di tabel books
}
