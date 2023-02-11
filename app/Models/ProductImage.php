<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'product_image_title',
        'product_image_full',
        'product_image_thumb',
        'picture_order',
        'is_dp'
    ];

    protected $casts = [
        'is_dp' => 'boolean'
    ];
}
