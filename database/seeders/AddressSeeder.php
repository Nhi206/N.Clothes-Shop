<?php

namespace Database\Seeders;

use App\Models\Address;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    public function run(): void
    {
        Address::create([
            'user_id' => 1,
            'address_detail' => '123 Example Street, District 1, Ho Chi Minh City',
            'is_default' => true,
        ]);

        Address::create([
            'user_id' => 3,
            'address_detail' => '456 Another Road, Ba Dinh, Hanoi',
            'is_default' => true,
        ]);

        Address::create([
            'user_id' => 4,
            'address_detail' => '789 Green Avenue, Hai Ba Trung, Hanoi',
            'is_default' => true,
        ]);

        Address::create([
            'user_id' => 5,
            'address_detail' => '22 Nguyen Hue, Da Nang',
            'is_default' => true,
        ]);
    }
}
