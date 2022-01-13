<?php
/**
 * Category model class which handel more of relational actions
 *
 * @author Amk El-Kabbany at 28 Apr 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Category
 * @package App\Models
 * @version April 28, 2020, 9:35 am UTC
 *
 * @property string $title_en
 * @property string $description
 * @property string $image
 * @property integer $parent
 *
 * @author Amk El-Kabbany at 28 Apr 2020
 * @contact alaa@upbeatdigital.team
 */
class Category extends Model
{
    use SoftDeletes;

    public $table = 'categories';


    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id';

    public $fillable = [
        'id',
        'title_en',
        'image',
        'icon',
        'parent',
        'active',
        'menu',
        'order',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title_en' => 'string',
        'image' => 'string',
        'icon' => 'string',
        'parent' => 'integer',
        'order' => 'integer',
        'active' => 'boolean',
        'menu' => 'boolean',
    ];


    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'parent' => 'sometimes|exists:categories,id',
    ];

    /**
     * Get instance of this model
     *
     * @author Amk El-Kabbany at 28 Apr 2020
     * @contact alaa@upbeatdigital.team
     */
    public function __construct()
    {
        $this->fillable = array_keys(alterLangArrayElements('categories', ['fields' => array_combine($this->fillable,$this->fillable)], $key = 'fields')['fields']);
        $this->casts = alterLangArrayElements('categories', ['fields' => $this->casts], $key = 'fields')['fields'];
        self::$rules = alterLangArrayElements('categories', ['fields' => self::$rules], $key = 'fields')['fields'];
    }

    /**
     * Get parent category for selected category
     * PK id in categories table
     * FK parent in categories table
     *
     * @author Amk El-Kabbany at 28 Apr 2020
     * @contact alaa@upbeatdigital.team
     */
    function category()
    {
        return $this->belongsTo('App\Models\Category', 'parent', 'id');
    }



    public function coupons()
    {
        return $this->hasMany(Capon::class, 'category_id', 'id');
    }

    /**
     * Get sub-categories for selected category
     * PK id in categories table
     * FK parent in categories table
     *
     * @author Amk El-Kabbany at 28 Apr 2020
     * @contact alaa@upbeatdigital.team
     */
    function subCategories()
    {
        return $this->hasMany('App\Models\Category', 'parent');
    }

    /**
     * Get category attributes for selected category
     * PK id in categories table
     * FK parent in category_attributes table
     *
     * @author Amk El-Kabbany at 19 May 2020
     * @contact alaa@upbeatdigital.team
     */
    function attributes()
    {
        return $this->hasMany(CategoryAttribute::class)->where('deleted_at', null);
    }

    /**
     * Get product attributes for selected category
     * PK id in categories table
     * FK parent in category_attributes table
     *
     * @author Amk El-Kabbany at 19 May 2020
     * @contact alaa@upbeatdigital.team
     */
    function productAttributes()
    {
        return $this->hasMany(CategoryAttribute::class)->where('deleted_at', null);
    }

    /**
     * Get products for selected category
     * PK id in categories table
     * FK category_id in products table
     *
     * @author Amk El-Kabbany at 5 July 2020
     * @contact alaa@upbeatdigital.team
     */
    function products()
    {
        return $this->hasMany(Product::class)->where('deleted_at', null);
    }

    /**
     * Get brands for selected category
     * PK id in categories table
     * FK category_id in brands table
     *
     * @author Amk El-Kabbany at 19 May 2020
     * @contact alaa@upbeatdigital.team
     */
    function brands()
    {
        return $this->hasMany(Brand::class);
    }

    /**
     * Get brands for selected category
     * PK id in categories table
     * FK category_id in brands table
     *
     * @author Amk El-Kabbany at 19 May 2020
     * @contact alaa@upbeatdigital.team
     */
    function activeBrands()
    {
        return $this->hasMany(Brand::class)->where('deleted_at', null)->where('active', true);
    }

    /**
     * Get min price range for selected category
     *
     * @author Amk El-Kabbany at 5 July 2020
     * @contact alaa@upbeatdigital.team
     */
    function minPriceRange()
    {
        $product = $this->products()->where('active', '!=', false)->orderBy('price', 'asc')->first();
        // dump($product);
        return $product ? $product->discount ? round(($product->price - ((floatval($product->discount_rate)*floatval($product->price))/100)), 1) : $product->price : 0;
    }

    /**
     * Get min price range for selected category
     *
     * @author Amk El-Kabbany at 5 July 2020
     * @contact alaa@upbeatdigital.team
     */
    function maxPriceRange()
    {
        $product = $this->products()->where('active', '!=', false)->orderBy('price', 'desc')->first();
        // dd($product->discount);
        return $product ? $product->discount ? round(($product->price - ((floatval($product->discount_rate)*floatval($product->price))/100)), 1) : $product->price : 0;
    }

    /**
     * search among categories by specific term
     *
     * @param string $term
     * @return Collection
     *
     * @author Amk El-Kabbany at 16 June 2020
     * @contact alaa@upbeatdigital.team
     **/
    static public function search($term)
    {
        $query = Category::where('deleted_at', null)
            ->where('title_en', 'like', "%" . $term . '%');
        $system_languages = Language::where('prefix', '!=', 'en')->pluck('prefix');
        foreach ($system_languages as $system_language) {
            $query->orWhere('title_'.$system_language, 'like', '%' . $term . '%');
        }

        return $query->get();
    }
}
