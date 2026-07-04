<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'is_customizable',
        'category_id',
        'brand_id',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class, 'product_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function designs()
    {
        return $this->hasMany(Design::class, 'product_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id');
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class, 'product_id');
    }

    public function importItems()
    {
        return $this->hasMany(ImportItem::class, 'product_id');
    }

    /**
     * Get average rating for this product
     */
    public function getAverageRating()
    {
        return $this->reviews()->avg('rating') ?? 0;
    }

    /**
     * Get rounded average rating
     */
    public function getRoundedAverageRating()
    {
        return round($this->getAverageRating(), 1);
    }

    /**
     * Get total review count
     */
    public function getReviewCount()
    {
        return $this->reviews()->count();
    }

    /**
     * Get rating percentage for each star (1-5)
     */
    public function getRatingDistribution()
    {
        $total = $this->getReviewCount();
        if ($total === 0) {
            return [5 => 0, 4 => 0, 3 => 0, 2 => 0, 1 => 0];
        }

        $distribution = [];
        for ($i = 5; $i >= 1; $i--) {
            $count = $this->reviews()->where('rating', $i)->count();
            $distribution[$i] = round(($count / $total) * 100);
        }
        return $distribution;
    }
}
