<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'product_name',
        'product_current_price',
        'product_quantity',
        'product_total_price',
        'cart_data'
    ];

    public function cartCount(){
        if(Auth::user() == null) {
            $apCarts = session()->get('cart');
            return isset($apCarts) ? count(array_keys($apCarts)) : 0;
        }
        else{
            return Cart::where('user_id', Auth::user()->id)->count();
        }
    }

    public function cart_product(){
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
