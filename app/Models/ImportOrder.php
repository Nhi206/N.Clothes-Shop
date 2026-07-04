<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImportOrder extends Model
{
    protected $fillable = [
        'supplier_id',
        'user_id',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function importItems()
    {
        return $this->hasMany(ImportItem::class, 'import_id');
    }
}
