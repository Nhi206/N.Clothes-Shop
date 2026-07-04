<?php

namespace Database\Seeders;

use App\Models\Shipment;
use Illuminate\Database\Seeder;

class ShipmentSeeder extends Seeder
{
    public function run(): void
    {
        Shipment::create([
            'order_id' => 1,
            'tracking_code' => 'TRACK123',
            'status' => 'preparing',
            'estimated_date' => now()->addDays(5),
            'shipping_address' => '123 Example Street, District 1, Ho Chi Minh City',
        ]);

        Shipment::create([
            'order_id' => 2,
            'tracking_code' => 'TRACK456',
            'status' => 'shipped',
            'estimated_date' => now()->addDays(3),
            'shipping_address' => '789 Green Avenue, Hai Ba Trung, Hanoi',
        ]);
    }
}
