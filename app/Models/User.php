<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'user';

    protected $fillable = ['name', 'email', 'password', 'role'];

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}
