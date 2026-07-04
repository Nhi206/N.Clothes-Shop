<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'name' => 'Áo thun Basic Cotton',
            'description' => 'Áo thun cotton mềm mại, phù hợp in ấn và phối đồ hàng ngày.',
            'category_id' => 1,
            'brand_id' => 1,
            'status' => 'active',
        ]);

        Product::create([
            'name' => 'Áo sơ mi Casual',
            'description' => 'Áo sơ mi kiểu dáng casual cho công sở và dạo phố.',
            'category_id' => 2,
            'brand_id' => 2,
            'status' => 'active',
        ]);

        Product::create([
            'name' => 'Áo hoodie Oversize',
            'description' => 'Áo hoodie oversized giữ ấm, phong cách streetwear.',
            'category_id' => 3,
            'brand_id' => 1,
            'status' => 'active',
        ]);

        Product::create([
            'name' => 'Áo croptop Basic',
            'description' => 'Áo croptop trẻ trung, dễ phối với quần cạp cao.',
            'category_id' => 4,
            'brand_id' => 2,
            'status' => 'active',
        ]);

        Product::create([
            'name' => 'Áo hai dây Silk',
            'description' => 'Áo hai dây mảnh mai, phù hợp mùa hè và dạo phố.',
            'category_id' => 5,
            'brand_id' => 1,
            'status' => 'active',
        ]);

        Product::create([
            'name' => 'Áo babytee Retro',
            'description' => 'Áo babytee phong cách retro, đường may tỉ mỉ.',
            'category_id' => 6,
            'brand_id' => 2,
            'status' => 'active',
        ]);
    }
}
