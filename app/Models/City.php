<?php

namespace App\Models;

use App\User;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class City
 * @package App\Models
 * @version May 4, 2020, 2:58 pm UTC
 *
 * @property \App\Models\Country $country
 * @property integer $country_id
 * @property string $name_en
 * @property string $postal_code
 * @property boolean $active
 * @property boolean $en
 */
class City extends Model
{
    use SoftDeletes;

    public $table = 'cities';
    

    protected $dates = ['deleted_at'];
    

    public $fillable = [
        'country_id',
        'name_en',
        'postal_code',
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
        'country_id' => 'integer',
        'name_en' => 'string',
        'postal_code' => 'string',
        'active' => 'boolean',
        'en' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'country_id' => 'required|exists:countries,id',
        'name_en' => 'required',
    ];
    
    /**
     * Get instance of this model
     *
     * @author Amk El-Kabbany at 4 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function __construct()
    {
        $this->fillable = array_keys(alterLangArrayElements('cities', ['fields' => array_combine($this->fillable,$this->fillable)], $key = 'fields')['fields']);
        $this->casts = alterLangArrayElements('cities', ['fields' => $this->casts], $key = 'fields')['fields'];
        self::$rules = alterLangArrayElements('cities', ['fields' => self::$rules], $key = 'fields')['fields'];
    }
    
    /**
     * Get country for selected city
     * PK id in countries table
     * FK country_id in cities table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * @author Amk El-Kabbany at 4 May 2020
     * @contact alaa@upbeatdigital.team
     **/
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
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
        return User::where('deleted_at', null)->where('city_id', $id)->get();
    }


    public function coupons()
    {
        return $this->hasMany(Capon::class, 'city_id', 'id');
    }
}
