<?php
/**
 * Product Rating resource class which handel data display
 *
 * @author Amk El-Kabbany at 27 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Resources;

use App\Models\ProductRating;
use App\Models\Language;
use Illuminate\Database\Eloquent\Collection;

class ProductRatingResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  ProductRating|Collection  $productRating
     * @param  string   $language
     * @param  integer  $user_id
     * @return array
     *
     * @author Amk El-Kabbany at 27 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function toArray($productRating, $language, $user_id = null)
    {
        $data= [];
        if($productRating instanceof Collection) {
            foreach ($productRating as $item) {
                $data[] = self::map($item, $language, $user_id);
            }
        } else {
            $data = self::map($productRating, $language, $user_id);
        }
        return $data;
    }

    /**
     * Map a resource into an array.
     *
     * @param  ProductRating    $productRating
     * @param  string   $language
     * @param  integer  $user_id
     * @return array
     *
     * @author Amk El-Kabbany at 27 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function map($productRating, $language, $user_id = null)
    {
        $title = 'title_'.$language;

        $data =  [
            'id'        => $productRating->id,
            'user'      => $productRating->user->name,
            'product'   => $productRating->product->$title,
            'rate'      => $productRating->rate,
            'review'    => $productRating->review,
            'created_at'=> date('Y-m-d', strtotime($productRating->created_at)),
            'likes'     => $productRating->likes(),
            'dislikes'  => $productRating->dislikes(),
            'liked'     => false,
            'disliked'  => false,
        ];

        if($user_id != null){
            $data['liked']    = $productRating->isLiked($user_id);
            $data['disliked'] = $productRating->isDisliked($user_id);
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
     * @author Amk El-Kabbany at 27 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function casts($input, $id)
    {
        $productRating = ProductRating::find($id)->toArray();

        return array_replace_recursive($productRating, $input);
    }
}
