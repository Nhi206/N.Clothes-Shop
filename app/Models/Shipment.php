<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    protected $fillable = [
        'order_id',
        'tracking_code',
        'status',
        'estimated_date',
        'shipping_address',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function shipmentHistories()
    {
        return $this->hasMany(ShipmentHistory::class, 'shipment_id');
    }
}
