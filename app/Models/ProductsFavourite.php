<?php
/**
 * Product favourites model class which handel more of relational actions
 *
 * @author Amk El-Kabbany at 27 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Models;

use App\User;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ProductsFavourite
 * @package App\Models
 * @version May 27, 2020, 5:51 pm UTC
 *
 * @property \App\Models\Product $product
 * @property \App\User $user
 * @property integer $product_id
 * @property integer $user_id
 * @property string $ip
 *
 * @author Amk El-Kabbany at 27 May 2020
 * @contact alaa@upbeatdigital.team
 */
class ProductsFavourite extends Model
{
    use SoftDeletes;

    public $table = 'product_favourites';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'product_id',
        'user_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'product_id' => 'integer',
        'user_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'exists:users,id',
        'product_id' => 'required|exists:products,id',
    ];

    /**
     * Get user for selected product favourite
     * PK id in users table
     * FK user_id in product_favourites table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * @author Amk El-Kabbany at 27 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get product for selected product favourite
     * PK id in products table
     * FK product_id in product_favourites table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * @author Amk El-Kabbany at 27 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function product()
    {
        return $this->belongsTo(Product::class)->where('active', true);
    }

    /**
     * Get favourites product for selected user
     * PK id in products table
     * FK product_id in product_favourites table
     *
     * @param int $user_id
     * @return array
     *
     * @author Amk El-Kabbany at 27 May 2020
     * @contact alaa@upbeatdigital.team
     */
    static public function products($user_id)
    {
        $products = [];
        foreach ((User::find($user_id))->favourites as $object){
            $products[] = Product::find($object->product_id);
        }
        return $products;
    }

    /**
     * Favourite selected product for selected user
     *
     * @param int $product_id
     * @param int $user_id
     *
     * @author Amk El-Kabbany at 21 June 2020
     * @contact alaa@upbeatdigital.team
     */
    static public function favourite($product_id, $user_id)
    {
        if(! ProductsFavourite::where('deleted_at', null)->where('product_id', $product_id)->where('user_id', $user_id)->exists()){
            $object = new ProductsFavourite();
            $object->fill([
                'product_id' => $product_id,
                'user_id'    => $user_id,
            ])->save();
        }
    }

    /**
     * Un-favourite selected product for selected user
     *
     * @param int $product_id
     * @param int $user_id
     *
     * @author Amk El-Kabbany at 21 June 2020
     * @contact alaa@upbeatdigital.team
     */
    static public function unFavourite($product_id, $user_id)
    {
        $query = ProductsFavourite::where('deleted_at', null)->where('product_id', $product_id)->where('user_id', $user_id);
        if($query->exists()){
            $query->first()->forceDelete();
        }
    }
}
