<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Mahasiswa',
            'email' => 'mahasiswa@test.com',
            'password' => bcrypt('password'),
            'role' => 'mahasiswa',
        ]);
    }
}
