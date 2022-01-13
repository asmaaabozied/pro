<?php
/**
 * Store Subscription resource class which handel data display
 *
 * @author Amk El-Kabbany at 18 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Resources;

use App\Models\StoreSubscription;
use Illuminate\Database\Eloquent\Collection;

class StoreSubscriptionResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  StoreSubscription|Collection  $storeSubscription
     * @param  string   $language
     * @return array
     *
     * @author Amk El-Kabbany at 18 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function toArray($storeSubscription, $language)
    {
        $data= [];
        if($storeSubscription instanceof Collection) {
            foreach ($storeSubscription as $item) {
                $data[] = self::map($item, $language);
            }
        } else {
            $data = self::map($storeSubscription, $language);
        }
        return $data;
    }

    /**
     * Map a resource into an array.
     *
     * @param  StoreSubscription    $storeSubscription
     * @param  string   $language
     * @return array
     *
     * @author Amk El-Kabbany at 18 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function map($storeSubscription, $language)
    {
        $name = 'name_'.$language;
        $title = 'title_'.$language;

        return [
            'id'            => $storeSubscription->id,
            'store'         => $storeSubscription->store->$name,
            'subscription'  => $storeSubscription->subscription->$title,
            'actual_price'  => $storeSubscription->actual_price,
            'price'         => $storeSubscription->price,
            'duration'      => $storeSubscription->duration,
            'expire_date'   => date('Y-m-d', strtotime($storeSubscription->expire_date)),
            'active'        => $storeSubscription->active,
        ];
    }

    /**
     * Map a request array to resource array.
     *
     * @param  array   $input
     * @param  int     $id
     * @return array
     *
     * @author Amk El-Kabbany at 18 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function casts($input, $id)
    {
        $storeSubscription = StoreSubscription::find($id)->toArray();

        return array_replace_recursive($storeSubscription, $input);
    }
}
