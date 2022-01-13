<?php
/**
 * Order actions reason API controller class which handel more of business actions
 *
 * @author Amk El-Kabbany at 14 July 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Controllers\API;

use App\Http\Resources\OrderActionsReasonResource;
use App\Models\OrderActionsReason;
use App\Repositories\OrderActionsReasonRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Response;

/**
 * Class OrderActionsReasonController
 * @package App\Http\Controllers\API
 *
 * @author Amk El-Kabbany at 14 July 2020
 * @contact alaa@upbeatdigital.team
 */

class OrderActionsReasonAPIController extends AppBaseController
{
    /** @var  OrderActionsReasonRepository */
    private $orderActionsReasonRepository;

    /**
     * Current Logged User Selected Language Prefix
     *
     * @var string
     *
     * @author Amk El-Kabbany at 14 July 2020
     * @contact alaa@upbeatdigital.team
     */
    protected $language;

    public function __construct(OrderActionsReasonRepository $orderActionsReasonRepo)
    {
        $this->orderActionsReasonRepository = $orderActionsReasonRepo;
        $this->language = request()->header('Accept-Language');
    }

    /**
     * Display the specified order action reasons.
     * GET|HEAD /order-action-reasons/{type}
     *
     * @param string $type
     * @return Response
     *
     * @author Amk El-Kabbany at 14 July 2020
     * @contact alaa@upbeatdigital.team
     */
    public function lists($type)
    {
        /** @var OrderActionsReason $orderActionsReason */
        $orderActionsReason = $this->orderActionsReasonRepository->lists($type);

        return $this->sendResponse(OrderActionsReasonResource::toArray($orderActionsReason, $this->language), trans('orderActionsReason.messages.retrieved'));
    }
}
