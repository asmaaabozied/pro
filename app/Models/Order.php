<?php
/**
 * Order model class which handel more of relational actions
 *
 * @author Amk El-Kabbany at 1 June 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Models;

use App\User;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

/**
 * Class Order
 * @package App\Models
 * @version June 1, 2020, 5:08 pm UTC
 *
 * @property Cart $cart
 * @property \Illuminate\Database\Eloquent\Collection $users
 * @property \Illuminate\Database\Eloquent\Collection $address
 * @property integer $cart_id
 * @property integer $user_id
 * @property string $discount_type
 * @property double $discount
 * @property integer $address_id
 * @property number $shipping_cost
 * @property number $cart_total
 * @property number $total
 * @property string $status
 * @property string $payment_type
 *
 * @author Amk El-Kabbany at 1 June 2020
 * @contact alaa@upbeatdigital.team
 */
class Order extends Model
{
    use SoftDeletes;

    public $table = 'orders';
    protected $dates = ['deleted_at'];

    public $fillable = [
        'cart_id',
        'user_id',
        'voucher_coupon_id',
        'voucher_coupon_total_discount',
        'discount_type',
        'discount',
        'address_id',
        'shipping_cost',
        'payment_type',
        'cart_total',
        'total',
        'shipping_code',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'cart_id' => 'integer',
        'user_id' => 'integer',
        'discount_type' => 'string',
        'voucher_coupon_id'=>'integer',
        'voucher_coupon_total_discount'=>'float',
        'discount' => 'float',
        'address_id' => 'integer',
        'payment_type' => 'string',
        'shipping_cost' => 'float',
        'cart_total' => 'double',
        'total' => 'float',
        'status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'address_id' => 'required|exists:addresses,id',
        'code' => 'exists:coupons,code',
        'payment_type' => 'required',
    ];

    /**
     * Get selected order cart
     * PK id in carts table
     * FK cart_id in orders table
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     *
     * @author Amk El-Kabbany at 1 June 2020
     * @contact alaa@upbeatdigital.team
     */
    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id');
    }

    /**
     * Get selected order owner
     * PK id in users table
     * FK by in orders table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * @author Amk El-Kabbany at 1 June 2020
     * @contact alaa@upbeatdigital.team
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get selected order shipped address
     * PK id in addresses table
     * FK address_id in orders table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * @author Amk El-Kabbany at 12 June 2020
     * @contact alaa@upbeatdigital.team
     */
    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }

    public function totalWeight(){
        $weight = 0.00;
        foreach($this->cart->items as $item){
            $weight += $item->product->finalWeight(); 
        }

        return $weight;
    }

    /**
     * Get selected order used discount coupons
     * PK id in orders table
     * FK order_id in order_coupons table
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     *
     * @author Amk El-Kabbany at 9 July 2020
     * @contact alaa@upbeatdigital.team
     */
    // public function coupons()
    // {
    //     return $this->hasMany(OrderCoupon::class, 'order_id')->where('deleted_at', null);
    // }

    /**
     * Get selected order used discount coupon
     * PK id in orders table
     * FK order_id in order_coupons table
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     *
     * @author Amk El-Kabbany at 9 July 2020
     * @contact alaa@upbeatdigital.team
     */
    // public function coupon()
    // {
    //     return $this->hasOne(OrderCoupon::class, 'order_id');
    // }

    public function scopeLimited($query)
    {
        // dd(Auth::user()->id);
        if(Auth::user()->account_type == 3){
            $productIds = Auth::user()->productsIds();
            // dd($productIds);
            return $query->whereHas('cart', function($cart) use($productIds){
                    $cart->whereHas('items', function($item) use($productIds){
                        $item->whereIn('product_id', $productIds);
                    });
            });
        }
        return $query;
    }
}
