<?php
/**
 * Brand repository class which handel more of logic actions
 *
 * @author Amk El-Kabbany at 30 Apr 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Repositories;

use App\Models\Brand;
use App\Models\Category;
use App\Repositories\BaseRepository;
use Laracasts\Flash\Flash;

/**
 * Class BrandRepository
 * @package App\Repositories
 * @version April 30, 2020, 3:31 pm UTC
 *
 * @author Amk El-Kabbany at 30 Apr 2020
 * @contact alaa@upbeatdigital.team
*/

class BrandRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'category_id',
        'title_en',
//        'description_en',
//        'image',
        'active',
        'en'
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
        $this->fieldSearchable = array_keys(alterLangArrayElements('brands', ['fields' => array_combine($this->fieldSearchable,$this->fieldSearchable)], $key = 'fields')['fields']);
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
        return Brand::class;
    }

    /**
     * Pluck model entries according to provided language
     *
     * @param int $category_id
     * @return array
     *
     * @author Amk El-Kabbany at 18 May 2020
     * @contact alaa@upbeatdigital.team
     **/
    public function showByCategory($category_id)
    {
        return @(Category::where('deleted_at', null)->where('id', $category_id)
                    ->where('active', true)->first())->activeBrands;
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
        return Brand::where('deleted_at', null)->where('active', true)
            ->where($language, true)->orderBy($title)->pluck($title, 'id');
    }

    /**
     * Create model record
     *
     * @param array $input
     *
     * @return Brand|boolean
     *
     * @author Amk El-Kabbany at 28 Apr 2020
     * @contact alaa@upbeatdigital.team
     */
    public function create($input)
    {
//        if (request()->hasFile('image')) {
//            $destinationPath = 'storage/Brands/images';
//            $file_info = getimagesize(request()->file('image'));
//            if (empty($file_info)) { // No Image?
//                Flash::error(trans('common.messages.valid_image'));
//                return false;
//            }
//            $file = request()->file('image');
//            $attach = $destinationPath . '/' . rand() . '-brands-' . date("d-m-y-H-M") . '-' . $file->getClientOriginalName();
//            $file->move($destinationPath, ($attach));
//            $input['image'] = trim($attach);
//        } else {
//            Flash::error(trans('common.messages.required_image'));
//            return false;
//        }

        $brand = new Brand();
        $brand->fill($input)->save();

        return $brand;
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
//        if (request()->hasFile('image')) {
//            $destinationPath = 'storage/Brands/images';
//            $file_info = getimagesize(request()->file('image'));
//            if (empty($file_info)) { // No Image?
//                Flash::error(trans('common.messages.valid_image'));
//                return false;
//            }
//            $file = request()->file('image');
//            $attach = $destinationPath . '/' . rand() . '-brands-' . date("d-m-y-H-M") . '-' . $file->getClientOriginalName();
//            $file->move($destinationPath, ($attach));
//            $input['image'] = trim($attach);
//        }

        $brand = Brand::findOrFail($id);

        $brand->fill($input)->save();

        return $brand;
    }

    /**
     * @param int $id
     *
     * @throws \Exception
     *
     * @return bool|mixed|null
     *
     * @author Amk El-Kabbany at 30 Apr 2020
     * @contact alaa@upbeatdigital.team
     */
    public function delete($id)
    {
        $query = $this->model->newQuery();
        $brand = $query->findOrFail($id);

        return $brand->delete();
    }
}
