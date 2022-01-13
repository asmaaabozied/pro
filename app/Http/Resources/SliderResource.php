<?php
/**
 * Slider resource class which handel data display
 *
 * @author Amk El-Kabbany at 17 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Resources;

use App\Models\Slider;
use App\Models\Language;
use Illuminate\Database\Eloquent\Collection;

class SliderResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Slider|Collection  $slider
     * @param  string   $language
     * @return array
     *
     * @author Amk El-Kabbany at 17 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function toArray($slider, $language)
    {
        $data= [];
        if($slider instanceof Collection) {
            foreach ($slider as $item) {
                $data[] = self::map($item, $language);
            }
        } else {
            $data = self::map($slider, $language);
        }
        return $data;
    }

    /**
     * Map a resource into an array.
     *
     * @param  Slider    $slider
     * @param  string   $language
     * @return array
     *
     * @author Amk El-Kabbany at 17 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function map($slider, $language)
    {
        $title = 'title_'.$language;
        $description = 'description_'.$language;
        return [
            'id'            => $slider->id,
            'title'         => $slider->$title,
            'description'   => $slider->$description,
            'link'          => $slider->link,
            'product_id'    => $slider->product_id,
            'image'         => ($slider->image != null && trim($slider->image) != '')? asset($slider->image) : '',
            'active'        => $slider->active,
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
     * @author Amk El-Kabbany at 17 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function casts($input, $language, $id = null)
    {
        $slider = [];
        if($id != null){
            $slider = Slider::find($id)->toArray();
            $slider = self::mapLanguages($slider, $input, $language);
        } else {
            foreach(Language::all() as $languageItem) {
                $slider = self::mapLanguages($slider, $input, $languageItem->prefix);
            }
        }
        return $slider;
    }

    /**
     * Map an array to provided language.
     *
     * @param  array   $slider
     * @param  array   $input
     * @param  string  $language
     * @return array
     *
     * @author Amk El-Kabbany at 17 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function mapLanguages($slider, $input, $language)
    {
        if(isset($input['title'])){
            $title = 'title_'.$language;
            $slider[$title] = $input['title'];
            unset($input['title']);
        }
        if(isset($input['description'])){
            $title = 'description_'.$language;
            $slider[$title] = $input['description'];
            unset($input['description']);
        }
        $slider[$language] = true;
        return array_replace_recursive($slider, $input);
    }
}
