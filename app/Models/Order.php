<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    protected $fillable = [
        'user_id',
        'address_id',
        'order_no',
        'sub_total',
        'discount',
        'delivery_charge',
        'cod_charge',
        'special_discount',
        'total',
        'payment_mode',
        'payment_amount',
        'payment_date',
        'transaction_id',
        'order_status',
        'courier_awb_code',
        'courier_courier_name',
        'razorpay_order',
        'razorpay_order_id',
        'razorpay_payment_id',
        'payment_status',
        'is_paid',
        'status'
    ];

    /*
     * order_status = ['ORDER GENERATED', 'ORDER PROCESSED', 'ORDER SHIPPED', 'ORDER DELIVERED'];
     */

    const PAYMENT_PENDING = 'pending';
    const PAYMENT_SUCCESS = 'success';
    const PAYMENT_CANCEL = 'cancelled';

    protected $casts = [
        'is_paid' => 'boolean',
        'status' => 'boolean'
    ];

    public function scopeActive(){
        return $this->where('status', true);
    }

    //order has many invoices
    public function orderInvoices(){
        return $this->hasMany(Invoice::class);
    }

    public function order_address(){
        return $this->hasOne(Address::class, 'id', 'address_id');
    }
}
