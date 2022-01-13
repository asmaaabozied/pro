<?php

namespace App\Repositories;

use App\Models\Address;
use App\Models\Order;
use App\User;
use App\Models\Coupon;
use App\Models\Voucher;
use App\Models\Cart;

use App\Models\Product;
use App\Models\Notification;
use App\Models\NotifiedUser;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use App\Helpers\Notification as NotificationHelper;
use App\Helpers\Tracking;

use App\Http\Resources\CouponResource;
use App\Http\Resources\VoucherResource;
/**
 * Class OrderRepository
 * @package App\Repositories
 * @version July 12, 2020, 11:16 am UTC
*/

class OrderRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'cart_id',
        'user_id',
        'discount_type',
        'discount',
        'address_id',
        'shipping_cost',
        'payment_type',
        'cart_total',
        'total',
        'status'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Order::class;
    }

    /**
     * Display the specified logged user orders.
     *
     * @param array $data
     * @return Collection
     *
     * @author Amk El-Kabbany at 12 July 2020
     * @contact alaa@upbeatdigital.team
     **/
    public function lists($data)
    {
        $query = $this->model->newQuery();
        if(!empty($data['user_id'])){
            $query = $query->where('user_id', $data['user_id']);
        }
        if(!empty($data['status'])) {
            $query = $query->where('status', $data['status']);
        }
        if(!empty($data['year'])) {
            $query = $query->whereYear('created_at', $data['year']);
        }
        if(!empty($data['month'])) {
            $query = $query->whereMonth('created_at', $data['month']);
        }
        return $query->get();
    }
    
    /**
     * Create model record
     *
     * @param array $input
     *
     * @return Order
     *
     * @author Amk El-Kabbany at 12 July 2020
     * @contact alaa@upbeatdigital.team
     */
    public function create($input)
    {
        
        $order = [
            'user_id'       => $input['user_id'],
            'address_id'    => $input['address_id'],
            'discount_type' => null,
            'discount'      => 0,
            'status'        => 'preparing',
        ];
        $activeCart = (key_exists('active_cart', $input))? $input['active_cart'] : (new CartRepository(app()))->lists($input['user_id']);
        $order['cart_id'] = $activeCart->id;
        $order['cart_total'] = floatval($activeCart->total());
        $address = Address::find(intval($input['address_id']));
        $order['shipping_cost'] = 0;

        $voucherCouponDiscount=0;
        if(isset($input['code']) && (!empty($input['code']))){
            $Voucher_Coupon_discount=$this->calcVoucher_Coupon_discount($input['code'], $input['user_id']);
            if($Voucher_Coupon_discount != false){
                $order['discount_type'] = $Voucher_Coupon_discount['type'];
                $order['discount']      =  $Voucher_Coupon_discount['rate'];
                $order['voucher_coupon_total_discount']      =  $Voucher_Coupon_discount['total_discount'];
                $order['voucher_coupon_id'] =  $Voucher_Coupon_discount['id'];
                
                $voucherCouponDiscount= $Voucher_Coupon_discount['total_discount'];
            }
            
        }
        $cartTotal=floatval($order['cart_total']);
        $order['total'] =$cartTotal - $voucherCouponDiscount;
        $lang= (!empty(Config::get('languages')))? Config::get('languages')[Request::ip()]['admin']: 'en' ;
        $name = 'name_'.$lang;
        $order['country'] = $address->country->$name;
        $order['city'] = $address->city->$name;
        $order['address'] = $address->address;

        $orderObject = new Order();
        $orderObject->fill($order)->save();
        $activeCart->fill([
            'status'        => 'checked out',
            'checked_out'   => date('Y-m-d'),
        ])->save();
        // if((floatval($input['coupon']) == true)) {
        //     (new OrderCoupon())->fill([
        //         'order_id'  => $orderObject->id,
        //         'coupon_id' => $coupon->id,
        //     ])->save();
        //     $coupon->fill([
        //         'usage' => intval($coupon->usage)+1
        //     ])->save();
        // }
        foreach($activeCart->items as $cartItem){
            $product = Product::find($cartItem->product_id);
            $quantityUpdate = [
                'quantity' => (intval($product->quantity) - intval($cartItem->quantity))
            ];

            $order['shipping_cost'] += $address->country->delivery_for_5k;
            if($product->finalWeight() > 5){
                $order['shipping_cost'] += $address->country->additional_k * ($product->finalWeight() - 5); 
            }

            $quantityUpdate['active'] = ($quantityUpdate['quantity'] == 0)? false : $product->active;
            $product->fill($quantityUpdate)->save();
        }

        $orderObject->shipping_cost = $order['shipping_cost'];
        $orderObject->save();

        return $orderObject;
    }

    public function update($input, $id){
        $order = $this->model->find($id);

        if($input['status'] == 'prepared'){
            $response = Tracking::add_to_track($order);
            if($response->success == 1){
                $input['shipping_code'] = $response->AwbNumber;
            }
        }

        $order->fill($input)->save();

        if($order->user->firebase_token != null){
            // $notification_input = [];
            $title = "Order No." . $id;
            $message = "";
    
            if($input['status'] == 'preparing'){
                $message = "We are prepering your order.";
            }
            if($input['status'] == 'prepared'){
                $message = "We prepered your order.";
            }
            if($input['status'] == 'on way'){
                $message = "your order on its way.";
            }
            if($input['status'] == 'delivered'){
                $message = "your order delivered successfully.";
            }
            if($input['status'] == 'rejected'){
                $message = "Sorry, your order has been rejected.";
            }
            if($input['status'] == 'cancelled'){
                $message = "your order has been cancelled.";
            }
            if($input['status'] == 'returned'){
                $message = "your order has been returned.";
            }

            NotificationHelper::firebase_notification($order->user->firebase_token, $title, $message, ['module' => 'orders', 'module_id' => $id]);
            
            $notification = new Notification();
            $data = [
                'type'              => 'system',
                'module'            => 'orders',
                'module_id'         => $id,
                'active'            => true,
                'notification_en'   => $message,
                'notification_ar'   => $message,
            ];

            $notification->fill($data)->save();

            $notifiedUser = new NotifiedUser();
            $notifiedUser->fill([
                'notification_id'   => $notification->id,
                'user_id'           => intval($order->user->id),
            ])->save();
        
        }

        return $order;
    }

    function calcVoucher_Coupon_discount($code, $user_id){
        $resultData;
        $result=false;
        $user =auth()->user();
        $voucher = Voucher::where('deleted_at', null)->where('type', 'Orders')
                        ->whereDate('start_date', '<=', date('Y-m-d'))
                        ->whereDate('end_date', '>=', date('Y-m-d'))
                        ->where('code', $code)
                        ->whereColumn('count', '>', 'usage')
                        ->first();
                        
        if(!empty($voucher)){
            $status = User::find($user_id)->validateVoucher($voucher->id);
            $result= ($status == "false")? false : $voucher;
        }
        if($result != false){
            $resultData=VoucherResource::toArray($voucher, 'en');
            $resultData['type']='voucher';
        }else{
            $coupon = Coupon::where('deleted_at', null)
                        ->whereDate('start_at', '<=', date('Y-m-d'))
                        ->whereDate('valid_to', '>=', date('Y-m-d'))
                        ->where('code', $code)
                        ->whereColumn('count', '>', 'usage')
                        ->first();
                        // dd( $coupon->id);
            if(!empty($coupon)){
                $status = User::find($user_id)->validateCoupon($coupon->id);
                $result= ($status == "false")? false : $coupon;
            }
            if($result != false){
                $resultData=CouponResource::toArray($coupon ,'en');
                $resultData['type']='coupon';
            }else{
                return false;
            }
        }

       //calculate coupon/voucher discount//Get Products In cart And in this store
        $store_id=$resultData['store_id'];
        $rate=$resultData['rate'];
        $cart  = Cart::where('deleted_at', null)->whereNull('checked_out')->where('user_id', $user_id)
        ->select('id')->with(['items'])->first();
        if( empty($cart) || count($cart->items)==0){
            return false;
        }
        $product_ids_Arr=$cart->items->pluck('product_id');
        $product=Product::select('id')->where('store_id' , $store_id)->whereIn('id',$product_ids_Arr)->get();
        if(empty($product)){return false;}
        $productWithVoucherCouponsArr=$product->pluck('id')->toArray();
        $totalDiscount=0;
        $finalRes=[];
        foreach ($cart->items as  $value) {
            $product_id=$value->product_id;
            if(in_array($product_id ,$productWithVoucherCouponsArr)){
                $quantity = floatval($value->quantity);
                $price = floatval($value->price);
                $prodTotal=$quantity * $price;
                $discount=$prodTotal-($prodTotal*$rate/100);
                $totalDiscount=$totalDiscount+$discount;
                $finalRes[]=['product_id' =>$product_id ,'discount'=>$discount];
            }
        }

        $resultData['total_discount']=$totalDiscount;
        return $resultData;
    }
}
