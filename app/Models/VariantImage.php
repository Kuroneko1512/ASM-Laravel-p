<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariantImage extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'product_variant_id',
        'image',
        'position'
    ];

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class);
    }
}
