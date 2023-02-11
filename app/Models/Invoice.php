<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    protected $fillable = [
        'order_id',
        'user_id',
        'address_id',
        'product_id',
        'order_no',
        'invoice_no',
        'product_mrp_price',
        'product_current_price',
        'unit_price',
        'net_amount',
        'tax_rate',
        'tax_amount',
        'product_quantity',
        'special_discount',
        'product_total_price',
        'courier_awb_code',
        'courier_courier_name',
        'order_status',
        'payment_status',
        'is_paid',
        'status'
    ];

    protected $casts = [
        'is_paid' => 'boolean',
        'status' => 'boolean'
    ];

    public function scopeActive(){
        return $this->where('status', true);
    }

    //Invoice has order no
    public function InvoiceOrder(){
        return $this->hasOne(Order::class, 'id', 'invoice_id');
    }

    //invoice has user
    public function invoice_user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    //invoice has address
    public function invoice_address(){
        return $this->hasOne(Address::class, 'id', 'address_id');
    }

    //invoice has products
    public function invoiceProduct(){
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    //invoice has user feedback
    public function invoiceUserFeedback($user_id){
        return $this->hasOne(Feedback::class)->where('user_id', $user_id)->first();
    }
}
