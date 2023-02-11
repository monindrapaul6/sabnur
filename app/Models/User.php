<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const STATUS_ACTIVE = "ACTIVE";
    const STATUS_INACTIVE = "INACTIVE";

    const PERMISSION_ADMIN = 'ADMIN';
    const PERMISSION_MANAGER = 'MANAGER';
    const PERMISSION_CUSTOMER = 'CUSTOMER';

    const DefaultPassword = '12345678';

const NewName = 'Guest';	

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firebase_id',
        'name',
        'email',
        'mobile',
        'password',
        'permission',
        'status'
    ];

    /*
     * permission = ['ADMIN','MANAGER','CUSTOMER'];
     */

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'mobile_verified_at' => 'datetime',
    ];

    public function scopeActive(){
        return $this->where('status', 'ACTIVE');
    }

    //User has many address
    public function user_addresses(){
        return $this->hasMany(Address::class);
    }

    //User has Default Address
    public function userDefaultAddress(){
        return $this->hasOne(Address::class)->where('is_primary', true);
    }
}
