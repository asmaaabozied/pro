<?php
/**
 * Product ratings likes model class which handel more of relational actions
 *
 * @author Amk El-Kabbany at 21 June 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Models;

use App\User;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ProductRatingLikes
 * @package App\Models
 * @version May 27, 2020, 9:19 am UTC
 *
 * @property \App\User $user
 * @property \App\Models\ProductRating $productRating
 * @property integer $user_id
 * @property integer $product_rating_id
 * @property boolean $like
 *
 * @author Amk El-Kabbany at 21 June 2020
 * @contact alaa@upbeatdigital.team
 */
class ProductRatingLikes extends Model
{
    use SoftDeletes;

    public $table = 'product_ratings_likes';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'product_rating_id',
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
        'product_rating_id' => 'required|exists:product_ratings,id',
        'like' => 'boolean',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required|exists:users,id',
        'product_rating_id' => 'required|exists:product_ratings,id',
    ];

    /**
     * Get user for selected product rating
     * PK id in users table
     * FK user_id in product_ratings_likes table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * @author Amk El-Kabbany at 21 June 2020
     * @contact alaa@upbeatdigital.team
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get product for selected product rating
     * PK id in product_ratings table
     * FK product_id in product_ratings_likes table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * @author Amk El-Kabbany at 21 June 2020
     * @contact alaa@upbeatdigital.team
     */
    public function productRating()
    {
        return $this->belongsTo(ProductRating::class, 'product_rating_id');
    }

    /**
     * Add like for product rating

     * @param  int $product_rating_id
     * @param  int $user_id
     *
     * @author Amk El-Kabbany at 18 June 2020
     * @contact alaa@upbeatdigital.team
     */
    static public function addLike($product_rating_id, $user_id)
    {
        $query = ProductRatingLikes::where('user_id', $user_id)->where('product_rating_id', $product_rating_id);
        if($query->exists()){
            $rating = $query->first();
            $rating->fill(['like' => true])->save();
        } else {
            $rating = new ProductRatingLikes();
            $rating->fill([
                'like'              => true,
                'user_id'           => $user_id,
                'product_rating_id' => $product_rating_id,
            ])->save();
        }
    }

    /**
     * Remove like for product rating

     * @param  int $product_rating_id
     * @param  int $user_id
     *
     * @author Amk El-Kabbany at 18 June 2020
     * @contact alaa@upbeatdigital.team
     */
    static public function removeLike($product_rating_id, $user_id)
    {
        $query = ProductRatingLikes::where('user_id', $user_id)->where('product_rating_id', $product_rating_id)->where('like', true);
        if($query->exists()){
            $query->first()->delete();
        }
    }

    /**
     * Add dislike for product rating

     * @param  int $product_rating_id
     * @param  int $user_id
     *
     * @author Amk El-Kabbany at 18 June 2020
     * @contact alaa@upbeatdigital.team
     */
    static public function addDislike($product_rating_id, $user_id)
    {
        $query = ProductRatingLikes::where('user_id', $user_id)->where('product_rating_id', $product_rating_id);
        if($query->exists()){
            $rating = $query->first();
            $rating->fill(['like' => false])->save();
        } else {
            $rating = new ProductRatingLikes();
            $rating->fill([
                'like'              => false,
                'user_id'           => $user_id,
                'product_rating_id' => $product_rating_id,
            ])->save();
        }
    }

    /**
     * Remove dislike for product rating
     *
     * @param  int $product_rating_id
     * @param  int $user_id
     *
     * @author Amk El-Kabbany at 18 June 2020
     * @contact alaa@upbeatdigital.team
     */
    static public function removeDislike($product_rating_id, $user_id)
    {
        $query = ProductRatingLikes::where('user_id', $user_id)->where('product_rating_id', $product_rating_id)->where('like', false);
        if($query->exists()){
            $query->first()->delete();
        }
    }
}
