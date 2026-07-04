<?php

namespace Database\Seeders;

use App\Models\Inventory;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class InventorySeeder extends Seeder
{
    public function run(): void
    {
        $supplierId = Supplier::inRandomOrder()->value('id');
        $products = Product::orderBy('id')->take(6)->get();

        if ($products->isEmpty()) {
            $this->command->info('InventorySeeder: no products found, skipping inventory creation.');
            return;
        }

        foreach ($products as $product) {
            Inventory::create([
                'product_id' => $product->id,
                'quantity' => rand(10, 80),
                'location' => 'Kho chính',
                'supplier_id' => $supplierId,
                'cost_price' => rand(150000, 450000) / 100,
            ]);
        }
    }
}
