<?php
/**
 * Store Rating resource class which handel data display
 *
 * @author Amk El-Kabbany at 18 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Resources;

use App\Models\StoreRating;
use App\Models\Language;
use Illuminate\Database\Eloquent\Collection;

class StoreRatingResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  StoreRating|Collection  $storeRating
     * @param  string   $language
     * @param  integer  $user_id
     * @return array
     *
     * @author Amk El-Kabbany at 18 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function toArray($storeRating, $language, $user_id = null)
    {
        $data= [];
        if($storeRating instanceof Collection) {
            foreach ($storeRating as $item) {
                $data[] = self::map($item, $language, $user_id);
            }
        } else {
            $data = self::map($storeRating, $language, $user_id);
        }
        return $data;
    }

    /**
     * Map a resource into an array.
     *
     * @param  StoreRating  $storeRating
     * @param  string   $language
     * @param  integer  $user_id
     * @return array
     *
     * @author Amk El-Kabbany at 18 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function map($storeRating, $language, $user_id = null)
    {
        $name = 'name_'.$language;

        $data =  [
            'id'        => $storeRating->id,
            'user'      => $storeRating->user->name,
            'store'     => $storeRating->store->$name,
            'rate'      => $storeRating->rate,
            'review'    => $storeRating->review,
            'created_at'=> date('Y-m-d', strtotime($storeRating->created_at)),
            'likes'     => $storeRating->likes(),
            'dislikes'  => $storeRating->dislikes(),
            'liked'     => false,
            'disliked'  => false,
        ];

        if($user_id != null){
            $data['liked']    = $storeRating->isLiked($user_id);
            $data['disliked'] = $storeRating->isDisliked($user_id);
        }

        return $data;
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
        $storeRating = StoreRating::find($id)->toArray();

        return array_replace_recursive($storeRating, $input);
    }
}
