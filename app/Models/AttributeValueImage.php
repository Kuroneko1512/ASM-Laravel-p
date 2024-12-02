<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeValueImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'attribute_value_id',
        'image'
    ];

    public function attributeValue()
    {
        return $this->belongsTo(AttributeValue::class);
    }
}