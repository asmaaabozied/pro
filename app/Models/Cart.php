<?php
/**
 * Cart model class which handel more of relational actions
 *
 * @author Amk El-Kabbany at 31 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Models;

use App\User;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Auth;

/**
 * Class Cart
 * @package App\Models
 * @version May 31, 2020, 12:50 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $users
 * @property integer $user_id
 * @property string $status
 *
 * @author Amk El-Kabbany at 31 May 2020
 * @contact alaa@upbeatdigital.team
 */
class Cart extends Model
{
    use SoftDeletes;

    public $table = 'carts';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'user_id',
        'checked_out',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required|exists:users,id',
        'status' => 'required'
    ];

    /**
     * Get selected cart items
     * PK id in carts table
     * FK cart_id in cart_items table
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     *
     * @author Amk El-Kabbany at 31 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function items()
    {
        return $this->hasMany(CartItem::class, 'cart_id');
    }

    /**
     * Get selected cart owner
     * PK id in users table
     * FK user_id in carts table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * @author Amk El-Kabbany at 31 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get selected cart total price
     * @return double
     *
     * @author Amk El-Kabbany at 1 June 2020
     * @contact alaa@upbeatdigital.team
     */
    public function total()
    {
        return $this->items()->sum(DB::raw('quantity * price'));
    }

    /**
     * Check if selected cart has discounted products
     * @return boolean
     *
     * @author Amk El-Kabbany at 12 July 2020
     * @contact alaa@upbeatdigital.team
     */
    public function haveProductDiscount()
    {
        return $this->items->whereHas('product', function ($q) {
            $q->where('discount', true);
        })->exists();
    }

    /**
     * Get selected cart total discounts rate
     * @return double
     *
     * @author Amk El-Kabbany at 12 July 2020
     * @contact alaa@upbeatdigital.team
     */
    public function productDiscounts()
    {
        return $this->items->whereHas('product', function ($q) {
            $q->where('discount', true);
        })->sum('price');
    }

    public function scopeLimited($query)
    {
        // dd(Auth::user()->id);
        // dump($this->items);
        if(Auth::user()->account_type == 3){
            $productIds = Auth::user()->productsIds();
            return $query->whereHas('items', function($item) use($productIds){
                return $item->whereIn('product_id', $productIds);
            });
        }
        return $query;
    }
}