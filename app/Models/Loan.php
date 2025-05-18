<?php

   namespace App\Models;

   use Illuminate\Database\Eloquent\Model;

   class Loan extends Model
   {
       protected $table = 'loans';
       protected $fillable = ['user_id', 'book_id', 'loan_date', 'return_due_date', 'status'];

       public function user()
       {
           return $this->belongsTo(User::class, 'user_id');
       }

       public function book()
       {
           return $this->belongsTo(Book::class, 'book_id');
       }
   }
