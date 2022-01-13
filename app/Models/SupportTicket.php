<?php
/**
 * Support Ticket model class which handel more of relational actions
 *
 * @author Amk El-Kabbany at 9 June 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class SupportTicket
 * @package App\Models
 * @version June 9, 2020, 12:18 am UTC
 *
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $type
 * @property string $message
 * @property boolean $responded
 *
 * @author Amk El-Kabbany at 9 June 2020
 * @contact alaa@upbeatdigital.team
 */
class SupportTicket extends Model
{
    use SoftDeletes;

    public $table = 'support_tickets';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'email',
        'phone',
        'type',
        'message',
        'responded'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'email' => 'string',
        'phone' => 'string',
        'type' => 'string',
        'message' => 'string',
        'responded' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|min:3',
        'email' => 'required',
        'type' => 'required',
        'message' => 'required'
    ];

    
}
