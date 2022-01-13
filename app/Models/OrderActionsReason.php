<?php
/**
 * Order actions reason model class which handel more of relational actions
 *
 * @author Amk El-Kabbany at 14 July 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class OrderActionsReason
 * @package App\Models
 * @version July 14, 2020, 4:49 pm UTC
 *
 * @property string $type
 * @property string $title_en
 * @property boolean $active
 *
 * @author Amk El-Kabbany at 9 July 2020
 * @contact alaa@upbeatdigital.team
 */
class OrderActionsReason extends Model
{
    use SoftDeletes;

    public $table = 'order_actions_reasons';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'type',
        'title_en',
        'active'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'type' => 'string',
        'title_en' => 'string',
        'active' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'type' => 'required',
        'title_en' => 'required'
    ];

    /**
     * Get instance of this model
     *
     * @author Amk El-Kabbany at 9 July 2020
     * @contact alaa@upbeatdigital.team
     */
    public function __construct()
    {
        $this->fillable = array_keys(alterLangArrayElements('order_actions_reasons', ['fields' => array_combine($this->fillable,$this->fillable)], $key = 'fields')['fields']);
        $this->casts = alterLangArrayElements('order_actions_reasons', ['fields' => $this->casts], $key = 'fields')['fields'];
        self::$rules = alterLangArrayElements('order_actions_reasons', ['fields' => self::$rules], $key = 'fields')['fields'];
    }
}
