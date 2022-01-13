<?php
/**
 * Products Favourite resource class which handel data display
 *
 * @author Amk El-Kabbany at 27 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Resources;

use App\Models\ProductsFavourite;
use App\Models\Language;
use Illuminate\Database\Eloquent\Collection;

class ProductsFavouriteResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  ProductsFavourite|Collection  $productsFavourite
     * @param  string   $language
     * @return array
     *
     * @author Amk El-Kabbany at 27 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function toArray($productsFavourite, $language)
    {
        $data= [];
        if($productsFavourite instanceof Collection) {
            foreach ($productsFavourite as $item) {
                $data[] = self::map($item, $language);
            }
        } else {
            $data = self::map($productsFavourite, $language);
        }
        return $data;
    }

    /**
     * Map a resource into an array.
     *
     * @param  ProductsFavourite    $productsFavourite
     * @param  string   $language
     * @return array
     *
     * @author Amk El-Kabbany at 27 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function map($productsFavourite, $language)
    {
        $title = 'title_'.$language;

        return [
            'id'        => $productsFavourite->id,
            'user'      => @$productsFavourite->user->name,
            'product'   => $productsFavourite->product->$title,
        ];
    }
}
