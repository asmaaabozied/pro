<?php
/**
 * Subscription Attribute model class which handel more of relational actions
 *
 * @author Amk El-Kabbany at 12 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Subscription
 * @package App\Models
 * @version May 12, 2020, 5:34 pm UTC
 *
 * @property string $title_en
 * @property string $description_en
 * @property number $price
 * @property integer $duration
 *
 * @author Amk El-Kabbany at 12 May 2020
 * @contact alaa@upbeatdigital.team
 */
class Subscription extends Model
{
    use SoftDeletes;

    public $table = 'subscriptions';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'title_en',
        'description_en',
        'price',
        'duration',
        'max_product',
        'active',
        'en'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title_en' => 'string',
        'description_en' => 'string',
        'price' => 'double',
        'duration' => 'integer',
        'max_product' => 'integer',
        'active' => 'boolean',
        'en' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title_en' => 'required',
        'description_en' => 'required',
        'price' => 'required',
        'duration' => 'required',
        'max_product' => 'required',
    ];

    /**
     * Get instance of this model
     *
     * @author Amk El-Kabbany at 12 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function __construct()
    {
        $this->fillable = array_keys(alterLangArrayElements('subscriptions', ['fields' => array_combine($this->fillable,$this->fillable)], $key = 'fields')['fields']);
        $this->casts = alterLangArrayElements('subscriptions', ['fields' => $this->casts], $key = 'fields')['fields'];
        self::$rules = alterLangArrayElements('subscriptions', ['fields' => self::$rules], $key = 'fields')['fields'];
    }
}
