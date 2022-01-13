<?php
/**
 * Notified User model class which handel more of relational actions
 *
 * @author Amk El-Kabbany at 28 June 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Models;
use App\User;
use App\Models\Notification;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class NotifiedUser
 * @package App\Models
 * @version June 28, 2020, 8:13 pm UTC
 *
 * @property integer $notification_id
 * @property integer $user_id
 * @property boolean $seen
 */
class NotifiedUser extends Model
{
    use SoftDeletes;

    public $table = 'notified_users';


    protected $dates = ['deleted_at'];
    // protected $appends = ['notification'];


    public $fillable = [
        'notification_id',
        'user_id',
        'seen',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'notification_id' => 'integer',
        'user_id' => 'integer',
        'seen' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'notification_id' => 'required|exists:notifications,id',
        'user_id' => 'required|exists:users,id',
    ];

    /**
     * Get notified user for selected notification
     * PK id in users table
     * FK user_id in notified_users table
     *
     * @author Amk El-Kabbany at 28 June 2020
     * @contact alaa@upbeatdigital.team
     */
    function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getNotificationAttribute(){
        return $this->hasOne(Notification::class, 'notification_id');
    }


}
