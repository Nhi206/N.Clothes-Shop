<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class Promotion extends Model
{
    protected $fillable = [
        'code',
        'discount_type',
        'discount_value',
        'min_order_amount',
        'start_date',
        'end_date',
        'usage_limit',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'discount_value' => 'decimal:2',
        'min_order_amount' => 'decimal:2',
    ];

    public function getDiscountValueFormattedAttribute()
    {
        $value = (string) $this->discount_value;

        return rtrim(rtrim($value, '0'), '.') ?: '0';
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'promo_id');
    }
}
