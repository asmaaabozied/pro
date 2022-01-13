<?php
/**
 * Store repository class which handel more of logic actions
 *
 * @author Amk El-Kabbany at 7 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Repositories;

use App\Models\Language;
use App\Models\Store;
use App\Models\StoreTermsAndPolicy;
use App\Repositories\BaseRepository;
use Laracasts\Flash\Flash;

/**
 * Class StoreRepository
 * @package App\Repositories
 * @version May 7, 2020, 6:14 pm UTC
 *
 * @author Amk El-Kabbany at 7 May 2020
 * @contact alaa@upbeatdigital.team
*/

class StoreRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name_en',
        'description_en',
        'image',
        'phone',
        'store_type',
        'owner_id',
        'status',
        'activated'
    ];

    /**
     * Class constructor
     *
     * @author Amk El-Kabbany at 7 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function __construct()
    {
        parent::__construct(app());
        $this->fieldSearchable = array_keys(alterLangArrayElements('stores', ['fields' => array_combine($this->fieldSearchable,$this->fieldSearchable)], $key = 'fields')['fields']);
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
        return Store::class;
    }

    /**
     * Pluck model entries according to provided language
     *
     * @param string $language
     * @param boolean $activated
     * @return array
     *
     * @author Amk El-Kabbany at 18 May 2020
     * @contact alaa@upbeatdigital.team
     **/
    public function pluck($language, $activated = null)
    {
        $name = 'name_'.$language;
        return Store::where('deleted_at', null)->when($activated != null, function ($query, $activated){
            return $query->where('activated', $activated);
        })->orderBy($name)->pluck($name, 'id');

    }

    /**
     * Create model record
     *
     * @param array $input
     *
     * @return Store|boolean
     *
     * @author Amk El-Kabbany at 28 Apr 2020
     * @contact alaa@upbeatdigital.team
     */
    public function create($input)
    {
        if (request()->hasFile('image')) {
            $destinationPath = 'storage/Stores/images';
            $file_info = getimagesize(request()->file('image'));
            if (empty($file_info)) { // No Image?
                Flash::error(trans('common.messages.valid_image'));
                return false;
            }
            $file = request()->file('image');
            $attach = $destinationPath . '/' . rand() . '-stores-' . date("d-m-y-H-M") . '-' . $file->getClientOriginalName();
            $file->move($destinationPath, ($attach));
            $input['image'] = trim($attach);
        } else {
            Flash::error(trans('common.messages.required_image'));
            return false;
        }

        $system_languages = isset($input['system_language'])? $input['system_language']
                                : Language::where('prefix', '!=', 'en')->get()->pluck('prefix');
        $paragraphs = array();
        if (isset($input['counter']) && $input['counter'] > 0) {
            for ($i = 1; $i <= $input['counter']; $i++) {
                $paragraphs[$i]['title_en'] = $input['paragraph_title_en' . $i];
                foreach ($system_languages as $system_language)
                    $paragraphs[$i]['title_'.$system_language] = $input['paragraph_title_'. $system_language . $i];
                $paragraphs[$i]['description_en'] = $input['paragraph_description_en' . $i];
                foreach ($system_languages as $system_language)
                    $paragraphs[$i]['description_'.$system_language] = $input['paragraph_description_'. $system_language . $i];
                $paragraphs[$i]['active'] = $input['paragraph_active' . $i];
                $paragraphs[$i]['en'] = $input['paragraph_en' . $i];
                foreach ($system_languages as $system_language)
                    $paragraphs[$i][$system_language] = $input['paragraph_'. $system_language . $i];

                unset($input['paragraph_title_en' . $i]);
                foreach ($system_languages as $system_language)
                    unset($input['paragraph_title_' . $system_language . $i]);
                unset($input['paragraph_description_en' . $i]);
                foreach ($system_languages as $system_language)
                    unset($input['paragraph_description_' . $system_language . $i]);
                unset($input['paragraph_active' . $i]);
                unset($input['paragraph_en' . $i]);
                foreach ($system_languages as $system_language)
                    unset($input['paragraph_' . $system_language . $i]);
            }
        }
        unset($input['counter']);
        unset($input['system_language']);

        $store = new Store();
        $store->fill($input)->save();

        foreach ($paragraphs as $paragraph) {
            $paragraph['store_id'] = $store->id;
            $object = new StoreTermsAndPolicy();
            $object->fill($paragraph)->save();
        }

        return $store;
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
            $destinationPath = 'storage/Stores/images';
            $file_info = getimagesize(request()->file('image'));
            if (empty($file_info)) { // No Image?
                Flash::error(trans('common.messages.valid_image'));
                return false;
            }
            $file = request()->file('image');
            $attach = $destinationPath . '/' . rand() . '-stores-' . date("d-m-y-H-M") . '-' . $file->getClientOriginalName();
            $file->move($destinationPath, ($attach));
            $input['image'] = trim($attach);
        }

        $store = Store::findOrFail($id);
        $store->fill($input)->save();

        return $store;
    }
}
