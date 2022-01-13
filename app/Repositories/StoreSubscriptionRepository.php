<?php
/**
 * Store Subscription repository class which handel more of logic actions
 *
 * @author Amk El-Kabbany at 12 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Repositories;

use App\Models\StoreSubscription;
use App\Models\Subscription;
use App\Repositories\BaseRepository;

/**
 * Class StoreSubscriptionRepository
 * @package App\Repositories
 * @version May 12, 2020, 6:50 pm UTC
 *
 * @author Amk El-Kabbany at 12 May 2020
 * @contact alaa@upbeatdigital.team
*/

class StoreSubscriptionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'subscription_id',
        'store_id',
        'actual_price',
        'price',
        'duration',
        'expire_date',
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
        $this->fieldSearchable = array_keys(alterLangArrayElements('store_subscriptions', ['fields' => array_combine($this->fieldSearchable,$this->fieldSearchable)], $key = 'fields')['fields']);
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
        return StoreSubscription::class;
    }

    /**
     * Create model record
     *
     * @param array $input
     *
     * @return StoreSubscription
     *
     * @author Amk El-Kabbany at 12 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function create($input)
    {
        $storeSubscription = new StoreSubscription();
        $subscription = Subscription::find($input['subscription_id']);
        $input['actual_price'] = $subscription->price;
        $input['duration'] = $subscription->duration;
        $duration = '+'. $input['duration'] . ' months';
        $input['expire_date'] = date('Y-m-d', strtotime($duration, strtotime(date('Y-m-d'))));
        $input['active'] = true;
        $storeSubscription->fill($input)->save();

        return $storeSubscription;
    }
}
