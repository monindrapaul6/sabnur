<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    protected $fillable = [
        'parent_id',
        'category_name',
        'category_slug',
        'category_image_full',
        'category_image_thumb',
        'category_order',
        'tax_rate',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];

    //category is active
    public function scopeActive(){
        return $this->where('status', true);
    }

    //category is parent
    public function scopeParentCategory(){
        return $this->where('tax_rate', '0');
    }

    //Category has many products
    public function category_products(){
        return $this->hasMany(Product::class)->where('status', 'ACTIVE')->orderBy('product_name', 'ASC');
    }

    //category parent
    public function parent()
    {
        return $this->hasOne(self::class, 'id', 'parent_id');
    }

    //category children
    public function children()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }
}
