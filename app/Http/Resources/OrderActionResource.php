<?php
/**
 * OrderAction resource class which handel data display
 *
 * @author Amk El-Kabbany at 15 July 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Resources;

use App\Models\OrderAction;
use Illuminate\Database\Eloquent\Collection;

class OrderActionResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  OrderAction|Collection    $orderActionAction
     * @param  string   $language
     * @return array
     *
     * @author Amk El-Kabbany at 11 July 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function toArray($orderActionAction, $language)
    {
        $data= [];
        if($orderActionAction instanceof Collection) {
            foreach ($orderActionAction as $item) {
                $data[$item->id] = self::map($item, $language);
            }
        } else {
            $data = self::map($orderActionAction, $language);
        }
        return $data;
    }

    /**
     * Map a resource into an array.
     *
     * @param  OrderAction   $orderAction
     * @param  string   $language
     * @return array
     *
     * @author Amk El-Kabbany at 12 July 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function map($orderAction, $language)
    {
        $name = 'name_'.$language;
        $title= 'title_'.$language;
        $data =  [
            'id'            => $orderAction->id,
            'reason'        => $orderAction->reason->$title,
            'created_at'    => date('Y-m-d', strtotime($orderAction->created_at)),
            'order'         => [],
            'products'      => [],
        ];
        $data['order'][] = [
            'user'          => $orderAction->order->user->name,
            'status'        => $orderAction->order->status,
            'discount'      => $orderAction->order->discount,
            'cart_total'    => $orderAction->order->cart_total,
            'total'         => $orderAction->order->total,
            'payment_type'  => $orderAction->order->payment_type,
            'shipping_cost' => $orderAction->order->shipping_cost,
            'country'       => $orderAction->order->address->country->$name,
            'city'          => $orderAction->order->address->city->$name,
            'address'       => $orderAction->order->address->address,
            'created_at'    => date('Y-m-d', strtotime($orderAction->order->created_at)),
         ];
        foreach($orderAction->order->cart->items as $item){
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
