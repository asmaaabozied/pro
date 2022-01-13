<?php
/**
 * Notified Subscription model class which handel more of relational actions
 *
 * @author Amk El-Kabbany at 28 June 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class NotifiedSubscription
 * @package App\Models
 * @version June 28, 2020, 8:13 pm UTC
 *
 * @property integer $notification_id
 * @property integer $subscription_id
 */
class NotifiedSubscription extends Model
{
    use SoftDeletes;

    public $table = 'notified_subscriptions';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'notification_id',
        'subscription_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'notification_id' => 'integer',
        'subscription_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'notification_id' => 'required|exists:notifications,id',
        'subscription_id' => 'required|exists:subscriptions,id',
    ];

    /**
     * Get notified subscription for selected notification
     * PK id in notified_regions table
     * FK subscription_id in subscriptions table
     *
     * @author Amk El-Kabbany at 29 June 2020
     * @contact alaa@upbeatdigital.team
     */
    function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }
}
