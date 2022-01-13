<?php

namespace App\Models;

use App\User;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class CouponRating extends Model
{
    // use SoftDeletes;

    public $table = 'coupon_ratings';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'user_id',
        'coupon_id',
        'rate',
        'review'
    ];

  
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'required|exists:users,id',
        'coupon_id' => 'required|exists:coupons,id',
        'rate' => 'float',
        'review' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required|exists:users,id',
        'coupon_id' => 'required|exists:coupons,id',
        'rate' => 'required|numeric|min:0|max:5',
        'review' => 'required'
    ];
   
    public function user()
    {
        return $this->belongsTo(User::class);
    }

   
    public function coupon()
    {
        return $this->belongsTo(Coupon::class, 'coupon_id');
    }

   
    public function likeList()
    {
        return $this->hasMany(CouponRatingLikes::class, 'coupon_rating_id');
    }

    
    public function likes()
    {
        return $this->hasMany(CouponRatingLikes::class, 'coupon_rating_id')->where('like', true)->count();
    }


    public function isLiked($user_id)
    {
        return $this->hasMany(CouponRatingLikes::class, 'coupon_rating_id')->where('like', true)
                    ->where('user_id', $user_id)->exists();
    }

    
    public function dislikes()
    {
        return $this->hasMany(CouponRatingLikes::class, 'coupon_rating_id')->where('like', false)->count();
    }

    
    public function isDisliked($user_id)
    {
        return $this->hasMany(CouponRatingLikes::class, 'coupon_rating_id')->where('like', false)
            ->where('user_id', $user_id)->exists();
    }
}
