<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    public function run(): void
    {
        Banner::create([
            'title' => 'Spring Sale',
            'image_url' => 'https://example.com/images/banner-spring.jpg',
            'link' => 'https://example.com/sale',
            'status' => 'active',
        ]);

        Banner::create([
            'title' => 'Free Shipping Over 1M',
            'image_url' => 'https://example.com/images/banner-shipping.jpg',
            'link' => 'https://example.com/free-shipping',
            'status' => 'active',
        ]);
    }
}
