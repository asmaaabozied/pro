<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

/**
 * Class Store Terms And Policy
 * @package App\Models
 * @version May 10, 2020, 10:47 am UTC
 *
 * @property string $title_en
 * @property string $description_en
 * @property int $store_id
 * @property boolean $active
 * @property boolean $en
 *
 * @author Amk El-Kabbany at 10 May 2020
 * @contact alaa@upbeatdigital.team
 */
class StoreTermsAndPolicy extends Model
{
    use SoftDeletes;

    public $table = 'store_terms_policy';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'title_en',
        'description_en',
        'store_id',
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
        'title_en' => 'string',
        'description_en' => 'string',
        'store_id' => 'integer|exists:stores,id',
        'active' => 'boolean',
        'en' => 'boolean'
    ];

    /**
     * Get instance of this model
     *
     * @author Amk El-Kabbany at 10 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function __construct()
    {
        $this->fillable = array_keys(alterLangArrayElements('store_terms_policy', ['fields' => array_combine($this->fillable,$this->fillable)], $key = 'fields')['fields']);
        $this->casts = alterLangArrayElements('store_terms_policy', ['fields' => $this->casts], $key = 'fields')['fields'];
    }

    /**
     * Get store for selected terms and policies paragraph
     * PK id in stores table
     * FK store_id in store_terms_policy table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * @author Amk El-Kabbany at 10 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function scopeLimited($query)
    {
        // dd(Auth::user()->id);
        // dump($this->items);
        if(Auth::user()->account_type == 3){
            $owner_id = Auth::id();
            return $query->whereHas('store', function($sub) use($owner_id){
                $sub->where('owner_id', $owner_id);
            });
        }
        return $query;
    }
}
