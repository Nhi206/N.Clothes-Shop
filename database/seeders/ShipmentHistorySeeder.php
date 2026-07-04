<?php

namespace Database\Seeders;

use App\Models\ShipmentHistory;
use Illuminate\Database\Seeder;

class ShipmentHistorySeeder extends Seeder
{
    public function run(): void
    {
        ShipmentHistory::create([
            'shipment_id' => 1,
            'status' => 'created',
            'timestamp' => now()->subDays(1),
        ]);

        ShipmentHistory::create([
            'shipment_id' => 1,
            'status' => 'packing',
            'timestamp' => now()->subHours(12),
        ]);

        ShipmentHistory::create([
            'shipment_id' => 2,
            'status' => 'shipped',
            'timestamp' => now()->subHours(6),
        ]);
    }
}
