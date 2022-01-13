<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CouponFavs extends Model
{
    //
    public $table = 'coupon_favs';
    public $fillable = ['coupon_id','user_id'];
}
