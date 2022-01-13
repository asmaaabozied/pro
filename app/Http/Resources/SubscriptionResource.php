<?php
/**
 * Subscription resource class which handel data display
 *
 * @author Amk El-Kabbany at 18 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Resources;

use App\Models\Subscription;
use App\Models\Language;
use Illuminate\Database\Eloquent\Collection;

class SubscriptionResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Subscription|Collection  $subscription
     * @param  string   $language
     * @return array
     *
     * @author Amk El-Kabbany at 18 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function toArray($subscription, $language)
    {
        $data= [];
        if($subscription instanceof Collection) {
            foreach ($subscription as $item) {
                $data[] = self::map($item, $language);
            }
        } else {
            $data = self::map($subscription, $language);
        }
        return $data;
    }

    /**
     * Map a resource into an array.
     *
     * @param  Subscription    $subscription
     * @param  string   $language
     * @return array
     *
     * @author Amk El-Kabbany at 18 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function map($subscription, $language)
    {
        $title = 'title_'.$language;
        $description = 'description_'.$language;

        return [
            'id'            => $subscription->id,
            'title'         => $subscription->$title,
            'description'   => $subscription->$description,
            'price'         => $subscription->price,
            'duration'      => $subscription->duration,
            'active'        => $subscription->active,
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
        $subscription = [];
        if($id != null){
            $subscription = Subscription::find($id)->toArray();
            $subscription = self::mapLanguages($subscription, $input, $language);
        } else {
            foreach(Language::all() as $languageItem) {
                $subscription = self::mapLanguages($subscription, $input, $languageItem->prefix);
            }
        }
        return $subscription;
    }

    /**
     * Map an array to provided language.
     *
     * @param  array   $subscription
     * @param  array   $input
     * @param  string  $language
     * @return array
     *
     * @author Amk El-Kabbany at 18 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function mapLanguages($subscription, $input, $language)
    {
        if(isset($input['title'])){
            $title = 'title_'.$language;
            $subscription[$title] = $input['title'];
            unset($input['title']);
        }
        if(isset($input['description'])){
            $title = 'description_'.$language;
            $subscription[$title] = $input['description'];
            unset($input['description']);
        }
        $subscription[$language] = true;
        return array_replace_recursive($subscription, $input);
    }
}
