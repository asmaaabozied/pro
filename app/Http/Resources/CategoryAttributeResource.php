<?php
/**
 * Category Attribute resource class which handel data display
 *
 * @author Amk El-Kabbany at 14 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Resources;

use App\Models\CategoryAttribute;
use App\Models\Language;
use Illuminate\Database\Eloquent\Collection;

class CategoryAttributeResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  CategoryAttribute|Collection  $categoryAttribute
     * @param  string   $language
     * @return array
     *
     * @author Amk El-Kabbany at 14 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function toArray($categoryAttribute, $language)
    {
        $data= [];
        if($categoryAttribute instanceof Collection) {
            foreach ($categoryAttribute as $item) {
                if(count($item->values)){
                    $data[] = self::map($item, $language);
                }
                
            }
        } else {
            $data = self::map($categoryAttribute, $language);
        }
        return $data;
    }

    /**
     * Map a resource into an array.
     *
     * @param  CategoryAttribute   $categoryAttribute
     * @param  string   $language
     * @return array
     *
     * @author Amk El-Kabbany at 14 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function map($categoryAttribute, $language)
    {
        $name = 'name_'.$language;
        $description = 'description_'.$language;
        $title = 'title_' . $language;
        $value = 'value_' . $language;
        $data = [
            'id'            => $categoryAttribute->id,
            'name'          => $categoryAttribute->$name,
            'description'   => $categoryAttribute->$description,
            'unit'          => $categoryAttribute->unit,
            'active'        => $categoryAttribute->active,
        ];

        foreach($categoryAttribute->values->unique($value) as $value){
            $data['values'][] = [
                'id'            => $value->id,
                'title'         => $value->$title,
                'description'   => $value->$description,
                'value'         => $value->value_en
            ];
        }
        
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
     * @author Amk El-Kabbany at 14 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function casts($input, $language, $id = null)
    {
        $categoryAttribute = [];
        if(isset($id)){
            $categoryAttribute = CategoryAttribute::find($id)->toArray();
            $categoryAttribute = self::mapLanguages($categoryAttribute, $input, $language);
        } else {
            foreach(Language::all() as $languageItem) {
                $categoryAttribute = self::mapLanguages($categoryAttribute, $input, $languageItem->prefix);
            }
        }
        return $categoryAttribute;
    }

    /**
     * Map an array to provided language.
     *
     * @param  array   $categoryAttribute
     * @param  array   $input
     * @param  string  $language
     * @return array
     *
     * @author Amk El-Kabbany at 14 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function mapLanguages($categoryAttribute, $input, $language)
    {
        if(isset($input['name'])){
            $name = 'name_'.$language;
            $categoryAttribute[$name] = $input['name'];
            unset($input['name']);
        }
        if(isset($input['description'])){
            $name = 'description_'.$language;
            $categoryAttribute[$name] = $input['description'];
            unset($input['description']);
        }
        return array_replace_recursive($categoryAttribute, $input);
    }
}
