<?php
/**
 * Product Attribute model class which handel more of relational actions
 *
 * @author Amk El-Kabbany at 19 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ProductAttribute
 * @package App\Models
 * @version May 19, 2020, 2:06 pm UTC
 * @property integer $product_id
 * @property integer $category_attribute_id
 * @property string $title_en
 * @property string $description_en
 * @property string $value
 * @property boolean $active
 */
class ProductAttribute extends Model
{
    use SoftDeletes;

    public $table = 'products_attributes';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'product_id',
        'category_attribute_id',
        'title_en',
        'description_en',
        'value_en',
        'active',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'product_id' => 'integer',
        'category_attribute_id' => 'integer',
        'title_en' => 'string',
        'description_en' => 'string',
        'value_en' => 'string',
        'active' => 'boolean',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'product_id' => 'required|exists:products,id',
        'category_attribute_id' => 'required|exists:category_attributes,id',
        'title_en' => 'required|min:3',
        'description_en' => 'required',
        'value_en' => 'required'
    ];

    /**
     * Get instance of this model
     *
     * @author Amk El-Kabbany at 20 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function __construct()
    {
        $this->fillable = array_keys(alterLangArrayElements('products_attributes', ['fields' => array_combine($this->fillable,$this->fillable)], $key = 'fields')['fields']);
        $this->casts = alterLangArrayElements('products_attributes', ['fields' => $this->casts], $key = 'fields')['fields'];
        self::$rules = alterLangArrayElements('products_attributes', ['fields' => self::$rules], $key = 'fields')['fields'];
    }

    /**
     * Get category attributes for selected category
     * PK id in category_attributes table
     * FK parent in products_attributes table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * @author Amk El-Kabbany at 19 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function attributes()
    {
        return $this->belongsTo(CategoryAttribute::class);
    }

    /**
     * Get category attributes for selected category
     * PK id in products table
     * FK parent in products_attributes table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * @author Amk El-Kabbany at 19 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
