<?php
/**
 * Notified User model class which handel more of relational actions
 *
 * @author Amk El-Kabbany at 28 June 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class NotifiedUser
 * @package App\Models
 * @version June 28, 2020, 8:13 pm UTC
 *
 * @property integer $notification_id
 * @property integer $region_id
 * @property string  $type
 */
class NotifiedRegion extends Model
{
    use SoftDeletes;

    public $table = 'notified_regions';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'notification_id',
        'region_id',
        'type',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'notification_id' => 'integer',
        'region_id' => 'integer',
        'type' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'notification_id' => 'required|exists:notifications,id',
        'region_id' => 'required',
        'type' => 'required',
    ];

    /**
     * Get notified city for selected notification
     * PK id in cities table
     * FK region_id in notified_regions table
     *
     * @author Amk El-Kabbany at 28 June 2020
     * @contact alaa@upbeatdigital.team
     */
    function city()
    {
        return $this->belongsTo(City::class, 'region_id');
    }

    /**
     * Get notified country for selected notification
     * PK id in countries table
     * FK region_id in notified_regions table
     *
     * @author Amk El-Kabbany at 28 June 2020
     * @contact alaa@upbeatdigital.team
     */
    function country()
    {
        return $this->belongsTo(Country::class, 'region_id');
    }
}