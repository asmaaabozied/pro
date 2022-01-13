<?php
/**
 * Product model class which handel more of relational actions
 *
 * @author Amk El-Kabbany at 19 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

/**
 * Class Product
 * @package App\Models
 * @version May 19, 2020, 2:06 pm UTC
 *
 * @property \App\Models\Category $category
 * @property \App\Models\Brand $brand
 * @property integer $store_id
 * @property integer $category_id
 * @property integer $brand_id
 * @property string $title_en
 * @property string $description_en
 * @property number $price
 * @property number $quantity
 * @property boolean $discount
 * @property number $discount_rate
 * @property string $discount_start_date
 * @property string $discount_end_date
 * @property boolean $featured
 * @property boolean $active
 * @property boolean $en
 *
 * @author Amk El-Kabbany at 19 May 2020
 * @contact alaa@upbeatdigital.team 
 */
class Product extends Model
{
    use SoftDeletes;

    public $table = 'products';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'store_id',
        'category_id',
        'brand_id',
        'title_en',
        'description_en',
        'image',
        'price',
        'quantity',
        'weight',
        'width',
        'height',
        'length',
        'discount',
        'discount_rate',
        'discount_start_date',
        'discount_end_date',
        'featured',
        'active',
        'in_slider',
        'en'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'category_id' => 'integer',
        'store_id' => 'integer',
        'brand_id' => 'integer',
        'title_en' => 'string',
        'description_en' => 'string',
        'image' => 'string',
        'price' => 'double',
        'quantity' => 'integer',
        'discount' => 'boolean',
        'discount_rate' => 'double',
        'discount_start_date' => 'date',
        'discount_end_date' => 'date',
        'featured' => 'boolean',
        'active' => 'boolean',
        'en' => 'boolean',
        'weight' => 'double',
        'length' => 'double',
        'width'  => 'double',
        'height' => 'double'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'store_id' => 'required|exists:stores,id',
        'category_id' => 'required|exists:categories,id',
        'brand_id' => 'required|exists:brands,id',
        'title_en' => 'required|min:3',
        'description_en' => 'required',
        'price' => 'required|min:0',
        'quantity' => 'required|min:0',
        'width'    => 'required|numeric',
        'height'   => 'required|numeric',
        'length'   => 'required|numeric',
        'weight'   => 'required|numeric'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $filterRules = [
        'store' => 'exists:stores,id|nullable',
        'category' => 'exists:categories,id|nullable',
        'subcategory' => 'exists:categories,id|nullable',
        'brand.*' => 'exists:brands,id|nullable',
        // 'attributes.*' => 'exists:category_attributes,id|nullable',
        'minimum_price' => 'numeric|nullable',
        'maximum_price' => 'numeric|nullable',
        'rate' => 'numeric|nullable',
        'featured' => 'boolean|nullable',
        'latest' => 'boolean|nullable',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $fetchByIdsRules = [
        'products.*' => 'exists:products,id',
    ];

    /**
     * Get instance of this model
     *
     * @author Amk El-Kabbany at 20 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function __construct()
    {
        $this->fillable = array_keys(alterLangArrayElements('products', ['fields' => array_combine($this->fillable,$this->fillable)], $key = 'fields')['fields']);
        $this->casts = alterLangArrayElements('products', ['fields' => $this->casts], $key = 'fields')['fields'];
        self::$rules = alterLangArrayElements('products', ['fields' => self::$rules], $key = 'fields')['fields'];
    }

    /**
     * Get category attributes for selected category
     * PK id in categories table
     * FK category_id in products table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * @author Amk El-Kabbany at 19 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    /**
     * Get category for selected product
     * PK id in categories table
     * FK category_id in products table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * @author Amk El-Kabbany at 19 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get brand for selected product
     * PK id in brands table
     * FK brand_id in products table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * @author Amk El-Kabbany at 19 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * Get category attributes values for selected product
     * PK id in products table
     * FK product_id in products_attributes table
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     *
     * @author Amk El-Kabbany at 19 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }

    /**
     * Get active category attributes values for selected product
     * PK id in products table
     * FK product_id in products_attributes table
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     *
     * @author Amk El-Kabbany at 21 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function activeAttributes()
    {
        return ProductAttribute::where('deleted_at', null)->where('product_id', $this->id)
                                ->where('active', true)->get();
    }

    /**
     * Get images for selected product
     * PK id in products table
     * FK product_id in products_images table
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     *
     * @author Amk El-Kabbany at 21 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    /**
     * Get active images for selected product
     * PK id in products table
     * FK product_id in products_images table
     * @return ProductImage
     *
     * @author Amk El-Kabbany at 21 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function activeImages()
    {
        return ProductImage::where('deleted_at', null)->where('product_id', $this->id)
                                ->where('active', true)->get();
    }

    /**
     * Get main image for selected product
     * PK id in products table
     * FK product_id in products_images table
     * @return ProductImage|null
     *
     * @author Amk El-Kabbany at 21 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function mainImage()
    {
        $productImage = ProductImage::where('deleted_at', null)->where('product_id', $this->id)
                                    ->where('active', true)->where('main', true)->first();
        if($productImage == null)
        {
            $productImage = ProductImage::where('deleted_at', null)->where('product_id', $this->id)
                                        ->where('active', true)->first();
            $this->image = ($productImage != null)? $productImage->image : 'images/default-image.jpg';
            $this->save();
        }
        return $this->image;
    }

    /**
     * Get users favourites this product
     * PK id in products table
     * FK product_id in product_favourites table
     * @return ProductsFavourite
     *
     * @author Amk El-Kabbany at 27 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function favourites()
    {
        return $this->hasMany(ProductsFavourite::class);
    }

    /**
     * Get ratings this product
     * PK id in products table
     * FK product_id in product_ratings table
     * @return ProductRating
     *
     * @author Amk El-Kabbany at 18 June 2020
     * @contact alaa@upbeatdigital.team
     */
    public function ratings()
    {
        return $this->hasMany(ProductRating::class);
    }

    /**
     * Get related products to this product
     * PK id in products table
     * FK product_id in related_products table
     * @return ProductRating
     *
     * @author Amk El-Kabbany at 18 June 2020
     * @contact alaa@upbeatdigital.team
     */
    public function relatedProducts()
    {
        return $this->hasMany(RelatedProduct::class, 'product_id');
    }

    /**
     * Get discounts products

     * @return Product
     *
     * @author Amk El-Kabbany at 16 June 2020
     * @contact alaa@upbeatdigital.team
     */
    static public function discounts()
    {
        return Product::where('deleted_at', null)->where('discount', true)
                    ->whereDate('discount_end_date', '>=', date('Y-m-d'))
                    ->orderBy('discount_end_date')->get();
    }

    /**
     * Get latest products
     *
     * @param int $store_id
     * @return Product
     *
     * @author Amk El-Kabbany at 16 June 2020
     * @contact alaa@upbeatdigital.team
     */
    static public function latest($store_id)
    {
        $query = Product::where('deleted_at', null)->where('active', true)->orderBy('created_at')->get();
        if($store_id != null) {
            return $query->where('store_id', intval($store_id));
        } else {
            return $query->take(8);
        }
    }

    /**
     * Get featured products
     *
     * @return Product
     *
     * @author Amk El-Kabbany at 23 June 2020
     * @contact alaa@upbeatdigital.team
     */
    static public function featured()
    {
        return Product::where('deleted_at', null)->where('active', true)
                        ->where('featured', true)->get();
    }

    /**
     * Get selected product rate

     * @return float
     *
     * @author Amk El-Kabbany at 17 June 2020
     * @contact alaa@upbeatdigital.team
     */
    public function rate()
    {
        return $this->hasMany(ProductRating::class, 'product_id')->avg('rate');
    }

    /**
     * Get selected product raters count

     * @return int
     *
     * @author Amk El-Kabbany at 17 June 2020
     * @contact alaa@upbeatdigital.team
     */
    public function raters()
    {
        return $this->hasMany(ProductRating::class, 'product_id')->count();
    }

    /**
     * search among products by specific term
     *
     * @param string $term
     * @return Collection
     *
     * @author Amk El-Kabbany at 16 June 2020
     * @contact alaa@upbeatdigital.team
     **/
    static public function search($term)
    {
        $query = Product::where('deleted_at', null)
            ->where('title_en', 'like', '%' . $term . '%');
        $system_languages = Language::where('prefix', '!=', 'en')->pluck('prefix');
        foreach ($system_languages as $system_language) {
            $query->orWhere('title_'.$system_language, 'like', '%' . $term . '%');
        }

        return $query->get();
    }

    public function scopeLimited($query)
    {
        // dd(Auth::user()->id);
        if(Auth::user()->account_type == 3){
            $productIds = Auth::user()->productsIds();
            return $query->whereIn('id', $productIds);
        }
        return $query;
    }

    public function finalWeight(){
        $calculated_weight = ($this->width * $this->height * $this->length) / 5000;

        return $this->weight > $calculated_weight ? $this->weight : $calculated_weight;
    }
}
