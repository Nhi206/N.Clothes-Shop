<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImportItem extends Model
{
    protected $fillable = [
        'import_id',
        'product_id',
        'quantity',
        'price',
    ];

    public function importOrder()
    {
        return $this->belongsTo(ImportOrder::class, 'import_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
