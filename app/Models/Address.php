<?php
/**
 * Address model class which handel more of relational actions
 *
 * @author Amk El-Kabbany at 9 July 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Models;

use App\User;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Address
 * @package App\Models
 * @version July 9, 2020, 4:03 pm UTC
 *
 * @property \App\User $user
 * @property \App\Models\Country $country
 * @property \App\Models\City $city
 * @property int $user_id
 * @property string $name
 * @property string $address
 * @property string $mobile
 * @property int $country_id
 * @property int $city_id
 * @property boolean $main
 *
 * @author Amk El-Kabbany at 9 July 2020
 * @contact alaa@upbeatdigital.team
 */
class Address extends Model
{
    use SoftDeletes;

    public $table = 'addresses';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'name',
        'address',
        'mobile',
        'country_id',
        'city_id',
        'main',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'address' => 'string',
        'mobile' => 'string',
        'country_id' => 'integer',
        'city_id' => 'integer',
        'main' => 'boolean',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => "required|exists:users,id,deleted_at,NULL",
        'name' => 'required',
        'address' => 'required',
        'mobile' => 'required',
        'country_id' => "required|exists:countries,id,deleted_at,NULL",
        'city_id' => "required|exists:cities,id,deleted_at,NULL",
    ];

    /**
     * Get selected address owner
     * PK id in users table
     * FK user_id in addresses table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * @author Amk El-Kabbany at 9 July 2020
     * @contact alaa@upbeatdigital.team
     **/
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get selected address country
     * PK id in countries table
     * FK country_id in addresses table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * @author Amk El-Kabbany at 9 July 2020
     * @contact alaa@upbeatdigital.team
     **/
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Get selected address city
     * PK id in cities table
     * FK city_id in addresses table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * @author Amk El-Kabbany at 9 July 2020
     * @contact alaa@upbeatdigital.team
     **/
    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
