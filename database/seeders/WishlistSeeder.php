<?php

namespace Database\Seeders;

use App\Models\Wishlist;
use Illuminate\Database\Seeder;

class WishlistSeeder extends Seeder
{
    public function run(): void
    {
        Wishlist::create([
            'user_id' => 3,
            'product_id' => 2,
        ]);

        Wishlist::create([
            'user_id' => 4,
            'product_id' => 1,
        ]);

        Wishlist::create([
            'user_id' => 4,
            'product_id' => 4,
        ]);

        Wishlist::create([
            'user_id' => 5,
            'product_id' => 3,
        ]);
    }
}
