<?php

namespace App\Repositories;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\Product;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;
use DateTime;
/**
 * Class CartRepository
 * @package App\Repositories
 * @version June 1, 2020, 12:50 am UTC
 */

class CartRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
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
        return Cart::class;
    }

    /**
     * Pluck model entries according to provided attribute
     *
     * @param boolean $checked_out
     * @return array
     *
     * @author Amk El-Kabbany at 1 June 2020
     * @contact alaa@upbeatdigital.team
     **/
    public function pluck($checked_out = false)
    {
        $operator = ($checked_out)? '=' : '!=';
        $carts =  Cart::where('deleted_at', null)->where('checked_out', $operator, null)
            ->select('user_id', 'id', 'created_at')->get();
        $pluck = [];
        foreach ($carts as $cart){
            $pluck[$cart->id] = $cart->user->name.' - #'.$cart->id.' - '.date('Y-m-d', strtotime($cart->created_at));
        }
        return $pluck;
    }

    /**
     * Pluck model entries according to provided attribute
     *
     * @param integer $user_id
     * @param boolean $checked_out
     * @return Cart
     *
     * @author Amk El-Kabbany at 1 June 2020
     * @contact alaa@upbeatdigital.team
     **/
    public function lists($user_id, $checked_out = false)
    {
        $operator = ($checked_out)? '!=' : '=';
        $cart = Cart::where('deleted_at', null)->where('checked_out', $operator, null)
                    ->where('user_id', $user_id)->first();
        if($cart == null){
            $cart = new Cart();
            $cart->fill([
                'user_id'   => $user_id,
                'status'    => 'open',
            ])->save();
        }

        return $cart;
    }

    /**
     * Create model record
     *
     * @param array $input
     *
     * @return Cart
     *
     * @author Amk El-Kabbany at 31 Apr 2020
     * @contact alaa@upbeatdigital.team
     */
    public function create($input)
    {
        unset($input['discount_type']);
        unset($input['coupon']);
        unset($input['offer']);

        $cart = new Cart();

        $cart->fill($input)->save();

        return $cart;
    }

    /**
     * Update model record for given id
     *
     * @param array $input
     * @param int $id
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model
     *
     * @author Amk El-Kabbany at 31 Apr 2020
     * @contact alaa@upbeatdigital.team
     */
    public function update($input, $id)
    {
        $cart = new Cart();
        $cart = $cart->find($id);
        $cart->fill($input)->save();
        return $cart;
    }

    /**
     * @param int $id
     *
     * @throws \Exception
     *
     * @return bool|mixed|null
     *
     * @author Amk El-Kabbany at 31 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function delete($id)
    {
        $query = $this->model->newQuery();
        $cart = $query->find($id);

        if (! Auth::user()->hasRole('super-admin')) {
            Flash::error(trans('cart.messages.errors.not_super_admin'));
            return false;
        }

        return $cart->delete();
    }

    /**
     * Prepare cart item record and add it to active cart
     *
     * @param integer $user_id
     * @param array $data
     * @return Cart|boolean
     *
     * @author Amk El-Kabbany at 6 July 2020
     * @contact alaa@upbeatdigital.team
     */
    public function addCartItem($user_id, $data)
    {
        $activeCart = $this->lists($user_id);
        $product = Product::find($data['product_id']);
        if($product->quantity < $data['quantity']){
            return 'quantity';
        }
        $quantity=intval($data['quantity']);
        $discount_rate=floatval($product->discount_rate);
        $prod_price=floatval($product->price);

        $today = new DateTime(date("Y-m-d"));
        $begin_disc_date = new DateTime($product->discount_start_date);
        $end_disc_date = new DateTime($product->discount_end_date);
        $price = ($product->discount &&  $begin_disc_date <=$today &&  $end_disc_date >=$today )? $prod_price-($prod_price *$discount_rate/100) : $product->price;
        
        $cartItem = [
            'cart_id'   => $activeCart->id,
            'product_id'=> $product->id,
            'quantity'  => $quantity,
            'price'     => $price,
        ];

        return ($this->addItem($cartItem))->cart;
    }

    /**
     * Create cart item record
     *
     * @param array $data
     *
     * @return CartItem
     *
     * @author Amk El-Kabbany at 31 Apr 2020
     * @contact alaa@upbeatdigital.team
     */
    public function addItem($data)
    {
        $cartItem = CartItem::where('cart_id', $data['cart_id'])->where('product_id', $data['product_id'])->first();
        if($cartItem == null){
            $cartItem = new CartItem();
        } else {
            $data['quantity'] = intval($data['quantity']) + intval($cartItem->quantity);
            $data['price']    = floatval($cartItem->price);
        }
        $cartItem->fill($data)->save();

        return $cartItem;
    }

    /**
     * Update cart item product quantity
     *
     * @param array $data
     *
     * @return Cart|boolean
     *
     * @author Amk El-Kabbany at 7 July 2020
     * @contact alaa@upbeatdigital.team
     */
    public function updateCartItemQuantity($data)
    {
        $activeCart = $this->lists($data['user_id']);
        $cartItem = CartItem::where('cart_id', $activeCart->id)->where('product_id', $data['product_id'])->first();
        if($cartItem == null) {
            return false;
        }
        if(Product::find($data['product_id'])->quantity < $data['quantity']) {
            return 'quantity';
        }
        if($data['quantity'] == 0){
            return $this->removeCartItem($cartItem->id);
        }
        $cartItem->fill(['quantity' => $data['quantity']])->save();

        return $activeCart;
    }

    /**
     * Update cart item record for given id
     *
     * @param array $data
     * @param int $id
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model
     *
     * @author Amk El-Kabbany at 31 Apr 2020
     * @contact alaa@upbeatdigital.team
     */
    public function updateItem($data, $id)
    {
        $cartItem = new CartItem();
        $cartItem = $cartItem->find($id);
        $cartItem->fill($data)->save();
        return $cartItem;
    }

    /**
     * @param int $id
     *
     * @throws \Exception
     *
     * @return bool|mixed|null
     *
     * @author Amk El-Kabbany at 31 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function removeCartItem($id)
    {
        $cartItem = CartItem::find($id);
        if($cartItem != null){
            return $cartItem->delete();
        }
        return false;
    }
}