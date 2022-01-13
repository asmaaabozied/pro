<?php

namespace App\Http\Resources;

use App\Models\Language;
use Illuminate\Database\Eloquent\Collection;

class CouponResource
{
    public static function toArray($coupon, $language){
        $data= [];
        if($coupon instanceof Collection) {
            foreach ($coupon as $item) {
                $data[] = self::map($item, $language);
            }
        } else {
            $data = self::map($coupon, $language);
        }
        return $data;
    }

    
    public static function map($coupon, $language){
        $title = 'title_'.$language;
        $description = 'description_'.$language;
        return [
            'id'            => $coupon->id,
            'title'          => $coupon->$title,
            'description'   => $coupon->$description,
            'view'          => $coupon->view,
            'code'          => $coupon->code,
            'count'         => $coupon->count,
            'rate'          => $coupon->discount_rate,
            'start_date'    => date('Y-m-d', strtotime($coupon->start_at)),
            'end_date'      => date('Y-m-d', strtotime($coupon->valid_to)),
            'store_id'          => $coupon->store_id,
            // 'city'          => $coupon->city->name,
            'image'         => ($coupon->image != null && trim($coupon->image) != '')? asset($coupon->image) : '',
            'active'     => $coupon->active,
            'created_at'    => date('Y-m-d', strtotime($coupon->created_at)),
            // 'rate'          => $coupon->rate(),
            // 'raters'        => $coupon->raters(),
            'active'        => $coupon->active,
            'inslider'        => $coupon->inslider,
            'featured'      => $coupon->featured,
        ];
    }

    public static function casts($input, $language, $id = null){
        $coupon = [];
        if($id != null){
            $coupon = Coupon::find($id)->toArray();
            $coupon = self::mapLanguages($coupon, $input, $language);
        } else {
            foreach(Language::all() as $languageItem) {
                $coupon = self::mapLanguages($coupon, $input, $languageItem->prefix);
            }
        }
        return $coupon;
    }

    public static function mapLanguages($coupon, $input, $language){
        if(isset($input['title'])){
            $title = 'title_'.$language;
            $coupon[$title] = $input['title'];
            unset($input['title']);
        }
        if(isset($input['description'])){
            $title = 'description_'.$language;
            $coupon[$title] = $input['description'];
            unset($input['description']);
        }
        return array_replace_recursive($coupon, $input);
    }
    
}
