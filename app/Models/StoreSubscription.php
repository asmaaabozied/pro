<?php
/**
 * Store subscription model class which handel more of relational actions
 *
 * @author Amk El-Kabbany at 12 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

/**
 * Class StoreSubscription
 * @package App\Models
 * @version May 12, 2020, 6:50 pm UTC
 *
 * @property \App\Models\Subscription $subscription
 * @property \App\Models\Store $store
 * @property integer $subscription_id
 * @property integer $store_id
 * @property number $actual_price
 * @property number $price
 * @property integer $duration
 * @property string $expire_date
 * @property boolean $active
 *
 * @author Amk El-Kabbany at 12 May 2020
 * @contact alaa@upbeatdigital.team
 */
class StoreSubscription extends Model
{
    use SoftDeletes;

    public $table = 'store_subscriptions';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'subscription_id',
        'store_id',
        'actual_price',
        'price',
        'duration',
        'expire_date',
        'active'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'subscription_id' => 'integer',
        'store_id' => 'integer',
        'actual_price' => 'double',
        'price' => 'double',
        'duration' => 'integer',
        'expire_date' => 'date',
        'active' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'subscription_id' => 'required|exists:subscriptions,id',
        'store_id' => 'required|exists:stores,id',
    ];

    /**
     * Get instance of this model
     *
     * @author Amk El-Kabbany at 12 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function __construct()
    {
        $this->fillable = array_keys(alterLangArrayElements('store_subscriptions', ['fields' => array_combine($this->fillable,$this->fillable)], $key = 'fields')['fields']);
        $this->casts = alterLangArrayElements('store_subscriptions', ['fields' => $this->casts], $key = 'fields')['fields'];
    }
    
    /**
     * Get subscription type for selected store subscription
     * PK id in subscriptions table
     * FK subscription_id in store_subscriptions table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * @author Amk El-Kabbany at 12 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }
    
    /**
     * Get store for selected store subscription
     * PK id in stores table
     * FK store_id in store_subscriptions table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * @author Amk El-Kabbany at 12 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function scopeLimited($query)
    {
        // dd(Auth::user()->id);
        // dump($this->items);
        if(Auth::user()->account_type == 3){
            $owner_id = Auth::id();
            return $query->whereHas('store', function($sub) use($owner_id){
                $sub->where('owner_id', $owner_id);
            });
        }
        return $query;
    }
}
