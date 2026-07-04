<?php

namespace Database\Seeders;

use App\Models\Cart;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    public function run(): void
    {
        Cart::create(['user_id' => 3]);
        Cart::create(['user_id' => 4]);
    }
}
