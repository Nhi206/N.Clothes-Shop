<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'address_id',
        'promo_id',
        'total_amount',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }

    public function promotion()
    {
        return $this->belongsTo(Promotion::class, 'promo_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'order_id');
    }

    public function shipment()
    {
        return $this->hasOne(Shipment::class, 'order_id');
    }
}
