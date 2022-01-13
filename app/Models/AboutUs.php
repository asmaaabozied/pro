<?php
/**
 * About Us model class which handel more of relational actions
 *
 * @author Amk El-Kabbany at 3 June 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class AboutUs
 * @package App\Models
 * @version June 3, 2020, 6:46 pm UTC
 *
 * @property string $slug
 * @property string $title_en
 * @property string $description_en
 * @property boolean $active
 *
 * @author Amk El-Kabbany at 3 June 2020
 * @contact alaa@upbeatdigital.team
 */
class AboutUs extends Model
{
    use SoftDeletes;

    public $table = 'aboutuses';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'slug',
        'description_en',
        'active',
        'image'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
//        'title_en' => 'string',
        'description_en' => 'string',
        'active' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
//        'title_en' => 'required|min:3',
        'description_en' => 'required'
    ];


    /**
     * Get instance of this model
     *
     * @author Amk El-Kabbany at 30 Apr 2020
     * @contact alaa@upbeatdigital.team
     */
    public function __construct()
    {
        $this->fillable = array_keys(alterLangArrayElements('aboutuses', ['fields' => array_combine($this->fillable,$this->fillable)], $key = 'fields')['fields']);
        $this->casts = alterLangArrayElements('aboutuses', ['fields' => $this->casts], $key = 'fields')['fields'];
        self::$rules = alterLangArrayElements('aboutuses', ['fields' => self::$rules], $key = 'fields')['fields'];
    }
}
