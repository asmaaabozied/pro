<?php
/**
 * Subscription repository class which handel more of logic actions
 *
 * @author Amk El-Kabbany at 12 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Repositories;

use App\Models\Subscription;
use App\Repositories\BaseRepository;

/**
 * Class SubscriptionRepository
 * @package App\Repositories
 * @version May 12, 2020, 5:34 pm UTC
 *
 * @author Amk El-Kabbany at 12 May 2020
 * @contact alaa@upbeatdigital.team
*/

class SubscriptionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title_en',
        'description_en',
        'price',
        'duration',
        'active',
        'en'
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
        $this->fieldSearchable = array_keys(alterLangArrayElements('subscriptions', ['fields' => array_combine($this->fieldSearchable,$this->fieldSearchable)], $key = 'fields')['fields']);
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
        return Subscription::class;
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
        return Subscription::where('deleted_at', null)->where('active', true)
            ->where($language, true)->orderBy($title)->pluck($title, 'id');
    }

    /**
     * Create model record
     *
     * @param array $input
     *
     * @return Subscription
     *
     * @author Amk El-Kabbany at 12 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function create($input)
    {
        $subscription = new Subscription();
        $subscription->fill($input)->save();

        return $subscription;
    }
}
