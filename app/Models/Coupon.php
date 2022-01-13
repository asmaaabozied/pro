<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CouponDetail;
use App\Models\CouponImage;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use SoftDeletes;

    public $table = 'coupons';
    public $fillable = ['title_en','title_ar',
        // 'discount',// 'start_at',// 'end_at',
        'description_ar','description_en',
        // 'old_price',// 'new_price',// 'image',
        // 'user_id',
        'store_id','city_id','category_id',
        'description',
        // 'image',
        'start_at','valid_to','code','count',
        // 'usage',
        'discount_rate',
        'active',
        'featured',
        'inslider',
    ];
    protected $casts = [
        'id' => 'integer',
        'category_id' => 'integer',
        'store_id' => 'integer',
        'city_id' => 'integer',
        'featured' => 'boolean',
        'active' => 'boolean',
        'inslider' => 'boolean',
    ];

    public static $rules = [
        'category_id' => 'required|exists:categories,id',
        'city_id' => 'required|exists:cities,id',
        'store_id' => 'required|exists:stores,id',
        'title_ar'=>'required',
        'title_en'=>'required',
        'description_en'=>'required',
        'description_ar'=>'required',
        'start_at'=>'required',
        'valid_to'=>'required',
        'count'=>'required',
        'discount_rate'=>'required',
    ];

    protected $appends = ['image' ,'rate','raters'];
    public function getImageAttribute(){
        // return asset($this->image);
        return (!empty(optional($this->images()->first())->image))?asset(optional($this->images()->first())->image):'';


    }//end of get image path

    public function getRateAttribute(){
        return $this->hasMany(CouponRating::class, 'coupon_id')->avg('rate');
    }//end of get rate
    public function getRatersAttribute(){
        return $this->hasMany(CouponRating::class, 'coupon_id')->count();

    }//end of get raters

    public function couponDetail(){
        return $this->hasMany(CouponDetail::class, 'coupon_id');
    }
    public function images(){
        return $this->hasMany(CouponImage::class, 'coupon_id');
    }

    public function couponLikes(){
        return $this->hasMany(CouponLikes::class, 'coupon_id');
    }
    public function couponFavs(){
        return $this->hasMany(CouponFavs::class, 'coupon_id');
    }

    public function couponRating(){
        return $this->hasMany(CouponRating::class, 'coupon_id');
    }
    public function rate(){
        return !empty($this->hasMany(CouponRating::class, 'coupon_id')->avg('rate'))?$this->hasMany(CouponRating::class, 'coupon_id')->avg('rate'):0;

    }

    public function raters(){
        return $this->hasMany(CouponRating::class, 'coupon_id')->count();
    }

    // public function images(){
    //     return $this->hasMany(Image::class, 'imageable_id');
    // }


    public function city(){
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function store(){
        return $this->belongsTo(Store::class);
    }

    public function isLiked($user_id){
        return $this->hasMany(CouponLikes::class, 'coupon_id')
                    ->where('user_id', $user_id)->exists();
    }
    public function isFav($user_id)
    {
        return $this->hasMany(CouponFavs::class, 'coupon_id')
                    ->where('user_id', $user_id)->exists();
    }

    // public function users(){
    //     return $this->belongsToMany(User::class, 'users', 'user_id');
    // }

    public function scopeLimited($query)
    {
        $user=auth()->user();
        $owner_id=$user->id;
        if( $user->account_type == 3){
            return $query->whereHas('store', function($sub) use($owner_id){
                $sub->where('owner_id', $owner_id);
            });
        }
        return $query;
    }
}