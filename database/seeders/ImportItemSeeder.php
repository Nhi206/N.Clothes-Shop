<?php

namespace Database\Seeders;

use App\Models\ImportItem;
use Illuminate\Database\Seeder;

class ImportItemSeeder extends Seeder
{
    public function run(): void
    {
        ImportItem::create([
            'import_id' => 1,
            'product_id' => 2,
            'quantity' => 50,
            'price' => 120.00,
        ]);

        ImportItem::create([
            'import_id' => 2,
            'product_id' => 3,
            'quantity' => 200,
            'price' => 45.00,
        ]);
    }
}
