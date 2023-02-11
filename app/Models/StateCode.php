<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StateCode extends Model
{
    use HasFactory;

    protected $fillable = ['state_name', 'state_code'];

    public $timestamps = false;
}
