<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create(['name' => 'Áo thun']);
        Category::create(['name' => 'Áo sơ mi']);
        Category::create(['name' => 'Áo hoodie']);
        Category::create(['name' => 'Áo croptop']);
        Category::create(['name' => 'Áo hai dây']);
        Category::create(['name' => 'Áo babytee']);
    }
}
