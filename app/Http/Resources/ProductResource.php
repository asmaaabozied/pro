<?php
/**
 * Product resource class which handel data display
 *
 * @author Amk El-Kabbany at 21 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Resources;

use App\Models\Product;
use App\Models\Language;
use App\Models\ProductsFavourite;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Collection;

class ProductResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Product|Collection|array  $product
     * @param  string   $language
     * @param  string   $token
     * @return array
     *
     * @author Amk El-Kabbany at 21 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function toArray($product, $language, $token = null)
    {
        $data= [];
        if($product instanceof Collection || is_array($product)) {
            foreach ($product as $item) {
                if(! ($item->active == false && $item->quantity != 0)){
                    $data[] = self::map($item, $language, $token);
                }
            }
        } else {
            if(! ($product->active == false && $product->quantity != 0)){
                $data = self::map($product, $language, $token);
            }
        }
        return $data;
    }

    /**
     * Map a resource into an array.
     *
     * @param  Product  $product
     * @param  string   $language
     * @param  string   $token
     * @return array
     *
     * @author Amk El-Kabbany at 21 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function map($product, $language, $token = null)
    {
        $name  = 'name_'.$language;
        $title = 'title_'.$language;
        $value = 'value_'.$language;
        $description = 'description_'.$language;
        
        $data = [
            'id'            => $product->id,
            'category'      => $product->category->$title,
            'brand'         => $product->brand->$title,
            'title'         => $product->$title,
            'description'   => $product->$description,
            'image'         => asset($product->mainImage()),
            'price'         => $product->price,
            'quantity'      => $product->quantity,
            'weight'        => $product->finalWeight(),
            'attributes'    => [],
            'discount'      => $product->discount,
            'active'        => $product->active,
            'rate'          => $product->rate(),
            'raters'        => $product->raters(),
            'featured'      => $product->featured,
            'favorite'      => false,
        ];
        
        if($product->discount) {
            $data['discount_rate']          = $product->discount_rate;
            $data['discount_price']         = round(($product->price - ((floatval($product->discount_rate)*floatval($product->price))/100)), 1);
            $data['discount_start_date']    = date('Y-m-d', strtotime($product->discount_start_date));
            $data['discount_end_date']      = date('Y-m-d', strtotime($product->discount_end_date));
            $data['discount_month']         = date('m', strtotime($product->discount_start_date));
        }

        $data['attributes'] = [];
        foreach ($product->activeAttributes() as $attribute) {
            $data['attributes'][] = [
                'title' => $attribute->$title,
                'value' => $attribute->$value,
            ];
        }

        if($token != null){
            $user = (new UserRepository(app()))->findByToken($token);
            if(ProductsFavourite::where('user_id', @$user->id)->where('product_id', $product->id)->exists()) {
                $data['favorite'] = true;
            }
        }

        $data['store'] = [
            'id'    => $product->store->id,
            'name'  => $product->store->$name,
            'phone' => $product->store->phone,
            'image' => $product->store->image_path,
            'rate'  => $product->store->rate(),
            'raters'=> $product->store->raters(),
        ];

        $data['images'] = [];
        foreach ($product->activeImages() as $image) {
            $data['images'][] = asset($image->image);
        }

        return $data;
    }

    /**
     * Map a resource into an array.
     *
     * @param  Collection  $products
     * @param  string      $language
     * @return array
     *
     * @author Amk El-Kabbany at 21 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function toLiteArray($products, $language)
    {
        $title = 'title_'.$language;
        $data = [];
        foreach($products as $product) {
            $data [] = [
                'id'            => $product->id,
                'title'         => $product->$title,
                'image'         => asset($product->mainImage()),
                'price'         => $product->price,
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
     * @author Amk El-Kabbany at 21 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function casts($input, $language, $id = null)
    {
        $product = [];
        if($id != null){
            $product = Product::find($id)->toArray();
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
     * @author Amk El-Kabbany at 21 May 2020
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
        foreach ($input as $key => $item) {
            if(preg_match('/^value/', $key)) {
                $replacement = "value_".$language;
                $value = str_replace("value", $replacement, $key);
                $product[$value] = $item;
                unset($input[$key]);
            }
        }
        $product[$language] = true;
        return array_replace_recursive($product, $input);
    }
}
