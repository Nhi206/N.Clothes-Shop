<?php

namespace Database\Seeders;

use App\Models\ImportOrder;
use Illuminate\Database\Seeder;

class ImportOrderSeeder extends Seeder
{
    public function run(): void
    {
        ImportOrder::create([
            'supplier_id' => 1,
            'user_id' => 1,
        ]);

        ImportOrder::create([
            'supplier_id' => 2,
            'user_id' => 2,
        ]);
    }
}
