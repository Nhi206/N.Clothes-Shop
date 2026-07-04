<?php

namespace Database\Seeders;

use App\Models\CartItem;
use Illuminate\Database\Seeder;

class CartItemSeeder extends Seeder
{
    public function run(): void
    {
        CartItem::create([
            'cart_id' => 1,
            'variant_id' => 1,
            'design_id' => 1,
            'quantity' => 2,
        ]);

        CartItem::create([
            'cart_id' => 1,
            'variant_id' => 3,
            'design_id' => null,
            'quantity' => 1,
        ]);

        CartItem::create([
            'cart_id' => 2,
            'variant_id' => 6,
            'design_id' => 3,
            'quantity' => 1,
        ]);
    }
}
