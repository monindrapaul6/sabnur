<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    protected $fillable = [
        'category_id',
        'product_dp',
        'hsn_no',
        'product_name',
        'product_slug',
        'product_summary',
        'product_details',
        'product_mrp_price',
        'product_current_price',
        'product_discount',
        'unit_price',
        'net_amount',
        'tax_rate',
        'tax_amount',
        'is_combo',
        'combo_discount',
        'discounted_price',
        'price_round',
        'num_of_views',
        'rating',
        'num_of_rating',
        'stock_status',
        'status'
    ];

    /*
     * product_condition = [Refurbished, Open Box, Brand New];
     */

    protected $casts = [
        'stock_status' => 'boolean',
        'is_newarrival' => 'boolean',
        'is_bestseller' => 'boolean',
        'status' => 'boolean'
    ];

    //active products
    public function scopeActive(){
        return $this->where('status', true);
    }

    //product category
    public function product_category(){
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    //Product has one DP Picture
    public function productDPImage(){
        return $this->hasOne(Picture::class, 'id', 'product_dp');
    }

    //Product has many Pictures
    public function productPictures(){
        return $this->belongsToMany(Picture::class);
    }

    //product reviews
    public function productReviews(){
        return $this->hasMany(Review::class);
    }
}
