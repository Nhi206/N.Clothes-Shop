<?php

namespace Database\Seeders;

use App\Models\SupportTicket;
use Illuminate\Database\Seeder;

class SupportTicketSeeder extends Seeder
{
    public function run(): void
    {
        SupportTicket::create([
            'user_id' => 3,
            'staff_id' => 2,
            'message' => 'I have a question about my order.',
            'status' => 'open',
        ]);

        SupportTicket::create([
            'user_id' => 4,
            'staff_id' => 2,
            'message' => 'Can I change my shipping address?',
            'status' => 'pending',
        ]);

        SupportTicket::create([
            'user_id' => 5,
            'staff_id' => null,
            'message' => 'Please help with my promo code not applying.',
            'status' => 'open',
        ]);
    }
}
