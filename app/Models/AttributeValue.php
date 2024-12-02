<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'attribute_id',
        'value',
        'display_value',
        'position',
        'color_code',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    public function images()
    {
        return $this->hasMany(AttributeValueImage::class);
    }
}
