<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role',
        'status',
    ];

    protected $hidden = [
        'password',
    ];

    public function addresses()
    {
        return $this->hasMany(Address::class, 'user_id');
    }

    public function designs()
    {
        return $this->hasMany(Design::class, 'user_id');
    }

    public function cart()
    {
        return $this->hasOne(Cart::class, 'user_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'user_id');
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class, 'user_id');
    }

    public function supportTickets()
    {
        return $this->hasMany(SupportTicket::class, 'user_id');
    }

    public function assignedTickets()
    {
        return $this->hasMany(SupportTicket::class, 'staff_id');
    }

    public function news()
    {
        return $this->hasMany(News::class, 'author_id');
    }

    public function importOrders()
    {
        return $this->hasMany(ImportOrder::class, 'user_id');
    }
}
