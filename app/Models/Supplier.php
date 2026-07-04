<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ImportOrder;

class Supplier extends Model
{
    protected $fillable = [
        'name',
        'contact',
    ];

    public function importOrders()
    {
        return $this->hasMany(ImportOrder::class, 'supplier_id');
    }
}
