<?php
/**
 * Product Images model class which handel more of relational actions
 *
 * @author Amk El-Kabbany at 21 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ProductImage
 * @package App\Models
 * @version May 21, 2020, 2:06 pm UTC
 *
 * @property integer $product_id
 * @property string  $image
 * @property boolean $main
 * @property boolean $active
 *
 * @author Amk El-Kabbany at 21 May 2020
 * @contact alaa@upbeatdigital.team
 */
class ProductImage extends Model
{
    use SoftDeletes;

    public $table = 'product_images';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'product_id',
        'image',
        'active',
        'main'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'product_id' => 'integer',
        'image' => 'string',
        'active' => 'boolean',
        'main' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'product_id' => 'required|exists:products,id',
        'image' => 'required'
    ];

    /**
     * Get product for selected product image
     * PK id in products table
     * FK product_id in product_images table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * @author Amk El-Kabbany at 21 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
