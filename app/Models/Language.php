<?php
/**
 * Language model class which handel more of relational actions
 *
 * @author Amk El-Kabbany at 28 Apr 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Language
 * @package App\Models
 * @version April 28, 2020, 9:49 am UTC
 *
 * @property string $prefix
 *
 * @author Amk El-Kabbany at 28 Apr 2020
 * @contact alaa@upbeatdigital.team
 */
class Language extends Model
{
    use SoftDeletes;

    public $table = 'languages';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'prefix'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'prefix' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'prefix' => 'required'
    ];

    
}
