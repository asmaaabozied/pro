<?php
/**
 * Order actions reason repository class which handel more of logic actions
 *
 * @author Amk El-Kabbany at 14 July 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Repositories;

use App\Models\OrderActionsReason;
use App\Repositories\BaseRepository;

/**
 * Class OrderActionsReasonRepository
 * @package App\Repositories
 * @version July 14, 2020, 4:49 pm UTC
 *
 * @author Amk El-Kabbany at 14 July 2020
 * @contact alaa@upbeatdigital.team
*/

class OrderActionsReasonRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'type',
        'title_en',
        'active'
    ];

    /**
     * Class constructor
     *
     * @author Amk El-Kabbany at 14 July 2020
     * @contact alaa@upbeatdigital.team
     */
    public function __construct()
    {
        parent::__construct(app());
        $this->fieldSearchable = array_keys(alterLangArrayElements('order_actions_reasons', ['fields' => array_combine($this->fieldSearchable,$this->fieldSearchable)], $key = 'fields')['fields']);
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
        return OrderActionsReason::class;
    }

    /**
     * Create model record
     *
     * @param array $input
     *
     * @return OrderActionsReason
     *
     * @author Amk El-Kabbany at 14 July 2020
     * @contact alaa@upbeatdigital.team
     */
    public function create($input)
    {
        $orderActionsReason = new OrderActionsReason();
        $orderActionsReason->fill($input)->save();

        return $orderActionsReason;
    }

    /**
     * Display the specified order action reasons.
     *
     * @param string $type
     *
     * @author Amk El-Kabbany at 14 July 2020
     * @contact alaa@upbeatdigital.team
     **/
    public function lists($type)
    {
        return OrderActionsReason::where('deleted_at', null)->where('type', $type)->get();
    }
}
