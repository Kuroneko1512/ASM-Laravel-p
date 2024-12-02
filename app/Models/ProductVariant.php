<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'sku',
        'attribute_values',
        'price',
        'sale_price', 
        'quantity',
        'image',
        'is_active'
    ];

    protected $casts = [
        'attribute_values' => 'array',
        'is_active' => 'boolean',
        'price' => 'double',
        'sale_price' => 'double'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function images()
    {
        return $this->hasMany(VariantImage::class);
    }

    public function quantityPrices()
    {
        return $this->hasMany(VariantQuantityPrice::class);
    }

    public function inventoryLogs()
    {
        return $this->hasMany(VariantInventoryLog::class);
    }
}
