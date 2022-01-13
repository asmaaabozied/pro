<?php
/**
 * Store ratings likes model class which handel more of relational actions
 *
 * @author Amk El-Kabbany at 2 July 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Models;

use App\User;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class StoreRatingLikes
 * @package App\Models
 * @version July 2, 2020, 9:19 am UTC
 *
 * @property \App\User $user
 * @property \App\Models\StoreRating $storeRating
 * @property integer $user_id
 * @property integer $store_rating_id
 * @property boolean $like
 *
 * @author Amk El-Kabbany at 2 July 2020
 * @contact alaa@upbeatdigital.team
 */
class StoreRatingLikes extends Model
{
    use SoftDeletes;

    public $table = 'store_ratings_likes';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'store_rating_id',
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
        'store_rating_id' => 'required|exists:store_ratings,id',
        'like' => 'boolean',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required|exists:users,id',
        'store_rating_id' => 'required|exists:store_ratings,id',
    ];

    /**
     * Get user for selected store rating
     * PK id in users table
     * FK user_id in store_ratings_likes table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * @author Amk El-Kabbany at 2 July 2020
     * @contact alaa@upbeatdigital.team
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get store for selected store rating
     * PK id in store_ratings table
     * FK store_id in store_ratings_likes table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * @author Amk El-Kabbany at 2 July 2020
     * @contact alaa@upbeatdigital.team
     */
    public function storeRating()
    {
        return $this->belongsTo(StoreRating::class, 'store_rating_id');
    }

    /**
     * Add like for store rating

     * @param  int $store_rating_id
     * @param  int $user_id
     *
     * @author Amk El-Kabbany at 2 July 2020
     * @contact alaa@upbeatdigital.team
     */
    static public function addLike($store_rating_id, $user_id)
    {
        $query = StoreRatingLikes::where('user_id', $user_id)->where('store_rating_id', $store_rating_id);
        if($query->exists()){
            $rating = $query->first();
            $rating->fill(['like' => true])->save();
        } else {
            $rating = new StoreRatingLikes();
            $rating->fill([
                'like'              => true,
                'user_id'           => $user_id,
                'store_rating_id' => $store_rating_id,
            ])->save();
        }
    }

    /**
     * Remove like for store rating

     * @param  int $store_rating_id
     * @param  int $user_id
     *
     * @author Amk El-Kabbany at 2 July 2020
     * @contact alaa@upbeatdigital.team
     */
    static public function removeLike($store_rating_id, $user_id)
    {
        $query = StoreRatingLikes::where('user_id', $user_id)->where('store_rating_id', $store_rating_id)->where('like', true);
        if($query->exists()){
            $query->first()->delete();
        }
    }

    /**
     * Add dislike for store rating

     * @param  int $store_rating_id
     * @param  int $user_id
     *
     * @author Amk El-Kabbany at 2 July 2020
     * @contact alaa@upbeatdigital.team
     */
    static public function addDislike($store_rating_id, $user_id)
    {
        $query = StoreRatingLikes::where('user_id', $user_id)->where('store_rating_id', $store_rating_id);
        if($query->exists()){
            $rating = $query->first();
            $rating->fill(['like' => false])->save();
        } else {
            $rating = new StoreRatingLikes();
            $rating->fill([
                'like'              => false,
                'user_id'           => $user_id,
                'store_rating_id' => $store_rating_id,
            ])->save();
        }
    }

    /**
     * Remove dislike for store rating
     *
     * @param  int $store_rating_id
     * @param  int $user_id
     *
     * @author Amk El-Kabbany at 2 July 2020
     * @contact alaa@upbeatdigital.team
     */
    static public function removeDislike($store_rating_id, $user_id)
    {
        $query = StoreRatingLikes::where('user_id', $user_id)->where('store_rating_id', $store_rating_id)->where('like', false);
        if($query->exists()){
            $query->first()->delete();
        }
    }
    public function scopeLimited($query)
    {
        // dd(Auth::user()->id);
        // dump($this->items);
        if(Auth::user()->account_type == 3){
            $owner_id = Auth::id();
            return $query->whereHas('storeRating', function ($rat) use($owner_id){
                $rat->whereHas('store', function($sub) use($owner_id){
                    $sub->whereHas('owner_id', $owner_id);
                });
            });
        }
        return $query;
    }
}
