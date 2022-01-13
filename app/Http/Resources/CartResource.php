<?php
/**
 * Cart resource class which handel data display
 *
 * @author Amk El-Kabbany at 6 July 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Resources;

use App\Models\Cart;
use Illuminate\Database\Eloquent\Collection;
use DateTime;
class CartResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Cart|Collection  $cart
     * @param  string   $language
     * @return array
     *
     * @author Amk El-Kabbany at 6 July 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function toArray($cart, $language)
    {
        $data= [];
        if($cart instanceof Collection) {
            foreach ($cart as $item) {
                $data[] = self::map($item, $language);
            }
        } else {
            $data = self::map($cart, $language);
        }
        return $data;
    }

    /**
     * Map a resource into an array.
     *
     * @param  Cart    $cart
     * @param  string   $language
     * @return array
     *
     * @author Amk El-Kabbany at 6 July 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function map($cart, $language)
    {
        $title = 'title_'.$language;
        $shipping_cost = @$cart->user->mainAddress()->country->shipping_cost;
        $data =  [
            'id'            => $cart->id,
            'user'          => $cart->user->name,
            'status'        => $cart->status,
            'products'      => [],
            'total'         => 0,
            'shipping_cost' => ($shipping_cost != null)? $shipping_cost : $cart->user->country->shipping_cost,
        ];
        foreach($cart->items as $item){
            // $price = ($item->product->discount)? floatval($item->product->price)-floatval($item->product->discount_rate) : $item->product->price;

            $discount_rate=floatval($item->product->discount_rate);
            $prod_price=floatval($item->product->price);

            $today = new DateTime(date("Y-m-d"));
            $begin_disc_date = new DateTime($item->product->discount_start_date);
            $end_disc_date = new DateTime($item->product->discount_end_date);
            $price = ($item->product->discount &&  $begin_disc_date <=$today &&  $end_disc_date >=$today )? $prod_price-($prod_price *$discount_rate/100) : $item->product->price;
            
            $totalPrice = intval($item->quantity) * floatval($price);



            $data['products'][] = [
                'id'        => $item->id,
                'product_id'=> $item->product->id,
                'title'     => $item->product->$title,
                'image'     => asset($item->product->mainImage()),
                'quantity'  => $item->quantity,
                'discount'  => $item->product->discount,
                'weight'    => $item->product->finalWeight(),
                'price'     => $price,
                'total_price'=> $totalPrice,
            ];
            $data['total'] += $totalPrice;
        }

        return $data;
    }
}
