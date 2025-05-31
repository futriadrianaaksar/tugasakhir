<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';
    protected $fillable = ['tittle', 'author', 'isbn', 'stock'];

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}
