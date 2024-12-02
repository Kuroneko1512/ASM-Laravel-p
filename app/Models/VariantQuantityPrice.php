<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariantQuantityPrice extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'product_variant_id',
        'min_quantity',
        'max_quantity',
        'price'
    ];

    protected $casts = [
        'price' => 'double'
    ];

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class);
    }
}
