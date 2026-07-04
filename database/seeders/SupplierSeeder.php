<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        Supplier::create([
            'name' => 'Print Supplies Co.',
            'contact' => 'supplier@example.com - +84 912345678',
        ]);

        Supplier::create([
            'name' => 'Packaging Partners Ltd.',
            'contact' => 'contact@packpartners.vn - +84 934567891',
        ]);
    }
}
