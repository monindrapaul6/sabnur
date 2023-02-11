<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    protected $fillable = [
        'user_id',
        'name',
        'contact_no',
        'street',
        'city',
        'country',
        'state',
        'state_code',
        'zip',
        'locality',
        'landmark',
        'is_primary',
        'status'
    ];

    protected $casts = [
        'is_primary' => 'boolean',
        'status' => 'boolean'
    ];

    public function scopeActive(){
        return $this->where('status', true);
    }

    //Address has user
    public function address_user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
