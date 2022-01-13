<?php
/**
 * Country repository class which handel more of logic actions
 *
 * @author Amk El-Kabbany at 4 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Repositories;

use App\Models\City;
use App\Models\Country;
use App\Repositories\BaseRepository;
use Laracasts\Flash\Flash;

/**
 * Class CountryRepository
 * @package App\Repositories
 * @version May 4, 2020, 9:12 am UTC
 *
 * @author Amk El-Kabbany at 4 May 2020
 * @contact alaa@upbeatdigital.team
*/

class CountryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name_en',
        'key',
        'code',
        'shipping_cost',
        'active',
        'en',
    ];

    /**
     * Class constructor
     *
     * @author Amk El-Kabbany at 4 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function __construct()
    {
        parent::__construct(app());
        $this->fieldSearchable = array_keys(alterLangArrayElements('countries', ['fields' => array_combine($this->fieldSearchable,$this->fieldSearchable)], $key = 'fields')['fields']);
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
        return Country::class;
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
        $name = 'name_'.$language;
        return Country::where('deleted_at', null)->where('active', true)
            ->where($language, true)->orderBy($name)->pluck($name, 'id');
    }

    /**
     * Create model record
     *
     * @param array $input
     *
     * @return Country
     *
     * @author Amk El-Kabbany at 28 Apr 2020
     * @contact alaa@upbeatdigital.team
     */
    public function create($input)
    {
        $country = new Country();
        $country->fill($input)->save();

        return $country;
    }

    /**
     * Update model record for given id
     *
     * @param array $input
     * @param int $id
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model
     */
    public function update($input, $id)
    {
        $country = new Country();
        $country = $country->findOrFail($id);
        $country->fill($input)->save();
        return $country;
    }

    /**
     * @param int $id
     *
     * @throws \Exception
     *
     * @return bool|mixed|null
     *
     * @author Amk El-Kabbany at 4 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function delete($id)
    {
        $query = $this->model->newQuery();

        $country = $query->find($id);
        if(City::where('country_id', $id)->exists()) {
            Flash::error(trans('country.messages.category_city_assigned'));
            return false;
        }

        $country->delete();

        return true;
    }
}
