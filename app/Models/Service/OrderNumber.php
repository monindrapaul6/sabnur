<?php

namespace App\Models\Service;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderNumber extends Model
{
    use HasFactory;

    public $fillable = [
        'order_id',
        'order_no',
        'order_unique_no',
        'invoice_no',
        'invoice_unique_no'
    ];

    const INVOICE_PREFIX = 'SABIN';
    const ORDER_PREFIX = 'SABOD';
}
