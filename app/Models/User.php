<?php

   namespace App\Models;

   use Illuminate\Foundation\Auth\User as Authenticatable;
   use Illuminate\Notifications\Notifiable;

   class User extends Authenticatable
   {
       use Notifiable;

       protected $fillable = [
           'name', 'email', 'password', 'role',
       ];

       protected $hidden = [
           'password',
       ];

       protected $casts = [
           'email_verified_at' => 'datetime',
       ];

       // Nonaktifkan remember_token
       public function getRememberToken()
       {
           return null; // Tidak menggunakan remember_token
       }

       public function setRememberToken($value)
       {
           // Kosongkan fungsi ini
       }

       public function getRememberTokenName()
       {
           return null; // Tidak ada kolom remember_token
       }
   }
