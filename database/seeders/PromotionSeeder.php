<?php

namespace Database\Seeders;

use App\Models\Promotion;
use Illuminate\Database\Seeder;

class PromotionSeeder extends Seeder
{
    public function run(): void
    {
        Promotion::create([
            'code' => 'WELCOME10',
            'discount_type' => 'percent',
            'discount_value' => 10.00,
            'start_date' => now()->subDays(1),
            'end_date' => now()->addDays(30),
            'usage_limit' => 100,
        ]);

        Promotion::create([
            'code' => 'FLAT50',
            'discount_type' => 'fixed',
            'discount_value' => 50.00,
            'start_date' => now()->subDays(5),
            'end_date' => now()->addDays(20),
            'usage_limit' => 50,
        ]);

        Promotion::create([
            'code' => 'SUMMER20',
            'discount_type' => 'percent',
            'discount_value' => 20.00,
            'start_date' => now()->addDays(1),
            'end_date' => now()->addDays(45),
            'usage_limit' => 200,
        ]);
    }
}
