<?php

namespace Database\Seeders;

use App\Models\ProductVariant;
use Illuminate\Database\Seeder;

class ProductVariantSeeder extends Seeder
{
    public function run(): void
    {
        ProductVariant::create([
            'product_id' => 1,
            'sku' => 'AT-BASIC-WHT-S',
            'size' => 'S',
            'color' => 'White',
            'price' => 199.99,
            'stock_quantity' => 40,
        ]);

        ProductVariant::create([
            'product_id' => 1,
            'sku' => 'AT-BASIC-BLK-M',
            'size' => 'M',
            'color' => 'Black',
            'price' => 199.99,
            'stock_quantity' => 35,
        ]);

        ProductVariant::create([
            'product_id' => 2,
            'sku' => 'AS-CASUAL-M',
            'size' => 'M',
            'color' => 'Light Blue',
            'price' => 329.99,
            'stock_quantity' => 25,
        ]);

        ProductVariant::create([
            'product_id' => 2,
            'sku' => 'AS-CASUAL-L',
            'size' => 'L',
            'color' => 'White',
            'price' => 329.99,
            'stock_quantity' => 18,
        ]);

        ProductVariant::create([
            'product_id' => 3,
            'sku' => 'HOODIE-OVR-M',
            'size' => 'M',
            'color' => 'Grey',
            'price' => 359.99,
            'stock_quantity' => 22,
        ]);

        ProductVariant::create([
            'product_id' => 3,
            'sku' => 'HOODIE-OVR-L',
            'size' => 'L',
            'color' => 'Navy',
            'price' => 359.99,
            'stock_quantity' => 16,
        ]);

        ProductVariant::create([
            'product_id' => 4,
            'sku' => 'CT-BASIC-S',
            'size' => 'S',
            'color' => 'Pink',
            'price' => 189.99,
            'stock_quantity' => 30,
        ]);

        ProductVariant::create([
            'product_id' => 5,
            'sku' => 'ATD-SILK-S',
            'size' => 'S',
            'color' => 'Beige',
            'price' => 249.99,
            'stock_quantity' => 20,
        ]);

        ProductVariant::create([
            'product_id' => 6,
            'sku' => 'BT-RETRO-M',
            'size' => 'M',
            'color' => 'Yellow',
            'price' => 209.99,
            'stock_quantity' => 28,
        ]);
    }
}
