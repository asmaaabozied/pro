<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CouponDetail extends Model
{
    public $timestamps= false;
    //
    // public $table = 'coupon_details';
    public $fillable = [
        'coupon_id',
        'title_en',
        'title_ar',
        'discount',
        'start_at',
        'end_at',
        'old_price',
        'new_price',
    ];
    
}
