<?php
/**
 * Order actions API controller class which handel more of business actions
 *
 * @author Amk El-Kabbany at 15 July 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Controllers\API;


use App\Core\Controllers\APIs\BaseAPI;
use App\Http\Resources\OrderActionResource;
use App\Models\OrderAction;
use App\Repositories\OrderActionRepository;
use App\Http\Controllers\AppBaseController;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

/**
 * Class OrderActionController
 * @package App\Http\Controllers\API
 *
 * @author Amk El-Kabbany at 15 July 2020
 * @contact alaa@upbeatdigital.team
 */

class OrderActionAPIController extends AppBaseController
{
    /** @var  OrderActionRepository */
    private $orderActionRepository;

    /**
     * Current Logged User Selected Language Prefix
     *
     * @var string
     *
     * @author Amk El-Kabbany at 15 July 2020
     * @contact alaa@upbeatdigital.team
     */
    protected $language;

    public function __construct(OrderActionRepository $orderActionRepo)
    {
        $this->orderActionRepository = $orderActionRepo;
        $this->language = request()->header('Accept-Language');
    }

    /**
     * Cancel Order.
     * POST /order_actions/cancel
     *
     * @return Response
     *
     * @author Amk El-Kabbany at 15 July 2020
     * @contact alaa@upbeatdigital.team
     */
    public function cancelOrder()
    {
        $user = (new UserRepository(app()))->findByToken(request()->bearerToken());
        if($user == null){
            return $this->sendError(trans('user.messages.errors.login'));
        }
        $input = request()->all();

        $validator = Validator::make($input, OrderAction::$rules);

        if($validator->fails()){
            return $this->sendError(BaseAPI::handelValidationErrors($validator->errors()));
        }

        if (! $user->validateOrder($input['order_id'])) {
            return $this->sendError(trans('order.messages.not_found'));
        }

        $action = $this->orderActionRepository->cancelOrder($input);

        if ($action == false) {
            return $this->sendError(trans('orderAction.messages.errors.canceled'));
        }

        return $this->sendResponse(OrderActionResource::toArray($action, $this->language), trans('orderAction.messages.canceled'));
    }

    /**
     * Return Order.
     * POST /order_actions/return
     *
     * @return Response
     *
     * @author Amk El-Kabbany at 15 July 2020
     * @contact alaa@upbeatdigital.team
     */
    public function returnOrder()
    {
        $user = (new UserRepository(app()))->findByToken(request()->bearerToken());
        if($user == null){
            return $this->sendError(trans('user.messages.errors.login'));
        }
        $input = request()->all();

        $validator = Validator::make($input, OrderAction::$rules);

        if($validator->fails()){
            return $this->sendError(BaseAPI::handelValidationErrors($validator->errors()));
        }

        if (! $user->validateOrder($input['order_id'])) {
            return $this->sendError(trans('order.messages.not_found'));
        }

        $action = $this->orderActionRepository->returnOrder($input);

        if ($action == false) {
            return $this->sendError(trans('orderAction.messages.errors.returned'));
        }

        return $this->sendResponse(OrderActionResource::toArray($action, $this->language), trans('orderAction.messages.returned'));
    }

    /**
     * Report product.
     * POST /order_actions/report-product
     *
     * @return Response
     *
     * @author Amk El-Kabbany at 15 July 2020
     * @contact alaa@upbeatdigital.team
     */
    public function reportProduct()
    {
        $user = (new UserRepository(app()))->findByToken(request()->bearerToken());
        if($user == null){
            return $this->sendError(trans('user.messages.errors.login'));
        }
        $input = request()->all();

        $validator = Validator::make($input, OrderAction::$productRules);

        if($validator->fails()){
            return $this->sendError(BaseAPI::handelValidationErrors($validator->errors()));
        }

        $action = $this->orderActionRepository->reportProduct($input);

        if ($action == false) {
            return $this->sendError(trans('orderAction.messages.errors.report'));
        }

        return $this->sendResponse([], trans('orderAction.messages.report'));
    }
}
