<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    const STATUS_ACTIVE = 'ACTIVE';
    const STATUS_INACTIVE = 'INACTIVE';

    use HasFactory;

    protected $fillable = [
        'image_title',
        'image_alt',
        'image_full',
        'image_thumb',
        'image_small',
        'is_default',
        'status'
    ];

    protected $casts = [
        'is_default' => 'boolean'
    ];

    public function getDefaultImage()
    {
        return Picture::where('is_default', true)->first();
    }

}
