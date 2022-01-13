<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CouponLikes extends Model
{
    //
    public $table = 'coupon_likes';
    public $fillable = ['coupon_id','user_id'];
}
