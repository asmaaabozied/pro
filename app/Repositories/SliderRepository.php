<?php
/**
 * Slider repository class which handel more of logic actions
 *
 * @author Amk El-Kabbany at 10 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Repositories;

use App\Models\Slider;
use App\Models\Store;
use App\Repositories\BaseRepository;
use Laracasts\Flash\Flash;

/**
 * Class SliderRepository
 * @package App\Repositories
 * @version May 10, 2020, 12:12 pm UTC
 *
 * @author Amk El-Kabbany at 10 May 2020
 * @contact alaa@upbeatdigital.team
*/

class SliderRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'store_id',
        'title_en',
        'description_en',
        'image',
        'link',
        'active',
        'en'
    ];

    /**
     * Class constructor
     *
     * @author Amk El-Kabbany at 10 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function __construct()
    {
        parent::__construct(app());
        $this->fieldSearchable = array_keys(alterLangArrayElements('sliders', ['fields' => array_combine($this->fieldSearchable,$this->fieldSearchable)], $key = 'fields')['fields']);
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
        return Slider::class;
    }

    public function List()
    {
        return @Slider::where('deleted_at', null)->where('active', true)->get();
    }

    /**
     * Pluck model entries according to provided language
     *
     * @param string $language
     * @param int $store_id
     * @return array
     *
     * @author Amk El-Kabbany at 18 May 2020
     * @contact alaa@upbeatdigital.team
     **/
    public function pluck($language, $store_id)
    {
        $title = 'title_'.$language;
        return Slider::where('deleted_at', null)->where('active', true)->where('store_id', $store_id)
                      ->where($language, true)->orderBy($title)->pluck($title, 'id');
    }

    /**
     * Create model record
     *
     * @param array $input
     *
     * @return Slider|boolean
     *
     * @author Amk El-Kabbany at 10 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function create($input)
    {
        if (request()->hasFile('image')) {
            $destinationPath = 'storage/Sliders/images';
            $file_info = getimagesize(request()->file('image'));
            if (empty($file_info)) { // No Image?
                Flash::error(trans('common.messages.valid_image'));
                return false;
            }
            $file = request()->file('image');
            $attach = $destinationPath . '/' . rand() . '-sliders-' . date("d-m-y-H-M") . '-' . $file->getClientOriginalName();
            $file->move($destinationPath, ($attach));
            $input['image'] = trim($attach);
        } else {
            Flash::error(trans('common.messages.required_image'));
            return false;
        }

        $slider = new Slider();
        $input['link'] = iconv('ASCII', 'UTF-8//IGNORE', $input['link']);
        $slider->fill($input)->save();

        return $slider;
    }

    /**
     * Update model record for given id
     *
     * @param array $input
     * @param int $id
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model|boolean
     *
     * @author Amk El-Kabbany at 10 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function update($input, $id)
    {
        if (request()->hasFile('image')) {
            $destinationPath = 'storage/Sliders/images';
            $file_info = getimagesize(request()->file('image'));
            if (empty($file_info)) { // No Image?
                Flash::error(trans('common.messages.valid_image'));
                return false;
            }
            $file = request()->file('image');
            $attach = $destinationPath . '/' . rand() . '-sliders-' . date("d-m-y-H-M") . '-' . $file->getClientOriginalName();
            $file->move($destinationPath, ($attach));
            $input['image'] = trim($attach);
        }

        $slider = Slider::findOrFail($id);
        $input['link'] = iconv('CP1256', 'UTF-8', $input['link']);
        $slider->fill($input)->save();

        return $slider;
    }
}
