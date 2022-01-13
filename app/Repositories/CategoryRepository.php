<?php
/**
 * Category repository class which handel more of logic actions
 *
 * @author Amk El-Kabbany at 28 Apr 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Repositories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Language;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Laracasts\Flash\Flash;

/**
 * Class CategoryRepository
 * @package App\Repositories
 * @version April 28, 2020, 9:35 am UTC
 *
 * @author Amk El-Kabbany at 28 Apr 2020
 * @contact alaa@upbeatdigital.team
*/

class CategoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title_en',
        'image',
        'icon',
        'parent',
        'active',
        'menu',
        'order',
    ];

    /**
     * Class constructor
     *
     * @author Amk El-Kabbany at 30 Apr 2020
     * @contact alaa@upbeatdigital.team
     */
    public function __construct()
    {
        parent::__construct(app());
        $this->fieldSearchable = array_keys(alterLangArrayElements('categories', ['fields' => array_combine($this->fieldSearchable,$this->fieldSearchable)], $key = 'fields')['fields']);
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
        return Category::class;
    }

    /**
     * List menu categories
     *
     * @param string $language
     * @return array
     *
     * @author Amk El-Kabbany at 15 June 2020
     * @contact alaa@upbeatdigital.team
     **/
    public function menu($language)
    {
        return Category::where('deleted_at', null)->where('active', true)->where('menu', true)->orderBy('order')->get();
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
        $title = 'title_'.$language;
        return Category::where('deleted_at', null)->where('active', true)
            ->where($language, true)->orderBy($title)->pluck($title, 'id');
    }

    /**
     * Pluck model entries according to provided language
     *
     * @param string $language
     * @return array
     *
     * @author Mahmoud Bakr at 13 August 2020
     * @contact m.bakr@upbeatdigital.team
     **/
    public function parentPluck($language)
    {
        $title = 'title_'.$language;
        return Category::where('deleted_at', null)->where('parent', null)->where('active', true)
            ->where($language, true)->orderBy($title)->pluck($title, 'id');
    }

    /**
     * Pluck model entries according to provided language
     *
     * @param string $language
     * @return array
     *
     * @author Mahmoud Bakr at 13 August 2020
     * @contact m.bakr@upbeatdigital.team
     **/
    public function categoryPluck($language)
    {
        $title = 'title_'.$language;
        return Category::where('deleted_at', null)->where('parent', '!=', null)->doesntHave('subcategories', 'or')->where('active', true)
            ->where($language, true)->orderBy($title)->pluck($title, 'id')->with('subCategories');
    }

    /**
     * Lists selected sub-categories according to provided category id
     *
     * @param int $id
     * @return array
     *
     * @author Amk El-Kabbany at 15 June 2020
     * @contact alaa@upbeatdigital.team
     **/
    public function subCategories($id)
    {
        return @Category::where('deleted_at', null)->where('active', true)->where('id', $id)->first()->subCategories;
    }

    /**
     * Lists All Categories
     *
     * @param int $id
     * @return array
     *
     * @author Amk El-Kabbany at 15 June 2020
     * @contact alaa@upbeatdigital.team
     **/
    public function List()
    {
        return @Category::where('deleted_at', null)->where('active', true)->get();
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
    public function search($term)
    {
        return Category::search($term);
    }

    /**
     * Create model record
     *
     * @param array $input
     *
     * @return Category|boolean
     *
     * @author Amk El-Kabbany at 28 Apr 2020
     * @contact alaa@upbeatdigital.team
     */
    public function create($input)
    {
        if (request()->hasFile('image')) {
            $destinationPath = 'storage/Categories/images';
            $file_info = getimagesize(request()->file('image'));
            if (empty($file_info)) { // No Image?
                Flash::error(trans('common.messages.valid_image'));
                return false;
            }
            $file = request()->file('image');
            $attach = $destinationPath . '/' . rand() . '-categories-' . date("d-m-y-H-M") . '-' . $file->getClientOriginalName();
            $file->move($destinationPath, ($attach));
            $input['image'] = trim($attach);
        } else {
            Flash::error(trans('common.messages.required_image'));
            return false;
        }

        if (request()->hasFile('icon')) {
            $destinationPath = 'storage/Categories/icons';
            $file_info = getimagesize(request()->file('icon'));
            if (empty($file_info)) { // No Image?
                Flash::error(trans('common.messages.valid_icon'));
                return false;
            }
            $file = request()->file('icon');
            $attach = $destinationPath . '/' . rand() . '-categories-' . date("d-m-y-H-M") . '-' . $file->getClientOriginalName();
            $file->move($destinationPath, ($attach));
            $input['icon'] = trim($attach);
        } else {
            Flash::error(trans('common.messages.required_icon'));
            return false;
        }

        $category = new Category();
        $category->fill($input)->save();

        return $category;
    }

    /**
     * Update model record for given id
     *
     * @param array $input
     * @param int $id
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model|boolean
     *
     * @author Amk El-Kabbany at 28 Apr 2020
     * @contact alaa@upbeatdigital.team
     */
    public function update($input, $id)
    {
        if (request()->hasFile('image')) {
            $destinationPath = 'storage/Categories/images';
            $file_info = getimagesize(request()->file('image'));
            if (empty($file_info)) { // No Image?
                Flash::error(trans('common.messages.valid_image'));
                return false;
            }
            $file = request()->file('image');
            $attach = $destinationPath . '/' . rand() . '-categories-' . date("d-m-y-H-M") . '-' . $file->getClientOriginalName();
            $file->move($destinationPath, ($attach));
            $input['image'] = trim($attach);
        }

        if (request()->hasFile('icon')) {
            $destinationPath = 'storage/Categories/icons';
            $file_info = getimagesize(request()->file('icon'));
            if (empty($file_info)) { // No Image?
                Flash::error(trans('common.messages.valid_icon'));
                return false;
            }
            $file = request()->file('icon');
            $attach = $destinationPath . '/' . rand() . '-categories-' . date("d-m-y-H-M") . '-' . $file->getClientOriginalName();
            $file->move($destinationPath, ($attach));
            $input['icon'] = trim($attach);
        }

        $category = Category::findOrFail($id);

        $category->fill($input)->save();

        return $category;
    }

    /**
     * @param int $id
     *
     * @throws \Exception
     *
     * @return bool|mixed|null
     *
     * @author Amk El-Kabbany at 29 Apr 2020
     * @contact alaa@upbeatdigital.team
     */
    public function delete($id)
    {
        $query = $this->model->newQuery();
        $category = $query->findOrFail($id);

        $query = $this->model->newQuery();
        if($query->where('parent', $id)->exists()) {
            Flash::error(trans('category.messages.category_subcategory_assigned'));
            return false;
        }

        if(Brand::where('category_id', $id)->exists()) {
            Flash::error(trans('category.messages.category_brands_assigned'));
            return false;
        }

        if($category->menu) {
            Flash::error(trans('category.messages.menu_item'));
            return false;
        }

        return $category->delete();
    }
}
