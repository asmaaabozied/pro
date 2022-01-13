<?php
/**
 * Store Type resource class which handel data display
 *
 * @author Amk El-Kabbany at 18 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Resources;

use App\Models\StoreType;
use App\Models\Language;
use Illuminate\Database\Eloquent\Collection;

class StoreTypeResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  StoreType|Collection  $storeType
     * @param  string   $language
     * @return array
     *
     * @author Amk El-Kabbany at 18 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function toArray($storeType, $language)
    {
        $data= [];
        if($storeType instanceof Collection) {
            foreach ($storeType as $item) {
                $data[] = self::map($item, $language);
            }
        } else {
            $data = self::map($storeType, $language);
        }
        return $data;
    }

    /**
     * Map a resource into an array.
     *
     * @param  StoreType    $storeType
     * @param  string   $language
     * @return array
     *
     * @author Amk El-Kabbany at 18 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function map($storeType, $language)
    {
        $type = 'type_'.$language;

        return [
            'id'      => $storeType->id,
            'type'    => $storeType->$type,
            'active'  => $storeType->active,
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
     * @author Amk El-Kabbany at 18 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function casts($input, $language, $id = null)
    {
        $storeType = [];
        if($id != null){
            $storeType = StoreType::find($id)->toArray();
            $storeType = self::mapLanguages($storeType, $input, $language);
        } else {
            foreach(Language::all() as $languageItem) {
                $storeType = self::mapLanguages($storeType, $input, $languageItem->prefix);
            }
        }
        return $storeType;
    }

    /**
     * Map an array to provided language.
     *
     * @param  array   $storeType
     * @param  array   $input
     * @param  string  $language
     * @return array
     *
     * @author Amk El-Kabbany at 18 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function mapLanguages($storeType, $input, $language)
    {
        if(isset($input['type'])){
            $title = 'type_'.$language;
            $storeType[$title] = $input['type'];
            unset($input['type']);
        }
        $storeType[$language] = true;
        return array_replace_recursive($storeType, $input);
    }
}
