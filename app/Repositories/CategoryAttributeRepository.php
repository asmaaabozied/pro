<?php
/**
 * Category Attribute repository class which handel more of logic actions
 *
 * @author Amk El-Kabbany at 12 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Repositories;

use App\Models\Category;
use App\Models\CategoryAttribute;
use App\Repositories\BaseRepository;

/**
 * Class CategoryAttributeRepository
 * @package App\Repositories
 * @version May 12, 2020, 11:01 am UTC
 *
 * @author Amk El-Kabbany at 12 May 2020
 * @contact alaa@upbeatdigital.team
*/

class CategoryAttributeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'category_id',
        'name_en',
        'description_en',
        'unit',
        'active'
    ];

    /**
     * Class constructor
     *
     * @author Amk El-Kabbany at 12 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function __construct()
    {
        parent::__construct(app());
        $this->fieldSearchable = array_keys(alterLangArrayElements('category_attributes', ['fields' => array_combine($this->fieldSearchable,$this->fieldSearchable)], $key = 'fields')['fields']);
    }

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CategoryAttribute::class;
    }

    /**
     * Pluck model entries according to provided language
     *
     * @param string $language
     * @return array
     *
     * @author Amk El-Kabbany at 18 May 2020
     * @contact alaa@upbeatdigital.team
     **/
    public function pluck($language)
    {
        $name = 'name_'.$language;
        return CategoryAttribute::where('deleted_at', null)
            ->where('active', true)->whereIn('parent', [null, 0])
            ->orderBy($name)->pluck($name, 'id');
    }

    /**
     * Retrieve all category attributes according to selected category
     *
     * @param int $category_id
     * @return array
     *
     * @author Amk El-Kabbany at 15 June 2020
     * @contact alaa@upbeatdigital.team
     **/
    public function lists($category_id)
    {
        return @Category::where('deleted_at', null)->where('id', $category_id)
            ->first()->attributes;
    }

    /**
     * Create model record
     *
     * @param array $input
     *
     * @return CategoryAttribute
     *
     * @author Amk El-Kabbany at 12 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function create($input)
    {
        $categoryAttribute = new CategoryAttribute();
        $categoryAttribute->fill($input)->save();

        return $categoryAttribute;
    }
}
