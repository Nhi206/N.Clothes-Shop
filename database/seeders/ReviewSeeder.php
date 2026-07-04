<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        Review::create([
            'user_id' => 3,
            'product_id' => 1,
            'rating' => 5,
            'comment' => 'Great product and fast service.',
        ]);

        Review::create([
            'user_id' => 4,
            'product_id' => 2,
            'rating' => 4,
            'comment' => 'Nice hoodie fabric, print looks sharp.',
        ]);

        Review::create([
            'user_id' => 5,
            'product_id' => 3,
            'rating' => 4,
            'comment' => 'Phone case fits well and feels durable.',
        ]);
    }
}
