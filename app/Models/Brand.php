<?php
/**
 * Brand model class which handel more of relational actions
 *
 * @author Amk El-Kabbany at 30 Apr 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Brand
 * @package App\Models
 * @version April 30, 2020, 3:31 pm UTC
 *
 * @property string $title_en
 * @property string $description_en
 * @property string $image
 * @property boolean $active
 * @property boolean $en
 *
 * @author Amk El-Kabbany at 30 Apr 2020
 * @contact alaa@upbeatdigital.team
 */
class Brand extends Model
{
    use SoftDeletes;

    public $table = 'brands';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'category_id',
        'title_en',
//        'description_en',
//        'image',
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
        'category_id' => 'string',
        'title_en' => 'string',

        'active' => 'boolean',
        'en' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'category_id' => 'required|exists:categories,id',
    ];


    /**
     * Get instance of this model
     *
     * @author Amk El-Kabbany at 30 Apr 2020
     * @contact alaa@upbeatdigital.team
     */
    public function __construct()
    {
        $this->fillable = array_keys(alterLangArrayElements('brands', ['fields' => array_combine($this->fillable,$this->fillable)], $key = 'fields')['fields']);
        $this->casts = alterLangArrayElements('brands', ['fields' => $this->casts], $key = 'fields')['fields'];
        self::$rules = alterLangArrayElements('brands', ['fields' => self::$rules], $key = 'fields')['fields'];
    }

    /**
     * Get parent category for selected category
     * PK id in categories table
     * FK category_id in brands table
     *
     * @author Amk El-Kabbany at 15 June 2020
     * @contact alaa@upbeatdigital.team
     */
    function category()
    {
        return $this->belongsTo(Category::class);
    }
}
