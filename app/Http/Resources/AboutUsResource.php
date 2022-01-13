<?php
/**
 * About us Type resource class which handel data display
 *
 * @author Amk El-Kabbany at 7 June 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Resources;

use App\Models\AboutUs;
use App\Models\Language;
use Illuminate\Database\Eloquent\Collection;

class AboutUsResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  AboutUs|Collection  $aboutus
     * @param  string   $language
     * @return array
     *
     * @author Amk El-Kabbany at 7 June 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function toArray($aboutus, $language)
    {
        $data= [];
        if($aboutus instanceof Collection) {
            foreach ($aboutus as $item) {
                $data[] = self::map($item, $language);
            }
        } else {
            $data = self::map($aboutus, $language);
        }
        return $data;
    }

    /**
     * Map a resource into an array.
     *
     * @param  AboutUs    $aboutus
     * @param  string   $language
     * @return array
     *
     * @author Amk El-Kabbany at 7 June 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function map($aboutus, $language)
    {
        $title = 'title_'.$language;
        $description = 'description_'.$language;

        return [
            'id'            => $aboutus->id,
            'title'         => $aboutus->$title,
            'description'   => $aboutus->$description,
            'active'        => $aboutus->active,
            'image'         => ($aboutus->image != null && trim($aboutus->image) != '')? asset($aboutus->image) : '',
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
     * @author Amk El-Kabbany at 7 June 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function casts($input, $language, $id = null)
    {
        $aboutus = [];
        if($id != null){
            $aboutus = AboutUs::find($id)->toArray();
            $aboutus = self::mapLanguages($aboutus, $input, $language);
        } else {
            foreach(Language::all() as $languageItem) {
                $aboutus = self::mapLanguages($aboutus, $input, $languageItem->prefix);
            }
        }
        return $aboutus;
    }

    /**
     * Map an array to provided language.
     *
     * @param  array   $aboutus
     * @param  array   $input
     * @param  string  $language
     * @return array
     *
     * @author Amk El-Kabbany at 7 June 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function mapLanguages($aboutus, $input, $language)
    {
        if(isset($input['title'])){
            $title = 'title_'.$language;
            $aboutus[$title] = $input['title'];
            unset($input['title']);
        }
        if(isset($input['description'])){
            $title = 'description_'.$language;
            $aboutus[$title] = $input['description'];
            unset($input['description']);
        }
        $product[$language] = true;
        return array_replace_recursive($aboutus, $input);
    }
}
