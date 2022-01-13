<?php
/**
 * Order resource class which handel data display
 *
 * @author Amk El-Kabbany at 12 July 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Resources;

use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;

class OrderResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Order|Collection  $order
     * @param  string   $language
     * @return array
     *
     * @author Amk El-Kabbany at 12 July 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function toArray($order, $language)
    {
        $data= [];
        if($order instanceof Collection) {
            foreach ($order as $item) {
                $data[] = self::map($item, $language);
            }
        } else {
            $data = self::map($order, $language);
        }
        return $data;
    }

    /**
     * Map a resource into an array.
     *
     * @param  Order    $order
     * @param  string   $language
     * @return array
     *
     * @author Amk El-Kabbany at 12 July 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function map($order, $language)
    {
        $name = 'name_'.$language;
        $title= 'title_'.$language;
        $data =  [
            'id'            => $order->id,
            'user'          => $order->user->name,
            'status'        => $order->status,
            'discount_rate'      => (!empty($order->discount))? $order->discount:'',
            'voucher_coupon_id'=> (!empty($order->voucher_coupon_id))? $order->voucher_coupon_id:'',
            'voucher_coupon_total_discount'=> (!empty($order->voucher_coupon_total_discount))? $order->voucher_coupon_total_discount:'',
            'discount_type' => (!empty($order->discount_type))? $order->discount_type:'',
            'cart_total'    => $order->cart_total,
            'total'         => $order->total + $order->shipping_cost,
            'payment_type'  => $order->payment_type,
            'shipping_cost' => (!empty($order->shipping_cost))?$order->shipping_cost:'',
            'shipping_code' => (!empty($order->shipping_code))?$order->shipping_code:'',
            'country'       => $order->address->country->$name,
            'city'          => $order->address->city->$name,
            'address'       => $order->address->address,
            'created_at'    => date('Y-m-d', strtotime($order->created_at)),
            'products'      => [],
        ];
        foreach($order->cart->items as $item){
            $price = ($item->product->discount)? floatval($item->product->price)-floatval($item->product->discount_rate) : $item->product->price;
            $totalPrice = intval($item->quantity) * floatval($price);

            $data['products'][] = [
                'id'        => $item->id,
                'product_id'=> $item->product->id,
                'title'     => $item->product->$title,
                'image'     => asset($item->product->mainImage()),
                'quantity'  => $item->quantity,
                'price'     => $price,
                'total_price'=> $totalPrice,
            ];
        }

        return $data;
    }
}
