<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Design extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'design_data',
        'preview_image',
        'preview_image_front',
        'preview_image_back',
        'expired_at',
    ];

    protected $casts = [
        'design_data' => 'array',
        'expired_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class, 'design_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'design_id');
    }
}
