<?php
/**
 * User model class which handel more of relational actions
 *
 * @author Amk El-Kabbany at 5 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App;

use App\Models\AccountsType;
use App\Models\Coupon;
use App\Models\City;
use App\Models\Commentvoucher;
use App\Models\Country;
use App\Models\Order;
use App\Models\ProductsFavourite;
use App\Models\Voucher;
use App\Models\Address;
use App\Models\Store;
use App\Models\Notification;
use App\Models\NotifiedUser;
use App\Models\UserGift;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
/**
 * Class User
 * @package App\Models
 * @version April 28, 2020, 9:35 am UTC
 *
 * @property integer $account_type
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $image
 * @property string $mobile
 * @property integer $country_id
 * @property integer $city_id
 * @property string $address
 * @property boolean $mobile_verified
 * @property boolean $email_verified
 * @property boolean $activated
 * @property string $status
 * @property string|\Carbon\Carbon $email_verified_at
 * @property string $remember_token
 *
 * @author Amk El-Kabbany at 28 Apr 2020
 * @contact alaa@upbeatdigital.team
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use SoftDeletes, Notifiable, HasApiTokens, HasRoles;

    public $table = 'users';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    /**
     * Spatie roles guard name.
     *
     * @var string
     *
     * @author Amk El-Kabbany at 3 May 2020
     * @contact alaa@upbeatdigital.team
     */
    protected $guard_name = 'api';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */




    protected $fillable = [
        'account_type',
        'name',
        'email',
        'password',
        'image',
        'mobile',
        'country_id',
        'city_id',
        'address',
        'status',
        'activated',
        'email_verified',
        'mobile_verified',
        'social_media',
        'firebase_token',
        'social_login',
        'google_id',
        'facebook_id',
        'referral_code',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'account_type' => 'integer',
        'name' => 'string',
        'email' => 'string',
        'password' => 'string',
        'image' => 'string',
        'mobile' => 'string',
        'country_id' => 'integer',
        'city_id' => 'integer',
        'address' => 'string',
        'mobile_verified' => 'boolean',
        'email_verified' => 'boolean',
        'activated' => 'boolean',
        'social_media' => 'boolean',
        'status' => 'string',
        'email_verified_at' => 'datetime',
        'remember_token' => 'string'
    ];


    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'account_type' => 'required',
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required|confirmed|min:6',
        'country_id' => 'required|exists:countries,id',
        'city_id' => 'required|exists:cities,id',
        'status' => 'required'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $update_rules = [
        'account_type' => 'required',
        'name' => 'required',
        'email' => 'required|email',
        // 'password' => 'confirmed|min:6|nullable',
        'country_id' => 'required|exists:countries,id',
        'city_id' => 'required|exists:cities,id',
        'status' => 'required'
    ];


    /**
     * Login validation rules
     *
     * @var array
     */
    public static $loginRules = [
        'email' => 'required',
        'password' => 'required',
    ];


    /**
     * Login validation rules
     *
     * @var array
     */
    public static $socialLoginRules = [
        'email' => 'required|email',
    ];

    /**
     * Change password validation rules
     *
     * @var array
     */
    public static $changePasswordRules = [
        'old_password' => 'required',
        'new_password' => 'required|confirmed',
    ];

    /**
     * Forget password validation rules
     *
     * @var array
     */
    public static $forgetPasswordRules = [
        'email' => 'required',
    ];

    /**
     * Get country for selected user
     * PK id in countries table
     * FK country_id in users table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * @author Amk El-Kabbany at 5 May 2020
     * @contact alaa@upbeatdigital.team
     **/
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }



    public function coupons()

    {
        return $this->belongsToMany(Coupon::class);
    }


    /**
     * Get city for selected user
     * PK id in cities table
     * FK city_id in users table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * @author Amk El-Kabbany at 5 May 2020
     * @contact alaa@upbeatdigital.team
     **/
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    /**
     * Get account type for selected user
     * PK id in account_types table
     * FK account_type in users table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * @author Amk El-Kabbany at 5 May 2020
     * @contact alaa@upbeatdigital.team
     **/
    public function accountType()
    {
        return $this->belongsTo(AccountsType::class, 'account_type', 'id');
    }

    /**
     * Get favourite products for selected user
     * PK id in users table
     * FK user_id in product_favourites table
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     *
     * @author Amk El-Kabbany at 5 May 2020
     * @contact alaa@upbeatdigital.team
     **/
    public function favourites()
    {
        return $this->hasMany(ProductsFavourite::class)->where('deleted_at', null);
    }

    /**
     * Get addresses for selected user
     * PK id in users table
     * FK user_id in addresses table
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     *
     * @author Amk El-Kabbany at 9 July 2020
     * @contact alaa@upbeatdigital.team
     **/
    public function addresses()
    {
        return $this->hasMany(Address::class)->where('deleted_at', null);
    }

    /**
     * Get main address for selected user
     * PK id in users table
     * FK user_id in addresses table
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     *
     * @author Amk El-Kabbany at 9 July 2020
     * @contact alaa@upbeatdigital.team
     **/
    public function mainAddress()
    {
        return $this->hasMany(Address::class)->where('deleted_at', null)->where('main', true)->first();
    }

    /**
     * Get orders for selected user
     * PK id in users table
     * FK user_id in orders table
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     *
     * @author Amk El-Kabbany at 13 July 2020
     * @contact alaa@upbeatdigital.team
     **/
    public function orders()
    {
        return $this->hasMany(Order::class)->where('deleted_at', null);
    }


    /**
     * Find model record for given token
     *
     * @param string $token
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model|null
     *
     * @author Amk El-Kabbany at 14 June 2020
     * @contact alaa@upbeatdigital.team
     */
    static public function findByToken($token)
    {
        $user = User::where('deleted_at', null)->where('remember_token', trim($token));

        return $user->first();
    }


    public function Commentvouchers(){
        return $this->hasMany(Commentvoucher::class, 'user_id', 'id');
    }

    /**
     * Fetches all clients users
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model|null
     *
     * @author Amk El-Kabbany at 14 June 2020
     * @contact alaa@upbeatdigital.team
     */
    static public function storeClients(){
        $users = User::where('deleted_at', null)->where('account_type', 4)->pluck('id');
        return $users;
    }

    /**
     * Validate coupons if it has been used by selected user
     *
     * @param int $coupon_id
     * @return boolean
     *
     * @author Amk El-Kabbany at 9 July 2020
     * @contact alaa@upbeatdigital.team
     */
    public function validateVoucher($coupon_id)
    {
        // foreach ($this->hasMany(Order::class, 'user_id')->where('deleted_at', null)->get() as $order){
        //     if($order->coupons->where('coupon_id', $coupon_id)->first() == null){
        //         return true;
        //     }
        // }
        // return false;
        return Order::where('voucher_coupon_id', $coupon_id)->where('user_id', $this->id)->exists();
    }

    /**
     * Validate if specified order belongs to this user
     *
     * @param int $order_id
     * @return boolean
     *
     * @author Amk El-Kabbany at 9 July 2020
     * @contact alaa@upbeatdigital.team
     */
    public function validateOrder($order_id)
    {
        return Order::where('id', $order_id)->where('user_id', $this->id)->exists();
    }

    /**
     * Validate coupons if it has been used by selected user
     *
     * @param int $coupon_id
     * @return boolean
     *
     * @author Amk El-Kabbany at 9 July 2020
     * @contact alaa@upbeatdigital.team
     */
    public function validateCoupon($coupon_id)
    {
        // foreach ($this->hasMany(Order::class, 'user_id')->where('deleted_at', null) as $order){
        //     if($order->coupons->where('coupon_id', $coupon_id)->first() == null){
        //         return true;
        //     }
        // }
        // return false;
        return Order::where('voucher_coupon_id', $coupon_id)->where('user_id', $this->id)->exists();
    }

    public function stores(){
        return $this->hasMany(Store::class, 'owner_id');
    }
    public function referrals(){
        return $this->hasMany(User::class,'referral_code','user_code');
    }
    
    public function gifts(){
        return $this->hasMany(UserGift::class,'user_id');
    }
    public function NotifiedUser(){
        return  optional($this->hasMany(NotifiedUser::class, 'user_id')->orderBy('created_at','desc'));
    }
    
    public function lastNotifcation(){
        $notification_id= $this->NotifiedUser()->notification_id;
        if( !empty($notification_id) ){
            return Notification::where('id', $notification_id);
        }
        else{
            return'';
        }
    }

    public function productsIds(){
        $ids = [];
        // dd($this->stores);
        foreach($this->stores as $store){
            foreach($store->products as $product){
                $ids[] = $product->id;
            }
        }

        return $ids;
    }
}
