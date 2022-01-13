<?php
/**
 * Accounts type model class which handel more of relational actions
 *
 * @author Amk El-Kabbany at 5 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Accounts type
 * @package App\Models
 * @version May 5, 2020, 11:29 am UTC
 *
 * @property string $type
 *
 * @author Amk El-Kabbany at 5 May 2020
 * @contact alaa@upbeatdigital.team
 */
class AccountsType extends Model
{
    use SoftDeletes;

    public $table = 'account_types';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'type',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'type' => 'string',
    ];


    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'type' => 'required|min:3',
    ];

    /**
     * Get associated users for selected account type
     * PK id in accounts_type table
     * FK parent in users table
     *
     * @author Amk El-Kabbany at 5 May 2020
     * @contact alaa@upbeatdigital.team
     */
    function users()
    {
        return $this->hasMany('App\User', 'account_type');
    }
}
