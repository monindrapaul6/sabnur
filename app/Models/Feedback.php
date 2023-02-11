<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    protected $fillable = [
        'user_id',
        'invoice_id',
        'order_id',
        'rating',
        'description',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];

    public function scopeActive(){
        return $this->where('status', true);
    }
}
