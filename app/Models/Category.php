<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug', 
        'parent_id',
        'image',
        'description',
        'position',
        'is_featured',
        'is_active'
    ];

    // Quan hệ với danh mục cha
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Quan hệ với danh mục con
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // Quan hệ với sản phẩm
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    // Lấy tất cả danh mục con (không giới hạn độ sâu)
    public function allChildren()
    {
        return $this->children()->with('allChildren');
    }

    // Lấy tất cả danh mục cha (không giới hạn độ sâu) 
    public function allParents()
    {
        return $this->parent()->with('allParents');
    }

    // Scope query lấy danh mục active
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope query lấy danh mục featured
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
