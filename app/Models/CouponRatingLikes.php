<?php

namespace App\Models;

use App\User;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CouponRatingLikes extends Model
{
    // use SoftDeletes;

    public $table = 'coupon_ratings_likes';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'coupon_rating_id',
        'like',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'required|exists:users,id',
        'coupon_rating_id' => 'required|exists:coupon_ratings,id',
        'like' => 'boolean',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required|exists:users,id',
        'coupon_rating_id' => 'required|exists:coupon_ratings,id',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function couponRating()
    {
        return $this->belongsTo(CouponRating::class, 'coupon_rating_id');
    }

    static public function addLike($coupon_rating_id, $user_id)
    {
        $query = CouponRatingLikes::where('user_id', $user_id)->where('coupon_rating_id', $coupon_rating_id);
        if($query->exists()){
            $rating = $query->first();
            $rating->fill(['like' => true])->save();
        } else {
            $rating = new CouponRatingLikes();
            $rating->fill([
                'like'              => true,
                'user_id'           => $user_id,
                'coupon_rating_id' => $coupon_rating_id,
            ])->save();
        }
    }


    static public function removeLike($coupon_rating_id, $user_id)
    {
        
        $query = CouponRatingLikes::where('user_id', $user_id)->where('coupon_rating_id', $coupon_rating_id)->where('like', true);
        if($query->exists()){
            $query->first()->delete();
        }
    }


    static public function addDislike($coupon_rating_id, $user_id)
    {
        $query = CouponRatingLikes::where('user_id', $user_id)->where('coupon_rating_id', $coupon_rating_id);
        if($query->exists()){
            $rating = $query->first();
            $rating->fill(['like' => false])->save();
        } else {
            $rating = new CouponRatingLikes();
            $rating->fill([
                'like'              => false,
                'user_id'           => $user_id,
                'coupon_rating_id' => $coupon_rating_id,
            ])->save();
        }
    }


    static public function removeDislike($coupon_rating_id, $user_id)
    {
        $query = CouponRatingLikes::where('user_id', $user_id)->where('coupon_rating_id', $coupon_rating_id)->where('like', false);
        if($query->exists()){
            $query->first()->delete();
        }
    }
}
