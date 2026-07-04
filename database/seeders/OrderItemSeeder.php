<?php

namespace Database\Seeders;

use App\Models\OrderItem;
use Illuminate\Database\Seeder;

class OrderItemSeeder extends Seeder
{
    public function run(): void
    {
        OrderItem::create([
            'order_id' => 1,
            'variant_id' => 1,
            'design_id' => 1,
            'quantity' => 2,
            'price' => 199.99,
        ]);

        OrderItem::create([
            'order_id' => 1,
            'variant_id' => 3,
            'design_id' => null,
            'quantity' => 1,
            'price' => 89.99,
        ]);

        OrderItem::create([
            'order_id' => 2,
            'variant_id' => 2,
            'design_id' => 2,
            'quantity' => 1,
            'price' => 209.99,
        ]);
    }
}
