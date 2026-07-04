<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        Brand::create(['name' => 'PrintWorks']);
        Brand::create(['name' => 'UrbanInk']);
        Brand::create(['name' => 'CaseCraft']);
        Brand::create(['name' => 'PosterLab']);
    }
}
