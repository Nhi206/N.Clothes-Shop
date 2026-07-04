<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'rating',
        'comment',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /**
     * Get rating as integer (1-5)
     */
    public function getRatingAttribute($value)
    {
        return (int) $value;
    }

    /**
     * Get star display
     */
    public function getStarDisplayAttribute()
    {
        return str_repeat('⭐', $this->rating);
    }

    /**
     * Scope to get average rating
     */
    public static function getAverageRating($productId)
    {
        return self::where('product_id', $productId)->avg('rating') ?? 0;
    }

    /**
     * Scope to get review count
     */
    public static function getReviewCount($productId)
    {
        return self::where('product_id', $productId)->count();
    }

    /**
     * Check if user can review product (must have purchased it)
     */
    public static function canUserReview($userId, $productId)
    {
        return Order::where('user_id', $userId)
                    ->where('status', 'completed')
                    ->whereHas('orderItems', function ($q) use ($productId) {
                        $q->where('product_id', $productId);
                    })
                    ->exists();
    }

    /**
     * Get user's review for a product (if exists)
     */
    public static function getUserReview($userId, $productId)
    {
        return self::where('user_id', $userId)
                   ->where('product_id', $productId)
                   ->first();
    }
}
