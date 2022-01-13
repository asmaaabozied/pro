<?php
/**
 * City repository class which handel more of logic actions
 *
 * @author Amk El-Kabbany at 4 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Repositories;

use App\Models\City;
use App\Models\Country;
use App\Repositories\BaseRepository;

/**
 * Class CityRepository
 * @package App\Repositories
 * @version May 4, 2020, 2:58 pm UTC
 *
 * @author Amk El-Kabbany at 4 May 2020
 * @contact alaa@upbeatdigital.team
*/

class CityRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'country_id',
        'name_en',
        'postal_code',
        'active',
        'en',
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
        return City::class;
    }

    /**
     * Lists cities entries according to provided country id
     *
     * @param int    $country_id
     * @return array
     *
     * @author Amk El-Kabbany at 18 May 2020
     * @contact alaa@upbeatdigital.team
     **/
    public function showByCountry($country_id = null)
    {
        if($country_id != null) {
            return @Country::where('deleted_at', null)->where('active', true)
                ->where('id', $country_id)->first()->cities;
        } else {
            return City::where('deleted_at', null)->where('active', true)->get();
        }
    }

    /**
     * Pluck model entries according to provided language
     *
     * @param string $language
     * @param int    $country_id
     * @return array
     *
     * @author Amk El-Kabbany at 18 May 2020
     * @contact alaa@upbeatdigital.team
     **/
    public function pluck($language, $country_id = null)
    {
        $name = 'name_'.$language;
        return City::where('deleted_at', null)->when($country_id != null, function ($query, $country_id){
            return $query->where('country_id', $country_id);
        })->where('active', true)->where($language, true)->orderBy($name)->pluck($name, 'id');
    }

    /**
     * Create model record
     *
     * @param array $input
     *
     * @return City
     *
     * @author Amk El-Kabbany at 28 Apr 2020
     * @contact alaa@upbeatdigital.team
     */
    public function create($input)
    {
        $city = new City();
        $city->fill($input)->save();

        return $city;
    }


    /**
     * Update model record for given id
     *
     * @param array $input
     * @param int $id
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model
     *
     * @author Amk El-Kabbany at 28 Apr 2020
     * @contact alaa@upbeatdigital.team
     */
    public function update($input, $id)
    {
        $city = new City();
        $city = $city->findOrFail($id);
        $city->fill($input)->save();
        return $city;
    }
}
