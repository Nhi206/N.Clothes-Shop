<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        Payment::create([
            'order_id' => 1,
            'method' => 'credit_card',
            'status' => 'pending',
            'transaction_code' => 'TXN123456',
            'paid_at' => null,
        ]);

        Payment::create([
            'order_id' => 2,
            'method' => 'paypal',
            'status' => 'paid',
            'transaction_code' => 'PAYPAL7890',
            'paid_at' => now()->subHour(),
        ]);
    }
}
