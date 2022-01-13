<?php
/**
 * Related products model class which handel more of relational actions
 *
 * @author Amk El-Kabbany at 21 June 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class RelatedProduct
 * @package App\Models
 * @version May 27, 2020, 9:19 am UTC
 *
 * @property integer $product_id
 * @property integer $related_product_id
 *
 * @author Amk El-Kabbany at 21 June 2020
 * @contact alaa@upbeatdigital.team
 */
class RelatedProduct extends Model
{
    use SoftDeletes;

    public $table = 'related_products';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'product_id',
        'related_product_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'product_id' => 'integer',
        'related_product_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'product_id' => 'required|exists:products,id',
        'related_product_id' => 'required|exists:products,id',
    ];

    /**
     * Get related product for selected product
     * PK id in products table
     * FK related_product_id in related_products table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * @author Amk El-Kabbany at 27 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function relatedProduct()
    {
        return $this->belongsTo(Product::class, 'related_product_id');
    }

    /**
     * Get related product for selected product
     * PK id in products table
     * FK related_product_id in related_products table
     *
     * @param int $id
     * @return array
     *
     * @author Amk El-Kabbany at 21 June 2020
     * @contact alaa@upbeatdigital.team
     */
    static public function relatedProducts($id)
    {
        $relatedProducts = [];
        foreach ((Product::findOrFail($id))->relatedProducts as $object){
            $relatedProducts[] = Product::find($object->related_product_id);
        }
        return $relatedProducts;
    }
}
