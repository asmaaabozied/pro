<?php
/**
 * Coupon Rating resource class which handel data display
 *
 * @author Amk El-Kabbany at 27 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Resources;

use App\Models\CouponRating;
use App\Models\Language;
use Illuminate\Database\Eloquent\Collection;

class CouponRatingResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  CouponRating|Collection  $CouponRating
     * @param  string   $language
     * @param  integer  $user_id
     * @return array
     *
     * @author Amk El-Kabbany at 27 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function toArray($CouponRating, $language, $user_id = null)
    {
        $data= [];
        if($CouponRating instanceof Collection) {
            foreach ($CouponRating as $item) {
                $data[] = self::map($item, $language, $user_id);
            }
        } else {
            $data = self::map($CouponRating, $language, $user_id);
        }
        return $data;
    }

    /**
     * Map a resource into an array.
     *
     * @param  CouponRating    $CouponRating
     * @param  string   $language
     * @param  integer  $user_id
     * @return array
     *
     * @author Amk El-Kabbany at 27 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function map($CouponRating, $language, $user_id = null)
    {
        $title = 'title_'.$language;

        $data =  [
            'id'        => $CouponRating->id,
            'user'      => $CouponRating->user->name,
            'Coupon'   => $CouponRating->Coupon->$title,
            'rate'      => $CouponRating->rate,
            'review'    => $CouponRating->review,
            'created_at'=> date('Y-m-d', strtotime($CouponRating->created_at)),
            'likes'     => $CouponRating->likes(),
            'dislikes'  => $CouponRating->dislikes(),
            'liked'     => false,
            'disliked'  => false,
        ];

        if($user_id != null){
            $data['liked']    = $CouponRating->isLiked($user_id);
            $data['disliked'] = $CouponRating->isDisliked($user_id);
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
        $CouponRating = CouponRating::find($id)->toArray();

        return array_replace_recursive($CouponRating, $input);
    }
}
