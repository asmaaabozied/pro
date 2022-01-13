<?php
/**
 * Product ratings model class which handel more of relational actions
 *
 * @author Amk El-Kabbany at 27 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Models;

use App\User;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ProductRating
 * @package App\Models
 * @version May 27, 2020, 9:19 am UTC
 *
 * @property \App\User $user
 * @property \App\Models\Product $product
 * @property integer $user_id
 * @property integer $product_id
 * @property number $rate
 * @property string $review
 *
 * @author Amk El-Kabbany at 27 May 2020
 * @contact alaa@upbeatdigital.team
 */
class ProductRating extends Model
{
    use SoftDeletes;

    public $table = 'product_ratings';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'product_id',
        'rate',
        'review'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'required|exists:users,id',
        'product_id' => 'required|exists:products,id',
        'rate' => 'float',
        'review' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required|exists:users,id',
        'product_id' => 'required|exists:products,id',
        'rate' => 'required|numeric|min:0|max:5',
        'review' => 'required'
    ];
    
    /**
     * Get user for selected product rating
     * PK id in users table
     * FK user_id in product_ratings table
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
     * Get product for selected product rating
     * PK id in products table
     * FK product_id in product_ratings table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * @author Amk El-Kabbany at 27 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /**
     * Get like list for selected product rating
     * PK id in product_ratings table
     * FK product_rating_id in product_rating_likes table
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     *
     * @author Amk El-Kabbany at 21 June 2020
     * @contact alaa@upbeatdigital.team
     */
    public function likeList()
    {
        return $this->hasMany(ProductRatingLikes::class, 'product_rating_id');
    }

    /**
     * Get likes for selected product rating
     * PK id in product_ratings table
     * FK product_rating_id in product_rating_likes table
     * @return int
     *
     * @author Amk El-Kabbany at 21 June 2020
     * @contact alaa@upbeatdigital.team
     */
    public function likes()
    {
        return $this->hasMany(ProductRatingLikes::class, 'product_rating_id')->where('like', true)->count();
    }

    /**
     * Get whither given user is liked selected product rating or not
     * @param  int $user_id
     * @return boolean
     *
     * @author Amk El-Kabbany at 23 June 2020
     * @contact alaa@upbeatdigital.team
     */
    public function isLiked($user_id)
    {
        return $this->hasMany(ProductRatingLikes::class, 'product_rating_id')->where('like', true)
                    ->where('user_id', $user_id)->exists();
    }

    /**
     * Get dislikes for selected product rating
     * PK id in product_ratings table
     * FK product_rating_id in product_rating_likes table
     * @return int
     *
     * @author Amk El-Kabbany at 21 June 2020
     * @contact alaa@upbeatdigital.team
     */
    public function dislikes()
    {
        return $this->hasMany(ProductRatingLikes::class, 'product_rating_id')->where('like', false)->count();
    }

    /**
     * Get whither given user is disliked selected product rating or not
     * @param  int $user_id
     * @return boolean
     *
     * @author Amk El-Kabbany at 23 June 2020
     * @contact alaa@upbeatdigital.team
     */
    public function isDisliked($user_id)
    {
        return $this->hasMany(ProductRatingLikes::class, 'product_rating_id')->where('like', false)
            ->where('user_id', $user_id)->exists();
    }
}
