<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShipmentHistory extends Model
{
    protected $fillable = [
        'shipment_id',
        'status',
        'timestamp',
    ];

    public function shipment()
    {
        return $this->belongsTo(Shipment::class, 'shipment_id');
    }
}
