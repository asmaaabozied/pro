<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CartItem
 * @package App\Models
 * @version May 31, 2020, 12:50 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $products
 * @property integer $cart_id
 * @property integer $product_id
 * @property integer $quantity
 * @property float   $price
 *
 * @author Amk El-Kabbany at 31 May 2020
 * @contact alaa@upbeatdigital.team
 */
class CartItem extends Model
{
    public $table = 'cart_items';

    public $fillable = [
        'cart_id',
        'product_id',
        'quantity',
        'price'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'cart_id' => 'integer',
        'product_id' => 'integer',
        'quantity' => 'integer',
        'price' => 'float'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'cart_id'    => 'required|exists:carts,id',
        'product_id' => 'required|exists:products,id',
        'quantity'   => 'required|min:1'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $productRules = [
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|min:1'
    ];

    /**
     * Get selected cart item product
     * PK id in products table
     * FK product_id in cart_items table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * @author Amk El-Kabbany at 31 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get selected cart
     * PK id in carts table
     * FK cart_id in cart_items table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * @author Amk El-Kabbany at 6 July 2020
     * @contact alaa@upbeatdigital.team
     */
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
}
