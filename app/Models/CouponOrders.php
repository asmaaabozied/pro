<?php
/**
 * Order coupon model class which handel more of relational actions
 *
 * @author Amk El-Kabbany at 9 July 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Order Coupon
 * @package App\Models
 * @version June 1, 2020, 5:08 pm UTC
 *
 * @property \App\Models\Cart $cart
 * @property \Illuminate\Database\Eloquent\Collection $users
 * @property \Illuminate\Database\Eloquent\Collection $countries
 * @property \Illuminate\Database\Eloquent\Collection $cities
 * @property integer $order_id
 * @property string $status
 * @property integer $by
 *
 * @author Amk El-Kabbany at 9 July 2020
 * @contact alaa@upbeatdigital.team
 */
class CouponOrders extends Model
{
    use SoftDeletes;

    public $table = 'coupon_orders';
    protected $dates = ['deleted_at'];
    public $fillable = ['coupon_id','coupon_details_id','user_id','price'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'coupon_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required|exists:users,id',
        'coupon_id' => 'required|exists:coupons,id',
    ];

}
