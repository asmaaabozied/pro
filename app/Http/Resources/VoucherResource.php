<?php
/**
 * Voucher Type resource class which handel data display
 *
 * @author Amk El-Kabbany at 31 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Resources;

use App\Models\Voucher;
use App\Models\Language;
use Illuminate\Database\Eloquent\Collection;

class VoucherResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Voucher|Collection  $voucher
     * @param  string   $language
     * @return array
     *
     * @author Amk El-Kabbany at 31 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function toArray($voucher, $language)
    {
        $data= [];
        if($voucher instanceof Collection) {
            foreach ($voucher as $item) {
                $data[] = self::map($item, $language);
            }
        } else {
            $data = self::map($voucher, $language);
        }
        return $data;
    }

    /**
     * Map a resource into an array.
     *
     * @param  Voucher    $voucher
     * @param  string   $language
     * @return array
     *
     * @author Amk El-Kabbany at 31 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function map($voucher, $language)
    {
        $title = 'title_'.$language;
        $description = 'description_'.$language;

        return [
            'id'            => $voucher->id,
            'title'         => $voucher->$title,
            'description'   => $voucher->$description,
            'code'          => $voucher->code,
            'count'         => $voucher->count,
            'rate'          => $voucher->rate,
            'start_date'    => date('Y-m-d', strtotime($voucher->start_date)),
            'end_date'      => date('Y-m-d', strtotime($voucher->end_date)),
            'store_id'          => $voucher->store_id,

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
     * @author Amk El-Kabbany at 31 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function casts($input, $language, $id = null)
    {
        $voucher = [];
        if($id != null){
            $voucher = Voucher::find($id)->toArray();
            $voucher = self::mapLanguages($voucher, $input, $language);
        } else {
            foreach(Language::all() as $languageItem) {
                $voucher = self::mapLanguages($voucher, $input, $languageItem->prefix);
            }
        }
        return $voucher;
    }

    /**
     * Map an array to provided language.
     *
     * @param  array   $voucher
     * @param  array   $input
     * @param  string  $language
     * @return array
     *
     * @author Amk El-Kabbany at 31 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function mapLanguages($voucher, $input, $language)
    {
        if(isset($input['title'])){
            $title = 'title_'.$language;
            $voucher[$title] = $input['title'];
            unset($input['title']);
        }
        if(isset($input['description'])){
            $title = 'description_'.$language;
            $voucher[$title] = $input['description'];
            unset($input['description']);
        }
        return array_replace_recursive($voucher, $input);
    }
}
