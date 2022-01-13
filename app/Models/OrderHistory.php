<?php
/**
 * Order history model class which handel more of relational actions
 *
 * @author Amk El-Kabbany at 1 June 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Order History
 * @package App\Models
 * @version June 1, 2020, 5:08 pm UTC
 *
 * @property \App\Models\Cart $cart
 * @property \Illuminate\Database\Eloquent\Collection $users
 * @property \Illuminate\Database\Eloquent\Collection $countries
 * @property \Illuminate\Database\Eloquent\Collection $cities
 * @property integer $order_id
 * @property string $status
 * @property integer $by
 *
 * @author Amk El-Kabbany at 1 June 2020
 * @contact alaa@upbeatdigital.team
 */
class OrderHistory extends Model
{
    use SoftDeletes;

    public $table = 'order_history';


    protected $dates = ['deleted_at'];

    
    public $fillable = [
        'order_id',
        'status',
        'by'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'order_id' => 'integer',
        'by' => 'integer',
        'status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'order_id' => 'required|exists:orders,id',
        'by' => 'required|exists:users,id',
        'status' => 'required'
    ];
    
    /**
     * Get selected order history owner
     * PK id in users table
     * FK by in order_history table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * @author Amk El-Kabbany at 1 June 2020
     * @contact alaa@upbeatdigital.team
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Get selected history order
     * PK id in orders table
     * FK order_id in order_history table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * @author Amk El-Kabbany at 1 June 2020
     * @contact alaa@upbeatdigital.team
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
