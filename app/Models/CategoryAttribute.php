<?php
/**
 * Category Attribute model class which handel more of relational actions
 *
 * @author Amk El-Kabbany at 12 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CategoryAttribute
 * @package App\Models
 * @version May 12, 2020, 11:01 am UTC
 *
 * @property integer $category_id
 * @property string $name_en
 * @property string $description_en
 * @property string $unit_en
 * @property boolean $active
 *
 * @author Amk El-Kabbany at 12 May 2020
 * @contact alaa@upbeatdigital.team
 */
class CategoryAttribute extends Model
{
    use SoftDeletes;

    public $table = 'category_attributes';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'category_id',
        'name_en',
        'description_en',
        'unit_en',
        'active',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'category_id' => 'integer',
        'name_en' => 'string',
        'unit_en' => 'string',
        'description_en' => 'text',
        'active' => 'boolean'
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
     * @author Amk El-Kabbany at 12 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function __construct()
    {
        $this->fillable = array_keys(alterLangArrayElements('category_attributes', ['fields' => array_combine($this->fillable,$this->fillable)], $key = 'fields')['fields']);
        $this->casts = alterLangArrayElements('category_attributes', ['fields' => $this->casts], $key = 'fields')['fields'];
        self::$rules = alterLangArrayElements('category_attributes', ['fields' => self::$rules], $key = 'fields')['fields'];
    }

    /**
     * Get parent category for selected category
     * PK id in categories table
     * FK category_id in category_attributes table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * @author Amk El-Kabbany at 12 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function values(){
        return $this->hasMany('App\Models\ProductAttribute');
    }
}
