<?php
/**
 * Social Media Link resource class which handel data display
 *
 * @author Amk El-Kabbany at 8 June 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Resources;

use App\Models\SocialMediaLink;
use App\Models\Language;
use Illuminate\Database\Eloquent\Collection;

class SocialMediaLinkResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  SocialMediaLink|Collection  $product
     * @param  string   $language
     * @return array
     *
     * @author Amk El-Kabbany at 8 June 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function toArray($product, $language)
    {
        $data= [];
        if($product instanceof Collection) {
            foreach ($product as $item) {
                $data[] = self::map($item, $language);
            }
        } else {
            $data = self::map($product, $language);
        }
        return $data;
    }

    /**
     * Map a resource into an array.
     *
     * @param  SocialMediaLink    $product
     * @param  string   $language
     * @return array
     *
     * @author Amk El-Kabbany at 8 June 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function map($product, $language)
    {
        $title = 'title_'.$language;
        $description = 'description_'.$language;
        
        $data = [
            'id'                => $product->id,
            'title'             => $product->$title,
            'description'       => $product->$description,
            'background_color'  => $product->background_color,
            'icon'              => $product->icon,
            'link'              => $product->link,
            'class'             => $product->class,
            'active'            => $product->active,
        ];
        return $data;
    }

    /**
     * Map a request array to resource array.
     *
     * @param  array   $input
     * @param  string  $language
     * @param  int     $id
     * @return array
     *
     * @author Amk El-Kabbany at 8 June 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function casts($input, $language, $id = null)
    {
        $product = [];
        if($id != null){
            $product = SocialMediaLink::find($id)->toArray();
            $product = self::mapLanguages($product, $input, $language);
        } else {
            foreach(Language::all() as $languageItem) {
                $product = self::mapLanguages($product, $input, $languageItem->prefix);
            }
        }
        return $product;
    }

    /**
     * Map an array to provided language.
     *
     * @param  array   $product
     * @param  array   $input
     * @param  string  $language
     * @return array
     *
     * @author Amk El-Kabbany at 8 June 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function mapLanguages($product, $input, $language)
    {
        if(isset($input['title'])){
            $title = 'title_'.$language;
            $product[$title] = $input['title'];
            unset($input['title']);
        }
        if(isset($input['description'])){
            $title = 'description_'.$language;
            $product[$title] = $input['description'];
            unset($input['description']);
        }
        $product[$language] = true;
        return array_replace_recursive($product, $input);
    }
}
