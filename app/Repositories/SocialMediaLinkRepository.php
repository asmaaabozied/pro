<?php
/**
 * Social Media Link repository class which handel more of logic actions
 *
 * @author Amk El-Kabbany at 8 June 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Repositories;

use App\Models\SocialMediaLink;
use App\Repositories\BaseRepository;

/**
 * Class SocialMediaLinkRepository
 * @package App\Repositories
 * @version June 8, 2020, 12:15 am UTC
 *
 * @author Amk El-Kabbany at 8 June 2020
 * @contact alaa@upbeatdigital.team
*/

class SocialMediaLinkRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title_en',
        'link',
        'icon',
        'background_color',
        'class',
        'active',
        'description_en'
    ];

    /**
     * Class constructor
     *
     * @author Amk El-Kabbany at 8 June 2020
     * @contact alaa@upbeatdigital.team
     */
    public function __construct()
    {
        parent::__construct(app());
        $this->fieldSearchable = array_keys(alterLangArrayElements('social_media_links', ['fields' => array_combine($this->fieldSearchable,$this->fieldSearchable)], $key = 'fields')['fields']);
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
        return SocialMediaLink::class;
    }

    /**
     * Create model record
     *
     * @param array $input
     *
     * @return SocialMediaLink
     *
     * @author Amk El-Kabbany at 8 June 2020
     * @contact alaa@upbeatdigital.team
     */
    public function create($input)
    {
        $city = new SocialMediaLink();
        $city->fill($input)->save();

        return $city;
    }


    /**
     * Update model record for given id
     *
     * @param array $input
     * @param int $id
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model
     *
     * @author Amk El-Kabbany at 8 June 2020
     * @contact alaa@upbeatdigital.team
     */
    public function update($input, $id)
    {
        $city = new SocialMediaLink();
        $city = $city->findOrFail($id);
        $city->fill($input)->save();
        return $city;
    }
}
