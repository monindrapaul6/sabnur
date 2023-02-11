<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    const notApplicableCats = [19];

    protected $fillable = [
        'offer_name',
        'offer_type',
        'offer_value',
        'offer_start',
        'offer_expiry',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];

    public function scopeActive(){
        return $this->where('status', true);
    }
}
