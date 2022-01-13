<?php
/**
 * Store rating repository class which handel more of logic actions
 *
 * @author Amk El-Kabbany at 11 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Repositories;

use App\Models\Store;
use App\Models\StoreRating;
use App\Models\StoreRatingLikes;
use App\Repositories\BaseRepository;

/**
 * Class StoreRatingRepository
 * @package App\Repositories
 * @version May 11, 2020, 9:24 am UTC
 *
 * @author Amk El-Kabbany at 11 May 2020
 * @contact alaa@upbeatdigital.team
*/

class StoreRatingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'store_id',
        'rate',
        'review'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return StoreRating::class;
    }

    /**
     * Lists ratings entries according to provided store id
     *
     * @param int $store_id
     * @return array
     *
     * @author Amk El-Kabbany at 18 May 2020
     * @contact alaa@upbeatdigital.team
     **/
    public function lists($store_id)
    {
        return @Store::where('deleted_at', null)->where('activated', true)
            ->where('id', $store_id)->first()->ratings;
    }

    /**
     * Add like for store rating
     *
     * @param  int $store_rating_id
     * @param  int $user_id
     *
     * @author Amk El-Kabbany at 18 June 2020
     * @contact alaa@upbeatdigital.team
     **/
    public function addLike($store_rating_id, $user_id)
    {
        StoreRatingLikes::addLike($store_rating_id, $user_id);
    }

    /**
     * Remove like for store rating
     *
     * @param  int $store_rating_id
     * @param  int $user_id
     *
     * @author Amk El-Kabbany at 18 June 2020
     * @contact alaa@upbeatdigital.team
     **/
    public function removeLike($store_rating_id, $user_id)
    {
        StoreRatingLikes::removeLike($store_rating_id, $user_id);
    }

    /**
     * Add dislike for store rating
     *
     * @param  int $store_rating_id
     * @param  int $user_id
     *
     * @author Amk El-Kabbany at 18 June 2020
     * @contact alaa@upbeatdigital.team
     **/
    public function addDislike($store_rating_id, $user_id)
    {
        StoreRatingLikes::addDislike($store_rating_id, $user_id);
    }

    /**
     * Remove like for store rating
     *
     * @param  int $store_rating_id
     * @param  int $user_id
     *
     * @author Amk El-Kabbany at 18 June 2020
     * @contact alaa@upbeatdigital.team
     **/
    public function removeDislike($store_rating_id, $user_id)
    {
        StoreRatingLikes::removeDislike($store_rating_id, $user_id);
    }
}
