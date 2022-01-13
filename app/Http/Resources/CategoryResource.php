<?php
/**
 * Category resource class which handel data display
 *
 * @author Amk El-Kabbany at 14 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Resources;

use App\Models\Category;
use App\Models\Language;
use Illuminate\Database\Eloquent\Collection;

class CategoryResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Category|Collection  $category
     * @param  string   $language
     * @return array
     *
     * @author Amk El-Kabbany at 14 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function toArray($category, $language)
    {
        $data= [];
        if($category instanceof Collection) {
            foreach ($category as $item) {
                $data[] = self::map($item, $language);
            }
        } else {
            $data = self::map($category, $language);
        }
        return $data;
    }

    /**
     * Map a resource into an array.
     *
     * @param  Category    $category
     * @param  string   $language
     * @return array
     *
     * @author Amk El-Kabbany at 14 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function map($category, $language)
    {
        $title = 'title_'.$language;
        $description = 'description_'.$language;
        return [
            'id'            => $category->id,
            'parent'        => @$category->category->$title,
            'title'         => $category->$title,
            'description'   => $category->$description,
            'image'         => ($category->image != null && trim($category->image) != '')? asset($category->image) : '',
            'icon'          => ($category->icon != null && trim($category->icon) != '')? asset($category->icon) : '',
            'active'        => $category->active,
            'menu'          => $category->menu,
            'order'         => $category->order,
            'min_price_range' => ($category->minPriceRange() != null)? $category->minPriceRange() : 0,
            'max_price_range' => ($category->maxPriceRange() != null)? $category->maxPriceRange() : 0,
            'subcount'        => $category->subCategories != null ? $category->subCategories : 0,


            //add by asmaa       'images_slider'=>ImageResource::collection($this->images),


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
        $category = [];
        if(isset($id)){
            $category = Category::find($id)->toArray();
            $category = self::mapLanguages($category, $input, $language);
        } else {
            foreach(Language::all() as $languageItem) {
                $category = self::mapLanguages($category, $input, $languageItem->prefix);
            }
        }
        return $category;
    }

    /**
     * Map an array to provided language.
     *
     * @param  array   $category
     * @param  array   $input
     * @param  string  $language
     * @return array
     *
     * @author Amk El-Kabbany at 14 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function mapLanguages($category, $input, $language)
    {
        if(isset($input['title'])){
            $title = 'title_'.$language;
            $category[$title] = $input['title'];
            unset($input['title']);
        }
        if(isset($input['description'])){
            $title = 'description_'.$language;
            $category[$title] = $input['description'];
            unset($input['description']);
        }
        $category[$language] = true;
        return array_replace_recursive($category, $input);
    }
}
