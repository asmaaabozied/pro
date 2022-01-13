<?php
/**
 * Store model class which handel more of relational actions
 *
 * @author Amk El-Kabbany at 11 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Models;

use App\User;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

/**
 * Class StoreRating
 * @package App\Models
 * @version May 11, 2020, 9:24 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $users
 * @property \Illuminate\Database\Eloquent\Collection $stores
 * @property integer $user_id
 * @property integer $store_id
 * @property number $rate
 * @property string $review
 *
 * @author Amk El-Kabbany at 11 May 2020
 * @contact alaa@upbeatdigital.team
 */
class StoreRating extends Model
{
    use SoftDeletes;

    public $table = 'store_ratings';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'user_id',
        'store_id',
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
        'user_id' => 'integer',
        'store_id' => 'integer',
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
        'store_id' => 'required|exists:stores,id',
        'rate' => 'required|max:5',
        'review' => 'required'
    ];

    /**
     * Get user for selected store rating
     * PK id in users table
     * FK user_id in store_ratings table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * @author Amk El-Kabbany at 11 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get store for selected store rating
     * PK id in users table
     * FK store_id in store_ratings table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * @author Amk El-Kabbany at 11 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }

    /**
     * Get like list for selected store rating
     * PK id in store_ratings table
     * FK store_rating_id in store_rating_likes table
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     *
     * @author Amk El-Kabbany at 21 June 2020
     * @contact alaa@upbeatdigital.team
     */
    public function likeList()
    {
        return $this->hasMany(StoreRatingLikes::class, 'store_rating_id');
    }

    /**
     * Get likes for selected store rating
     * PK id in store_ratings table
     * FK store_rating_id in store_rating_likes table
     * @return int
     *
     * @author Amk El-Kabbany at 21 June 2020
     * @contact alaa@upbeatdigital.team
     */
    public function likes()
    {
        return $this->hasMany(StoreRatingLikes::class, 'store_rating_id')->where('like', true)->count();
    }

    /**
     * Get whither given user is liked selected store rating or not
     * @param  int $user_id
     * @return boolean
     *
     * @author Amk El-Kabbany at 23 June 2020
     * @contact alaa@upbeatdigital.team
     */
    public function isLiked($user_id)
    {
        return $this->hasMany(StoreRatingLikes::class, 'store_rating_id')->where('like', true)
            ->where('user_id', $user_id)->exists();
    }

    /**
     * Get dislikes for selected store rating
     * PK id in store_ratings table
     * FK store_rating_id in store_rating_likes table
     * @return int
     *
     * @author Amk El-Kabbany at 21 June 2020
     * @contact alaa@upbeatdigital.team
     */
    public function dislikes()
    {
        return $this->hasMany(StoreRatingLikes::class, 'store_rating_id')->where('like', false)->count();
    }

    /**
     * Get whither given user is disliked selected store rating or not
     * @param  int $user_id
     * @return boolean
     *
     * @author Amk El-Kabbany at 23 June 2020
     * @contact alaa@upbeatdigital.team
     */
    public function isDisliked($user_id)
    {
        return $this->hasMany(StoreRatingLikes::class, 'store_rating_id')->where('like', false)
            ->where('user_id', $user_id)->exists();
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
