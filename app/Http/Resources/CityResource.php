<?php
/**
 * City resource class which handel data display
 *
 * @author Amk El-Kabbany at 17 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Resources;

use App\Models\City;
use App\Models\Language;
use Illuminate\Database\Eloquent\Collection;

class CityResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  City|Collection  $city
     * @param  string   $language
     * @return array
     *
     * @author Amk El-Kabbany at 17 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function toArray($city, $language)
    {
        $data= [];
        if($city instanceof Collection) {
            foreach ($city as $item) {
                $data[] = self::map($item, $language);
            }
        } else {
            $data = self::map($city, $language);
        }
        return $data;
    }

    /**
     * Map a resource into an array.
     *
     * @param  City    $city
     * @param  string   $language
     * @return array
     *
     * @author Amk El-Kabbany at 17 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function map($city, $language)
    {
        $name = 'name_'.$language;
        return [
            'id'            => $city->id,
            'country'       => @$city->country->$name,
            'name'          => $city->$name,
            'postal_code'   => $city->postal_code,
            'active'        => $city->active,
        ];
    }

    /**
     * Map a request array to resource array.
     *
     * @param  array   $input
     * @param  string  $language
     * @param  int     $id
     * @return array
     *
     * @author Amk El-Kabbany at 17 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function casts($input, $language, $id = null)
    {
        $city = [];
        if(isset($id)){
            $city = City::find($id)->toArray();
            $city = self::mapLanguages($city, $input, $language);
        } else {
            foreach(Language::all() as $languageItem) {
                $city = self::mapLanguages($city, $input, $languageItem->prefix);
            }
        }
        return $city;
    }

    /**
     * Map an array to provided language.
     *
     * @param  array   $city
     * @param  array   $input
     * @param  string  $language
     * @return array
     *
     * @author Amk El-Kabbany at 17 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function mapLanguages($city, $input, $language)
    {
        if(isset($input['name'])){
            $title = 'name_'.$language;
            $city[$title] = $input['name'];
            unset($input['name']);
        }
        $city[$language] = true;
        return array_replace_recursive($city, $input);
    }
}
