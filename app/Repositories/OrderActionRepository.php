<?php
/**
 * Order actions repository class which handel more of logic actions
 *
 * @author Amk El-Kabbany at 15 July 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Repositories;

use App\Models\Order;
use App\Models\OrderAction;
use App\Repositories\BaseRepository;

/**
 * Class OrderActionRepository
 * @package App\Repositories
 * @version July 14, 2020, 8:51 pm UTC
 *
 * @author Amk El-Kabbany at 15 July 2020
 * @contact alaa@upbeatdigital.team
*/

class OrderActionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'order_id',
        'reason_id',
        'detail',
        'status'
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
        return OrderAction::class;
    }

    /**
     * Cancel the specified order.
     *
     * @param array $data
     * @return OrderAction|boolean
     *
     * @author Amk El-Kabbany at 15 July 2020
     * @contact alaa@upbeatdigital.team
     **/
    public function cancelOrder($data)
    {
        $order = Order::find($data['order_id']);
        if(! in_array($order->status, trans('order.order_status_group.cancel'))){
            return false;
        }
        $data['type'] = 'order';
        $action = new OrderAction();
        $action->fill($data)->save();
        $order->status = 'cancelled';
        $order->save();
        return $action;
    }

    /**
     * Return the specified order.
     *
     * @param array $data
     * @return OrderAction|boolean
     *
     * @author Amk El-Kabbany at 15 July 2020
     * @contact alaa@upbeatdigital.team
     **/
    public function returnOrder($data)
    {
        $data['type'] = 'order';
        $action = new OrderAction();
        $action->fill($data)->save();
        return $action;
    }

    /**
     * Report the specified product.
     *
     * @param array $data
     * @return OrderAction|boolean
     *
     * @author Amk El-Kabbany at 15 July 2020
     * @contact alaa@upbeatdigital.team
     **/
    public function reportProduct($data)
    {
        $data['type'] = 'product';
        $action = new OrderAction();
        $action->fill($data)->save();
        return $action;
    }
}
