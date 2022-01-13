<?php
/**
 * Offer Type resource class which handel data display
 *
 * @author Amk El-Kabbany at 31 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Resources;

use App\Models\Offer;
use App\Models\Language;
use Illuminate\Database\Eloquent\Collection;

class OfferResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Offer|Collection  $offer
     * @param  string   $language
     * @return array
     *
     * @author Amk El-Kabbany at 31 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function toArray($offer, $language)
    {
        $data= [];
        if($offer instanceof Collection) {
            foreach ($offer as $item) {
                $data[] = self::map($item, $language);
            }
        } else {
            $data = self::map($offer, $language);
        }
        return $data;
    }

    /**
     * Map a resource into an array.
     *
     * @param  Offer    $offer
     * @param  string   $language
     * @return array
     *
     * @author Amk El-Kabbany at 31 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function map($offer, $language)
    {
        $title = 'title_'.$language;
        $description = 'description_'.$language;

        return [
            'id'            => $offer->id,
            'title'         => $offer->$title,
            'description'   => $offer->$description,
            'limit'         => $offer->limit,
            'rate'          => $offer->rate,
            'start_date'    => date('Y-m-d', strtotime($offer->start_date)),
            'end_date'      => date('Y-m-d', strtotime($offer->end_date)),
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
     * @author Amk El-Kabbany at 31 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function casts($input, $language, $id = null)
    {
        $offer = [];
        if($id != null){
            $offer = Offer::find($id)->toArray();
            $offer = self::mapLanguages($offer, $input, $language);
        } else {
            foreach(Language::all() as $languageItem) {
                $offer = self::mapLanguages($offer, $input, $languageItem->prefix);
            }
        }
        return $offer;
    }

    /**
     * Map an array to provided language.
     *
     * @param  array   $offer
     * @param  array   $input
     * @param  string  $language
     * @return array
     *
     * @author Amk El-Kabbany at 31 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function mapLanguages($offer, $input, $language)
    {
        if(isset($input['title'])){
            $title = 'title_'.$language;
            $offer[$title] = $input['title'];
            unset($input['title']);
        }
        if(isset($input['description'])){
            $title = 'description_'.$language;
            $offer[$title] = $input['description'];
            unset($input['description']);
        }
        return array_replace_recursive($offer, $input);
    }
}
