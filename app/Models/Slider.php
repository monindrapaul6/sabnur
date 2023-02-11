<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
        'picture_id',
        'slider_url',
        'slider_type',
        'slider_order',
        'status'
    ];

    public function SliderPicture(){
        return $this->hasOne(Picture::class, 'id', 'picture_id');
    }
}
