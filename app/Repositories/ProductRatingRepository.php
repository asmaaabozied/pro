<?php
/**
 * Product rating repository class which handel more of logic actions
 *
 * @author Amk El-Kabbany at 27 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Repositories;

use App\Models\Product;
use App\Models\ProductRating;
use App\Models\ProductRatingLikes;
use App\Repositories\BaseRepository;

/**
 * Class ProductRatingRepository
 * @package App\Repositories
 * @version May 27, 2020, 9:19 am UTC
 *
 * @author Amk El-Kabbany at 27 May 2020
 * @contact alaa@upbeatdigital.team
*/

class ProductRatingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'product_id',
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
        return ProductRating::class;
    }

    /**
     * List product ratings for selected product
     *
     * @param integer $product_id
     *
     * @author Amk El-Kabbany at 18 June 2020
     * @contact alaa@upbeatdigital.team
     **/
    public function lists($product_id)
    {
        return @Product::where('deleted_at', null)->where('id', $product_id)
                        ->first()->ratings;
    }

    /**
     * Add like for product rating
     *
     * @param  int $product_rating_id
     * @param  int $user_id
     *
     * @author Amk El-Kabbany at 18 June 2020
     * @contact alaa@upbeatdigital.team
     **/
    public function addLike($product_rating_id, $user_id)
    {
        ProductRatingLikes::addLike($product_rating_id, $user_id);
    }

    /**
     * Remove like for product rating
     *
     * @param  int $product_rating_id
     * @param  int $user_id
     *
     * @author Amk El-Kabbany at 18 June 2020
     * @contact alaa@upbeatdigital.team
     **/
    public function removeLike($product_rating_id, $user_id)
    {
        ProductRatingLikes::removeLike($product_rating_id, $user_id);
    }

    /**
     * Add dislike for product rating
     *
     * @param  int $product_rating_id
     * @param  int $user_id
     *
     * @author Amk El-Kabbany at 18 June 2020
     * @contact alaa@upbeatdigital.team
     **/
    public function addDislike($product_rating_id, $user_id)
    {
        ProductRatingLikes::addDislike($product_rating_id, $user_id);
    }

    /**
     * Remove like for product rating
     *
     * @param  int $product_rating_id
     * @param  int $user_id
     *
     * @author Amk El-Kabbany at 18 June 2020
     * @contact alaa@upbeatdigital.team
     **/
    public function removeDislike($product_rating_id, $user_id)
    {
        ProductRatingLikes::removeDislike($product_rating_id, $user_id);
    }
}
