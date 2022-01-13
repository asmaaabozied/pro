<?php
/**
 * Brand model class which handel more of relational actions
 *
 * @author Amk El-Kabbany at 7 June 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class SocialMediaLink
 * @package App\Models
 * @version June 8, 2020, 12:15 am UTC
 *
 * @property string $title_en
 * @property string $link
 * @property string $icon
 * @property string $background_color
 * @property string $class
 * @property boolean $active
 * @property string $description_en
 *
 * @author Amk El-Kabbany at 7 June 2020
 * @contact alaa@upbeatdigital.team
 */
class SocialMediaLink extends Model
{
    use SoftDeletes;

    public $table = 'social_media_links';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'title_en',
        'link',
        'icon',
        'background_color',
        'class',
        'active',
        'description_en'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title_en' => 'string',
        'link' => 'string',
        'icon' => 'string',
        'background_color' => 'string',
        'class' => 'string',
        'active' => 'boolean',
        'description_en' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title_en' => 'required|min:3',
        'link' => 'required',
        'icon' => 'required',
        'background_color' => 'required',
    ];
    
    /**
     * Get instance of this model
     *
     * @author Amk El-Kabbany at 7 June 2020
     * @contact alaa@upbeatdigital.team
     */
    public function __construct()
    {
        $this->fillable = array_keys(alterLangArrayElements('social_media_links', ['fields' => array_combine($this->fillable,$this->fillable)], $key = 'fields')['fields']);
        $this->casts = alterLangArrayElements('social_media_links', ['fields' => $this->casts], $key = 'fields')['fields'];
        self::$rules = alterLangArrayElements('social_media_links', ['fields' => self::$rules], $key = 'fields')['fields'];
    }
}
