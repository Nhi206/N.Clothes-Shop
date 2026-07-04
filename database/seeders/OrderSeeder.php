<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        Order::create([
            'user_id' => 3,
            'address_id' => 1,
            'promo_id' => 1,
            'total_amount' => 419.98,
            'status' => 'pending',
        ]);

        Order::create([
            'user_id' => 4,
            'address_id' => 3,
            'promo_id' => 2,
            'total_amount' => 529.97,
            'status' => 'processing',
        ]);
    }
}
