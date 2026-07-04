<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'order_id',
        'method',
        'status',
        'transaction_code',
        'paid_at',
        'amount',
        'bank_provider',
        'bank_account_name',
        'bank_account_number',
    ];

    protected $casts = [
        'paid_at' => 'datetime',
        'amount' => 'decimal:2',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
