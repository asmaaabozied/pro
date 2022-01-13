<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CouponImage extends Model
{
    // use SoftDeletes;
    public $table = 'coupon_images';
    // protected $dates = ['deleted_at'];

    public $fillable = [
        'coupon_id',
        'image',
        // 'active',
        // 'main'
    ];

    protected $casts = [
        'id' => 'integer',
        'coupon_id' => 'integer',
        'image' => 'string',
        // 'active' => 'boolean',
        // 'main' => 'boolean'
    ];

    public static $rules = [
        'coupon_id' => 'required|exists:coupons,id',
        'image' => 'required'
    ];


    // public function coupon(){
    //     return $this->belongsTo(Coupon::class);
    // }
}
