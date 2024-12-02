<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 
        'category_id',
        'sku',
        'image',
        'short_description',
        'long_description',
        'price',
        'sale_price',
        'quantity',
        'sold',
        'has_variants',
        'is_active'
    ];

    protected $casts = [
        'has_variants' => 'boolean',
        'is_active' => 'boolean',
        'price' => 'double',
        'sale_price' => 'double'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'product_attributes')
                    ->withPivot('is_required');
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }
}
