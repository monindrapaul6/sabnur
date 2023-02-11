<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'rating',
        'comment'
    ];

    //Review has User
    public function reviewUser()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
