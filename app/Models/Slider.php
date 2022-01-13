<?php
/**
 * Slider model class which handel more of relational actions
 *
 * @author Amk El-Kabbany at 10 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Slider
 * @package App\Models
 * @version May 10, 2020, 12:12 pm UTC
 *
 * @property \App\Models\Store $store
 * @property integer $store_id
 * @property string $title_en
 * @property string $description_en
 * @property string $link
 * @property string $image
 * @property boolean $active
 * @property boolean $en
 *
 * @author Amk El-Kabbany at 10 May 2020
 * @contact alaa@upbeatdigital.team
 */
class Slider extends Model
{
    use SoftDeletes;

    public $table = 'sliders';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'title_en',
        'description_en',
       'link',
       'product_id',
        'image',
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
        'image' => 'string'
   /*     'title_en' => 'string',
        'description_en' => 'string',
        'image' => 'string',
        'link' => 'string',
        'active' => 'boolean',
        'en' => 'boolean'*/
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
      /*  'title_en' => 'required|min:3',
        'description_en' => 'required',
        'link' => 'required'*/
    ];

    /**
     * Get instance of this model
     *
     * @author Amk El-Kabbany at 10 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function __construct()
    {
        $this->fillable = array_keys(alterLangArrayElements('sliders', ['fields' => array_combine($this->fillable,$this->fillable)], $key = 'fields')['fields']);
        $this->casts = alterLangArrayElements('sliders', ['fields' => $this->casts], $key = 'fields')['fields'];
        self::$rules = alterLangArrayElements('sliders', ['fields' => self::$rules], $key = 'fields')['fields'];
    }
}
