<?php
/**
 * Address resource class which handel data display
 *
 * @author Amk El-Kabbany at 11 July 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Resources;

use App\Models\Address;
use Illuminate\Database\Eloquent\Collection;

class AddressResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Address|Collection    $address
     * @param  string   $language
     * @return array
     *
     * @author Amk El-Kabbany at 11 July 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function toArray($address, $language)
    {
        $data= [];
        if($address instanceof Collection) {
            foreach ($address as $item) {
                $data[] = self::map($item, $language);
            }
        } else {
            $data = self::map($address, $language);
        }
        return $data;
    }

    /**
     * Map a resource into an array.
     *
     * @param  Address    $address
     * @param  string   $language
     * @return array
     *
     * @author Amk El-Kabbany at 11 July 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function map($address, $language)
    {
        $name = 'name_'.$language;
        return [
            'id'            => $address->id,
            'user'          => $address->user->name,
            'name'          => $address->name,
            'mobile'        => $address->country->key.''.$address->mobile,
            'address'       => $address->address,
            'country'       => $address->country->$name,
            'delivery_for_5k' => $address->country->delivery_for_5k,
            'additional_k'  => $address->country->additional_k,
            'country_id'    => $address->country_id,
            'city'          => $address->city->$name,
            'city_id'       => $address->city_id,
            'main'          => $address->main,
        ];
    }


    /**
     * Map a request array to resource array.
     *
     * @param  array   $input
     * @param  int     $id
     * @return array
     *
     * @author Amk El-Kabbany at 11 July 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function casts($input, $id)
    {
        $address = Address::find($id)->toArray();
        return array_replace_recursive($address, $input);
    }
}
