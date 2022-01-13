<?php
/**
 * Store Type model class which handel more of relational actions
 *
 * @author Amk El-Kabbany at 7 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class StoreType
 * @package App\Models
 * @version May 7, 2020, 6:07 pm UTC
 *
 * @property string $type_en
 * @property boolean $active
 * @property boolean $en
 *
 * @author Amk El-Kabbany at 7 May 2020
 * @contact alaa@upbeatdigital.team
 */
class StoreType extends Model
{
    use SoftDeletes;

    public $table = 'store_types';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'type_en',
        'active',
        'en',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'type_en' => 'string',
        'active' => 'boolean',
        'en' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'type_en' => 'required|min:3'
    ];


    /**
     * Get instance of this model
     *
     * @author Amk El-Kabbany at 7 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function __construct()
    {
        $this->fillable = array_keys(alterLangArrayElements('store_types', ['fields' => array_combine($this->fillable,$this->fillable)], $key = 'fields')['fields']);
        $this->casts = alterLangArrayElements('store_types', ['fields' => $this->casts], $key = 'fields')['fields'];
        self::$rules = alterLangArrayElements('store_types', ['fields' => self::$rules], $key = 'fields')['fields'];
    }

    /**
     * Get stores for selected store type
     * PK id in stores table
     * FK store_type in store_types table
     *
     * @author Amk El-Kabbany at 7 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function stores()
    {
        return $this->hasMany(Store::class, 'store_type');
    }
    
    public function scopeLimited($query)
    {
        // dd(Auth::user()->id);
        // dump($this->items);
        if(auth()->user()->account_type != 1){
            return $query->where('id' ,null);
        }
        return $query;
    }
}
