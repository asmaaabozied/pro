<?php
/**
 * Store model class which handel more of relational actions
 *
 * @author Amk El-Kabbany at 7 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Models;

use App\User;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

/**
 * Class Store
 * @package App\Models
 * @version May 7, 2020, 6:17 pm UTC
 *
 * @property \App\Models\StoreType $storeType
 * @property int owner_id
 * @property string $name_en
 * @property string $description_en
 * @property string $image
 * @property int $store_type
 * @property string $status
 * @property boolean $activated
 *
 * @author Amk El-Kabbany at 7 May 2020
 * @contact alaa@upbeatdigital.team
 */
class Store extends Model
{
    use SoftDeletes;

    public $table = 'stores';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'name_en',
        'description_en',
        'phone',
        'image',
        'store_type',
        'owner_id',
        'lat',
        'long',
        'status',
        'activated'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name_en' => 'string',
        'description_en' => 'string',
        'phone' => 'string',
        'image' => 'string',
        'status' => 'string',
        'store_type' => 'integer',
        'owner_id' => 'integer',
        'activated' => 'boolean',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name_en' => 'required|min:3',
        'description_en' => 'required',
        'phone' => 'required',
        'store_type' => 'required',
        'owner_id' => 'required|exists:users,id',
        'status' => 'required',
        'lat' => 'required|numeric',
        'long' => 'required|numeric',
    ];
    
    /**
     * Get instance of this model
     *
     * @author Amk El-Kabbany at 7 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function __construct()
    {
        $this->fillable = array_keys(alterLangArrayElements('stores', ['fields' => array_combine($this->fillable,$this->fillable)], $key = 'fields')['fields']);
        $this->casts = alterLangArrayElements('stores', ['fields' => $this->casts], $key = 'fields')['fields'];
        self::$rules = alterLangArrayElements('stores', ['fields' => self::$rules], $key = 'fields')['fields'];
    }

    /**
     * Get store type for selected store
     * PK id in store_types table
     * FK store_type in stores table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * @author Amk El-Kabbany at 7 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function type()
    {
        return $this->belongsTo(StoreType::class, 'store_type');
    }

    /**
     * Get selected store owner
     * PK id in users table
     * FK owner in stores table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * @author Amk El-Kabbany at 7 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    /**
     * Get selected store's terms and policies paragraphs
     * PK id in stores table
     * FK store_id in store_terms_policy table
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     *
     * @author Amk El-Kabbany at 10 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function termsAndPolicies()
    {
        return $this->hasMany(StoreTermsAndPolicy::class, 'store_id')->where('deleted_at', null);
    }


    public function coupons()
    {
        return $this->hasMany(Coupon::class, 'store_id');
    }

    /**
     * Get selected store's sliders
     * PK id in stores table
     * FK store_id in sliders table
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     *
     * @author Amk El-Kabbany at 10 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function sliders()
    {
        return $this->hasMany(Slider::class, 'store_id')->where('deleted_at', null);
    }

    /**
     * Get selected store's products
     * PK id in stores table
     * FK store_id in products table
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     *
     * @author Amk El-Kabbany at 23 June 2020
     * @contact alaa@upbeatdigital.team
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'store_id')->where('deleted_at', null);
    }

    /**
     * Get selected store's ratings
     * PK id in stores table
     * FK store_id in store_ratings table
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     *
     * @author Amk El-Kabbany at 14 June 2020
     * @contact alaa@upbeatdigital.team
     */
    public function ratings()
    {
        return $this->hasMany(StoreRating::class, 'store_id')->where('deleted_at', null);
    }

    /**
     * Get selected store's average rate
     * @return int
     *
     * @author Amk El-Kabbany at 14 June 2020
     * @contact alaa@upbeatdigital.team
     */
    public function rate()
    {
        return $this->hasMany(StoreRating::class, 'store_id')->avg('rate');
    }

    /**
     * Get selected store's average rate
     * @return int
     *
     * @author Amk El-Kabbany at 14 June 2020
     * @contact alaa@upbeatdigital.team
     */
    public function raters()
    {
        return $this->hasMany(StoreRating::class, 'store_id')->count();
    }

    /**
     * Get selected store's average rate
     * @return array
     *
     * @author Amk El-Kabbany at 14 June 2020
     * @contact alaa@upbeatdigital.team
     */
    static public function owners()
    {
        $owners = Store::pluck('owner_id');
        $users = [];
        foreach($owners as $owner) {
            $users [] = User::find($owner);
        }

        return $users;
    }

    


    protected $appends = ['image_path','rate','raters'];

    public function getRateAttribute(){
        return $this->hasMany(StoreRating::class, 'store_id')->avg('rate');
    }//end of get rate
    public function getRatersAttribute(){
        return $this->hasMany(StoreRating::class, 'store_id')->count();

    }//end of get raters
    public function getImagePathAttribute(){
        // return asset($this->image);
        return (!empty($this->image))? asset($this->image):'';

    }//end of get image path
    
    public function scopeLimited($query)
    {
        // dd(Auth::user()->id);
        // dump($this->items);
        if(Auth::user()->account_type == 3){
            return $query->where('owner_id', Auth::id());
        }
        return $query;
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

}