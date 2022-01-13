<?php
/**
 * Country resource class which handel data display
 *
 * @author Amk El-Kabbany at 17 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Resources;

use App\Models\Country;
use App\Models\Language;
use Illuminate\Database\Eloquent\Collection;

class CountryResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Country|Collection  $country
     * @param  string   $language
     * @return array
     *
     * @author Amk El-Kabbany at 17 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function toArray($country, $language)
    {
        $data= [];
        if($country instanceof Collection) {
            foreach ($country as $item) {
                $data[] = self::map($item, $language);
            }
        } else {
            $data = self::map($country, $language);
        }
        return $data;
    }

    /**
     * Map a resource into an array.
     *
     * @param  Country    $country
     * @param  string   $language
     * @return array
     *
     * @author Amk El-Kabbany at 17 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function map($country, $language)
    {
        $name = 'name_'.$language;
        return [
            'id'            => $country->id,
            'name'          => $country->$name,
            'key'           => $country->key,
            'code'          => $country->code,
            'shipping_cost' =>  $country->shipping_cost,
            'delivery_for_5k' => $country->delivery_for_5k,
            'additional_k'    => $country->additional_k,
            'active'        => $country->active,
            'featured'        => $country->featured,
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
        $country = [];
        if(isset($id)){
            $country = Country::find($id)->toArray();
            $country = self::mapLanguages($country, $input, $language);
        } else {
            foreach(Language::all() as $languageItem) {
                $country = self::mapLanguages($country, $input, $languageItem->prefix);
            }
        }
        return $country;
    }

    /**
     * Map an array to provided language.
     *
     * @param  array   $country
     * @param  array   $input
     * @param  string  $language
     * @return array
     *
     * @author Amk El-Kabbany at 17 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function mapLanguages($country, $input, $language)
    {
        if(isset($input['name'])){
            $title = 'name_'.$language;
            $country[$title] = $input['name'];
            unset($input['name']);
        }
        $country[$language] = true;
        return array_replace_recursive($country, $input);
    }
}
