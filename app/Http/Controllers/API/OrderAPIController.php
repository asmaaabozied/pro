<?php
/**
 * Order API controller class which handel more of business actions
 *
 * @author Amk El-Kabbany at 12 July 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Controllers\API;

use App\Core\Controllers\APIs\BaseAPI;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Repositories\CartRepository;
use App\Repositories\OrderRepository;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

/**
 * Class OrderController
 * @package App\Http\Controllers\API
 *
 * @author Amk El-Kabbany at 12 July 2020
 * @contact alaa@upbeatdigital.team
 */

class OrderAPIController extends AppBaseController
{
    /** @var  OrderRepository */
    private $orderRepository;

    /**
     * Current Logged User Selected Language Prefix
     *
     * @var string
     *
     * @author Amk El-Kabbany at 12 July 2020
     * @contact alaa@upbeatdigital.team
     */
    protected $language;

    public function __construct(OrderRepository $orderRepo)
    {
        $this->orderRepository = $orderRepo;
        $this->language = request()->header('Accept-Language');
    }

    /**
     * Display a listing of the Order.
     * GET|HEAD /orders
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $orders = $this->orderRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(OrderResource::toArray($orders, $this->language), trans('order.messages.retrieved'));
    }

    /**
     * Display the specified logged user orders.
     * GET|HEAD /orders
     *
     * @return Response
     *
     * @author Amk El-Kabbany at 12 July 2020
     * @contact alaa@upbeatdigital.team
     */
    public function lists()
    {
        $user = (new UserRepository(app()))->findByToken(request()->bearerToken());
        if($user == null){
            return $this->sendError(trans('user.messages.errors.login'));
        }

        $input = request()->all();
        $input['user_id'] = $user->id;

        /** @var array $order */
        $orders = $this->orderRepository->lists($input);

        return $this->sendResponse(OrderResource::toArray($orders, $this->language), trans('order.messages.retrieved'));
    }

    /**
     * Store a newly created Order in storage.
     * POST /orders
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $user = (new UserRepository(app()))->findByToken(request()->bearerToken());
        if($user == null){
            return $this->sendError(trans('user.messages.errors.login'));
        }

        $activeCart = (new CartRepository(app()))->lists($user->id);
        if(count($activeCart->items) == 0){
            return $this->sendError(trans('cart.messages.errors.empty'));
        }

        $input = $request->all();
        $input['user_id'] = $user->id;
        $input['active_cart'] = $activeCart;

        $validator = Validator::make($input, Order::$rules);

        if($validator->fails()){
            return $this->sendError(BaseAPI::handelValidationErrors($validator->errors()));
        }

        $order = $this->orderRepository->create($input);

        if (! $order) {
            return $this->sendError(BaseAPI::handelFlashErrors(trans('order.messages.errors.created')));
        }

        return $this->sendResponse(OrderResource::toArray($order, $this->language), trans('order.messages.created'));
    }

    /**
     * Display the specified Order.
     * GET|HEAD /orders/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $user = (new UserRepository(app()))->findByToken(request()->bearerToken());
        if($user == null){
            return $this->sendError(trans('user.messages.errors.login'));
        }

        if (! $user->validateOrder($id)) {
            return $this->sendError(trans('order.messages.not_found'));
        }

        /** @var Order $order */
        $order = $this->orderRepository->find($id);

        if (empty($order)) {
            return $this->sendError(trans('order.messages.not_found'));
        }

        return $this->sendResponse(OrderResource::toArray($order, $this->language), trans('order.messages.retrieved'));
    }
}
