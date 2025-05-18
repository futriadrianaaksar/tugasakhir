<?php

   namespace App\Models;

   use Illuminate\Database\Eloquent\Model;

   class FineRule extends Model
   {
       protected $table = 'fine_rules';
       protected $fillable = ['amount', 'description'];
   }
