<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Supplier;

class Inventory extends Model
{
    protected $fillable = [
        'product_id',
        'quantity',
        'location',
        'supplier_id',
        'cost_price',
    ];

    protected $casts = [
        'cost_price' => 'decimal:2',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
