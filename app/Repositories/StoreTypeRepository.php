<?php
/**
 * Store Type repository class which handel more of logic actions
 *
 * @author Amk El-Kabbany at 7 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Repositories;

use App\Models\Store;
use App\Models\StoreType;
use App\Repositories\BaseRepository;
use Laracasts\Flash\Flash;

/**
 * Class StoreTypeRepository
 * @package App\Repositories
 * @version May 7, 2020, 6:07 pm UTC
*/

class StoreTypeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'type_en',
        'active',
        'en'
    ];

    /**
     * Class constructor
     *
     * @author Amk El-Kabbany at 7 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function __construct()
    {
        parent::__construct(app());
        $this->fieldSearchable = array_keys(alterLangArrayElements('store_types', ['fields' => array_combine($this->fieldSearchable,$this->fieldSearchable)], $key = 'fields')['fields']);
    }

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
        return StoreType::class;
    }

    /**
     * Pluck model entries according to provided language
     *
     * @param string $language
     * @return array
     *
     * @author Amk El-Kabbany at 18 May 2020
     * @contact alaa@upbeatdigital.team
     **/
    public function pluck($language)
    {
        $type = 'type_'.$language;
        return StoreType::where('deleted_at', null)->where('active', true)
           ->pluck($type, 'id');
    }

    /**
     * Create model record
     *
     * @param array $input
     *
     * @return StoreType
     *
     * @author Amk El-Kabbany at 7 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function create($input)
    {
        $storeType = new StoreType();
        $storeType->fill($input)->save();

        return $storeType;
    }

    /**
     * @param int $id
     *
     * @throws \Exception
     *
     * @return bool|mixed|null
     *
     * @author Amk El-Kabbany at 7 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function delete($id)
    {
        $query = $this->model->newQuery();

        $storeType = $query->find($id);
        if(Store::where('store_type', $id)->exists()) {
            Flash::error(trans('storeType.messages.type_store_assigned'));
            return false;
        }

        $storeType->delete();

        return true;
    }
}
