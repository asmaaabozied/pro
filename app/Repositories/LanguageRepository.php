<?php
/**
 * Language repository class which handel more of logic actions
 *
 * @author Amk El-Kabbany at 28 Apr 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Repositories;

use App\Models\Language;
use App\Repositories\BaseRepository;
use Laracasts\Flash\Flash;

/**
 * Class LanguageRepository
 * @package App\Repositories
 * @version April 28, 2020, 9:49 am UTC
 *
 * @author Amk El-Kabbany at 28 Apr 2020
 * @contact alaa@upbeatdigital.team
*/

class LanguageRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'prefix'
    ];

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
        return Language::class;
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
        $language = $query->findOrFail($id);

        if($language->prfix == 'en') {
            Flash::error(trans('language.messages.can_not_delete'));
            return false;
        }

        return $language->delete();
    }
}
