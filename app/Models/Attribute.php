<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name', 
        'display_name', 
        'position', 
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function values()
    {
        return $this->hasMany(AttributeValue::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_attributes')
                    ->withPivot('is_required');
    }
}
