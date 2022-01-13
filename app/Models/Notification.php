<?php
/**
 * Notification model class which handel more of relational actions
 *
 * @author Amk El-Kabbany at 25 June 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Notification
 * @package App\Models
 * @version June 9, 2020, 8:13 pm UTC
 *
 * @property string $notification_en
 * @property string $type
 * @property string $filter_type
 * @property boolean $general
 * @property boolean $background
 * @property string $link
 * @property boolean $active
 */
class Notification extends Model
{
    use SoftDeletes;

    public $table = 'notifications';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'notification_en',
        'type',
        'filter_type',
        'module',
        'module_id',
        'general',
        'active'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'notification_en' => 'string',
        'type' => 'string',
        'filter_type' => 'string',
        'module' => 'string',
        'module_id' => 'integer',
        'general' => 'boolean',
        'active' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'notification_en' => 'required',
    ];

    /**
     * Get instance of this model
     *
     * @author Amk El-Kabbany at 29 June 2020
     * @contact alaa@upbeatdigital.team
     */
    public function __construct()
    {
        $this->fillable = array_keys(alterLangArrayElements('notifications', ['fields' => array_combine($this->fillable,$this->fillable)], $key = 'fields')['fields']);
        $this->casts = alterLangArrayElements('notifications', ['fields' => $this->casts], $key = 'fields')['fields'];
        self::$rules = alterLangArrayElements('notifications', ['fields' => self::$rules], $key = 'fields')['fields'];
    }

    /**
     * Get notified users for selected notification
     * PK id in notifications table
     * FK notification_id in notified_users table
     *
     * @author Amk El-Kabbany at 28 June 2020
     * @contact alaa@upbeatdigital.team
     */
    function users()
    {
        return $this->hasMany(NotifiedUser::class);
    }

    /**
     * Get notified cities for selected notification
     * PK id in notifications table
     * FK notification_id in notified_subscriptions table
     *
     * @author Amk El-Kabbany at 28 June 2020
     * @contact alaa@upbeatdigital.team
     */
    function subscriptions()
    {
        return $this->hasMany(NotifiedSubscription::class, 'notification_id');
    }

    /**
     * Get notified cities for selected notification
     * PK id in notifications table
     * FK notification_id in notified_regions table
     *
     * @author Amk El-Kabbany at 28 June 2020
     * @contact alaa@upbeatdigital.team
     */
    function cities()
    {
        return $this->hasMany(NotifiedRegion::class, 'notification_id')->where('type', 'city');
    }

    /**
     * Get notified cities for selected notification
     * PK id in notifications table
     * FK notification_id in notified_regions table
     *
     * @author Amk El-Kabbany at 28 June 2020
     * @contact alaa@upbeatdigital.team
     */
    function country()
    {
        $relation = $this->hasMany(NotifiedRegion::class, 'notification_id')->first();
        if(@$relation->type == 'city') {
            return $relation->city->country;
        } else {
            return $relation->country;
        }
    }
}
