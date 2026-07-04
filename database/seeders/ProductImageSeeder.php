<?php

namespace Database\Seeders;

use App\Models\ProductImage;
use Illuminate\Database\Seeder;

class ProductImageSeeder extends Seeder
{
    public function run(): void
    {
        ProductImage::create([
            'product_id' => 1,
            'image_url' => 'images/thun.jpg',
        ]);

        ProductImage::create([
            'product_id' => 1,
            'image_url' => 'images/thun.jpg',
        ]);

        ProductImage::create([
            'product_id' => 2,
            'image_url' => 'images/somi.jpg',
        ]);

        ProductImage::create([
            'product_id' => 3,
            'image_url' => 'images/hoodie.jpg',
        ]);

        ProductImage::create([
            'product_id' => 4,
            'image_url' => 'images/crop.jpg',
        ]);

        ProductImage::create([
            'product_id' => 5,
            'image_url' => 'images/day.jpg',
        ]);

        ProductImage::create([
            'product_id' => 6,
            'image_url' => 'images/baby.jpg',
        ]);
    }
}
