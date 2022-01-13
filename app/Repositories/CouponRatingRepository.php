<?php

namespace App\Repositories;

use App\Models\Coupon;
use App\Models\CouponRating;
use App\Models\CouponRatingLikes;
use App\Repositories\BaseRepository;


class CouponRatingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'coupon_id',
        'rate',
        'review'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CouponRating::class;
    }

    public function lists($coupon_id)
    {
        return @Coupon::where('deleted_at', null)
                        ->where('active', 1)
                        ->where('id', $coupon_id)
                        ->first()->couponRating;
    }

 
    public function addLike($coupon_rating_id, $user_id)
    {
        CouponRatingLikes::addLike($coupon_rating_id, $user_id);
    }

  
    public function removeLike($coupon_rating_id, $user_id)
    {
        CouponRatingLikes::removeLike($coupon_rating_id, $user_id);
    }

    
    public function addDislike($coupon_rating_id, $user_id)
    {
        CouponRatingLikes::addDislike($coupon_rating_id, $user_id);
    }

    public function removeDislike($coupon_rating_id, $user_id)
    {
        CouponRatingLikes::removeDislike($coupon_rating_id, $user_id);
    }
}
