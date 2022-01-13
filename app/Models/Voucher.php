<?php
/**
 * Voucher model class which handel more of relational actions
 *
 * @author Amk El-Kabbany at 31 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Voucher
 * @package App\Models
 * @version May 31, 2020, 5:49 pm UTC
 *
 * @property string $title_en
 * @property string $description_en
 * @property number $rate
 * @property string $start_date
 * @property string $end_date
 *
 * @author Amk El-Kabbany at 31 May 2020
 * @contact alaa@upbeatdigital.team
 */
class Voucher extends Model
{
    use SoftDeletes;

    public $table = 'vouchers';
    

    protected $dates = ['deleted_at'];

    
    public $fillable = [
        'type',
        'title_en',
        'description_en',
        'code',
        'count',
        'usage',
        'rate',
        'start_date',
        'store_id',
        'end_date'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'store_id' => 'integer',
        'type' => 'string',
        'title_en' => 'string',
        'description_en' => 'string',
        'code' => 'string',
        'count' => 'integer',
        'usage' => 'integer',
        'rate' => 'float',
        // 'start_date' => 'date',
        // 'end_date' => 'date'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title_en' => 'required|min:3',
        'description_en' => 'required',
        // 'code' => "unique:vouchers,code,NULL,id,deleted_at,NULL",
        'store_id' => 'required|exists:stores,id',
        'code'=>'required|unique:coupons,code',
        'type' => "required",
        'rate' => 'required|min:0',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after:start_date'
    ];
    

    /**
     * Get instance of this model
     *
     * @author Amk El-Kabbany at 31 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function __construct()
    {
        $this->fillable = array_keys(alterLangArrayElements('vouchers', ['fields' => array_combine($this->fillable,$this->fillable)], $key = 'fields')['fields']);
        $this->casts = alterLangArrayElements('vouchers', ['fields' => $this->casts], $key = 'fields')['fields'];
        self::$rules = alterLangArrayElements('vouchers', ['fields' => self::$rules], $key = 'fields')['fields'];
    }

    /**
     * Get selected voucher used orders
     * PK id in vouchers table
     * FK voucher_id in order_voucher table
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     *
     * @author Amk El-Kabbany at 9 July 2020
     * @contact alaa@upbeatdigital.team
     */
    public function orders()
    {
        return $this->hasMany(OrderVoucher::class)->where('deleted_at', null);
    }

    public function store(){
        return $this->belongsTo(Store::class);
    }

    public function scopeLimited($query)
    {
        $user=auth()->user();
        $owner_id=$user->id;
        if( $user->account_type == 3){
            return $query->whereHas('store', function($sub) use($owner_id){
                $sub->where('owner_id', $owner_id);
            });
        }
        return $query;
    }
}
