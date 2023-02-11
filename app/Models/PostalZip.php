<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PostalZip extends Model
{
    use HasFactory;

    protected $fillable = [
        'zip_code',
        'is_cod',
        'is_delivery'
    ];

    public static function insertData($data){
        $value=DB::table('postal_zips')->where('zip', $data['zip'])->get();
        if($value->count() == 0){
            DB::table('postal_zips')->insert($data);
        }
    }
}
