<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'user_id',
        'address_detail',
        'phone',
        'is_default',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
