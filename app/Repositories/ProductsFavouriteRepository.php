<?php
/**
 * Product favourite repository class which handel more of logic actions
 *
 * @author Amk El-Kabbany at 27 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Repositories;

use App\Models\ProductsFavourite;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Request;

/**
 * Class ProductsFavouriteRepository
 * @package App\Repositories
 * @version May 27, 2020, 5:51 pm UTC
 *
 * @author Amk El-Kabbany at 27 May 2020
 * @contact alaa@upbeatdigital.team
*/

class ProductsFavouriteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'product_id',
        'user_id',
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
        return ProductsFavourite::class;
    }

    /**
     * Lists all favourite products
     *
     * @param int $user_id
     * @return array
     *
     * @author Amk El-Kabbany at 21 June 2020
     * @contact alaa@upbeatdigital.team
     **/
    public function lists($user_id)
    {
        return ProductsFavourite::products($user_id);
    }

    /**
     * Favourite selected product for selected user
     *
     * @param int $product_id
     * @param int $user_id
     * @return array
     *
     * @author Amk El-Kabbany at 21 June 2020
     * @contact alaa@upbeatdigital.team
     **/
    public function favourite($product_id, $user_id)
    {
        return ProductsFavourite::favourite($product_id, $user_id);
    }

    /**
     * Un-favourite selected product for selected user
     *
     * @param int $product_id
     * @param int $user_id
     * @return array
     *
     * @author Amk El-Kabbany at 21 June 2020
     * @contact alaa@upbeatdigital.team
     **/
    public function unFavourite($product_id, $user_id)
    {
        return ProductsFavourite::unFavourite($product_id, $user_id);
    }

    /**
     * Pluck model entries according to provided language
     *
     * @param integer $product_id
     * @param string $attribute
     * @return array
     *
     * @author Amk El-Kabbany at 27 May 2020
     * @contact alaa@upbeatdigital.team
     **/
    public function pluck($product_id, $attribute = 'user')
    {
        return ProductsFavourite::select('id')->where('product_id', $product_id)
                            ->groupBy('product_id')->get()->count();
    }

    /**
     * Create model record
     *
     * @param array $input
     *
     * @return ProductsFavourite
     *
     * @author Amk El-Kabbany at 27 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function create($input)
    {
        $productFavourite = new ProductsFavourite();
        $input['ip'] = Request::ip();
        $productFavourite->fill($input)->save();

        return $productFavourite;
    }

    /**
     * Update model record for given id
     *
     * @param array $input
     * @param int $id
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model
     *
     * @author Amk El-Kabbany at 27 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function update($input, $id)
    {
        $productFavourite = new ProductsFavourite();
        $productFavourite = $productFavourite->findOrFail($id);
        $input['ip'] = Request::ip();
        $productFavourite->fill($input)->save();
        return $productFavourite;
    }
}
