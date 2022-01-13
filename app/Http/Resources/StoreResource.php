<?php
/**
 * Store Type resource class which handel data display
 *
 * @author Amk El-Kabbany at 18 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Resources;

use App\Models\Store;
use App\Models\Language;
use Illuminate\Database\Eloquent\Collection;

class StoreResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Store|Collection  $store
     * @param  string   $language
     * @return array
     *
     * @author Amk El-Kabbany at 18 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function toArray($store, $language)
    {
        $data= [];
        if($store instanceof Collection) {
            foreach ($store as $item) {
                $data[] = self::map($item, $language);
            }
        } else {
            $data = self::map($store, $language);
        }
        return $data;
    }

    /**
     * Map a resource into an array.
     *
     * @param  Store    $store
     * @param  string   $language
     * @return array
     *
     * @author Amk El-Kabbany at 18 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function map($store, $language)
    {
        $name = 'name_'.$language;
        $description = 'description_'.$language;
        $type = 'type_'.$language;

        return [
            'id'            => $store->id,
            'name'          => $store->$name,
            'description'   => $store->$description,
            'phone'         => $store->phone,
            'image'         => ($store->image != null && trim($store->image) != '')? asset($store->image) : '',
            'type'          => $store->type->$type,
            'owner'         => $store->owner->name,
            'status'        => $store->status,
            'activated'     => $store->activated,
            'created_at'    => date('Y-m-d', strtotime($store->created_at)),
            'rate'          => $store->rate(),
            'raters'        => $store->raters(),
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
        $store = [];
        if($id != null){
            $store = Store::find($id)->toArray();
            $store = self::mapLanguages($store, $input, $language);
        } else {
            foreach(Language::all() as $languageItem) {
                $store = self::mapLanguages($store, $input, $languageItem->prefix);
            }
        }
        return $store;
    }

    /**
     * Map an array to provided language.
     *
     * @param  array   $store
     * @param  array   $input
     * @param  string  $language
     * @return array
     *
     * @author Amk El-Kabbany at 18 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function mapLanguages($store, $input, $language)
    {
        if(isset($input['name'])){
            $title = 'name_'.$language;
            $store[$title] = $input['name'];
            unset($input['name']);
        }
        if(isset($input['description'])){
            $title = 'description_'.$language;
            $store[$title] = $input['description'];
            unset($input['description']);
        }
        return array_replace_recursive($store, $input);
    }
}
