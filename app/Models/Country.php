<?php
/**
 * Country model class which handel more of relational actions
 *
 * @author Amk El-Kabbany at 4 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Models;

use App\User;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Country
 * @package App\Models
 * @version May 4, 2020, 9:12 am UTC
 *
 * @property string $name_en
 * @property string $key
 * @property string $code
 * @property float $shipping_cost
 * @property boolean $active
 * @property boolean $en
 *
 * @author Amk El-Kabbany at 4 May 2020
 * @contact alaa@upbeatdigital.team
 */
class Country extends Model
{
    use SoftDeletes;

    public $table = 'countries';
    

    protected $dates = ['deleted_at'];

    protected $softDelete = true;
    
    public $fillable = [
        'name_en',
        'key',
        'code',
        'shipping_cost',
        'delivery_for_5k',
        'additional_k',
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
        'name_en' => 'string',
        'key' => 'string',
        'code' => 'string',
        'shipping_cost' => 'float',
        'active' => 'boolean',
        'en' => 'boolean',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name_en' => 'required|min:3',
        'key' => 'required',
        'code' => 'required',
        'shipping_cost' => 'required',
        'additional_k' => 'required|numeric',
        'delivery_for_5k' => 'required|numeric'
    ];

    /**
     * Get instance of this model
     *
     * @author Amk El-Kabbany at 4 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function __construct()
    {
        $this->fillable = array_keys(alterLangArrayElements('countries', ['fields' => array_combine($this->fillable,$this->fillable)], $key = 'fields')['fields']);
        $this->casts = alterLangArrayElements('countries', ['fields' => $this->casts], $key = 'fields')['fields'];
        self::$rules = alterLangArrayElements('countries', ['fields' => self::$rules], $key = 'fields')['fields'];
    }


    /**
     * Get cities for selected country
     * PK id in countries table
     * FK country_id in cities table
     *
     * @author Amk El-Kabbany at 4 May 2020
     * @contact alaa@upbeatdigital.team
     */
    function cities()
    {
        return $this->hasMany('App\Models\City', 'country_id', 'id')->where('deleted_at', null);
    }


    /**
     * Get users for selected country
     *
     * @param integer $id
     * @return Collection
     *
     * @author Amk El-Kabbany at 28 June 2020
     * @contact alaa@upbeatdigital.team
     */
    static function users($id)
    {
        return User::where('deleted_at', null)->where('country_id', $id)->get();
    }
}
