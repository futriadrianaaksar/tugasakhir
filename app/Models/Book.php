<?php

   namespace App\Models;

   use Illuminate\Database\Eloquent\Model;

   class Book extends Model
   {
       protected $table = 'books';
       protected $fillable = ['title', 'author', 'isbn', 'stock'];

       public function loans()
       {
           return $this->hasMany(Loan::class, 'book_id');
       }
   }
