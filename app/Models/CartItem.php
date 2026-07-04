<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = [
        'cart_id',
        'product_id',
        'variant_id',
        'design_id',
        'quantity',
    ];

    public function getUnitPriceAttribute()
    {
        return $this->design_id ? 250000 : ($this->product->price ?? 0);
    }

    public function getSubtotalAttribute()
    {
        return $this->quantity * $this->unit_price;
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'variant_id');
    }

    public function design()
    {
        return $this->belongsTo(Design::class, 'design_id');
    }
}
