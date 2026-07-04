<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('Password123!'),
            'phone' => '0123456789',
            'role' => 'admin',
            'status' => 'active',
        ]);

        User::create([
            'name' => 'Staff User',
            'email' => 'staff@example.com',
            'password' => Hash::make('Password123!'),
            'phone' => '0987654321',
            'role' => 'staff',
            'status' => 'active',
        ]);

        User::create([
            'name' => 'Customer Nguyen',
            'email' => 'customer.nguyen@example.com',
            'password' => Hash::make('Password123!'),
            'phone' => '0912345678',
            'role' => 'customer',
            'status' => 'active',
        ]);

        User::create([
            'name' => 'Customer Linh',
            'email' => 'linh.customer@example.com',
            'password' => Hash::make('Password123!'),
            'phone' => '0938811223',
            'role' => 'customer',
            'status' => 'active',
        ]);

        User::create([
            'name' => 'Designer Hoa',
            'email' => 'hoa.designer@example.com',
            'password' => Hash::make('Password123!'),
            'phone' => '0901122334',
            'role' => 'staff',
            'status' => 'active',
        ]);
    }
}
