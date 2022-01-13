<?php
/**
 * Brand resource class which handel data display
 *
 * @author Amk El-Kabbany at 14 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Resources;

use App\Models\Brand;
use App\Models\Language;
use Illuminate\Database\Eloquent\Collection;

class BrandResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Brand|Collection    $brand
     * @param  string   $language
     * @return array
     *
     * @author Amk El-Kabbany at 14 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function toArray($brand, $language)
    {
        $data= [];
        if($brand instanceof Collection) {
            foreach ($brand as $item) {
                $data[] = self::map($item, $language);
            }
        } else {
            $data = self::map($brand, $language);
        }
        return $data;
    }

    /**
     * Map a resource into an array.
     *
     * @param  Brand    $brand
     * @param  string   $language
     * @return array
     *
     * @author Amk El-Kabbany at 14 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function map($brand, $language)
    {
        $title = 'title_'.$language;
        $description = 'description_'.$language;
        return [
            'id'            => $brand->id,
            'category'      => $brand->category->$title,
            'title'         => $brand->$title,
            'description'   => $brand->$description,
            'image'         => ($brand->image != null && trim($brand->image) != '')? asset($brand->image) : '',
            'active'        => $brand->active,
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
     * @author Amk El-Kabbany at 14 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function casts($input, $language, $id = null)
    {
        $brand = [];
        if(isset($id)){
            $brand = Brand::find($id)->toArray();
            $brand = self::mapLanguages($brand, $input, $language);
        } else {
            foreach(Language::all() as $languageItem) {
                $brand = self::mapLanguages($brand, $input, $languageItem->prefix);
            }
        }
        return $brand;
    }

    /**
     * Map an array to provided language.
     *
     * @param  array   $brand
     * @param  array   $input
     * @param  string  $language
     * @return array
     *
     * @author Amk El-Kabbany at 14 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function mapLanguages($brand, $input, $language)
    {
        if(isset($input['title'])){
            $title = 'title_'.$language;
            $brand[$title] = $input['title'];
            unset($input['title']);
        }
        if(isset($input['description'])){
            $title = 'description_'.$language;
            $brand[$title] = $input['description'];
            unset($input['description']);
        }
        $brand[$language] = true;
        return array_replace_recursive($brand, $input);
    }
}
