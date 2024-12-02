<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariantInventoryLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_variant_id',
        'quantity_change',
        'type',
        'note',
        'user_id'
    ];

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
