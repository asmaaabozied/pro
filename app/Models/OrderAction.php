<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class OrderAction
 * @package App\Models
 * @version July 14, 2020, 8:51 pm UTC
 *
 * @property \App\Models\Order $order
 * @property \App\Models\OrderActionsReason
 * @property integer $order_id
 * @property integer $reason_id
 * @property string $detail
 * @property string $status
 */
class OrderAction extends Model
{
    use SoftDeletes;

    public $table = 'order_actions';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'order_id',
        'reason_id',
        'detail',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'order_id' => 'integer',
        'reason_id' => 'integer',
        'detail' => 'string',
        'status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'order_id' => 'required|exists:orders,id',
        'reason_id' => 'required|exists:order_actions_reasons,id',
        'detail' => 'required',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $productRules = [
        'order_id' => 'required|exists:products,id',
        'reason_id' => 'required|exists:order_actions_reasons,id',
        'detail' => 'required',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function reason()
    {
        return $this->belongsTo(OrderActionsReason::class, 'reason_id');
    }
}
