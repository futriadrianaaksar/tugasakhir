<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FineRule;

class FineRuleSeeder extends Seeder
{
    public function run()
    {
        FineRule::create([
            'amount_per_day' => 1000.00,
            'max_days' => 7,
        ]);
    }
}
