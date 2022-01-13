<?php
/**
 * Brand API controller class which handel more of business actions
 *
 * @author Amk El-Kabbany at 5 July 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Controllers\API;

use App\Core\Controllers\APIs\BaseAPI;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Models\CartItem;
use App\Repositories\CartRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

/**
 * Class CartController
 * @package App\Http\Controllers\API
 *
 * @author Amk El-Kabbany at 5 July 2020
 * @contact alaa@upbeatdigital.team
 */

class CartAPIController extends AppBaseController
{
    /** @var  CartRepository */
    private $cartRepository;

    /**
     * Current Logged User Selected Language Prefix
     *
     * @var string
     *
     * @author Amk El-Kabbany at 5 July 2020
     * @contact alaa@upbeatdigital.team
     */
    protected $language;

    public function __construct(CartRepository $cartRepo)
    {
        $this->cartRepository = $cartRepo;
        $this->language = request()->header('Accept-Language');
    }

    /**
     * Display a listing of the Cart.
     * GET|HEAD /carts
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $carts = $this->cartRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(CartResource::toArray($carts, $this->language), trans('cart.messages.retrieved'));
    }

    /**
     * Display active cart for the specified logged user.
     * GET|HEAD /cart
     *
     * @return Response
     */
    public function lists()
    {
        $user = (new UserRepository(app()))->findByToken(request()->bearerToken());
        if($user == null){
            return $this->sendError(trans('user.messages.errors.login'));
        }

        /** @var Cart $productRating */
        $cart = $this->cartRepository->lists($user->id);

        return $this->sendResponse(CartResource::toArray($cart, $this->language), trans('cart.messages.retrieved'));
    }

    /**
     * Add new item to active cart for the specified logged user.
     * POST /cart/add-item
     *
     * @return Response
     */
    public function addCartItem()
    {
        $input = request()->input();
        $validator = Validator::make($input, CartItem::$productRules);

        if($validator->fails()){
            return $this->sendError(BaseAPI::handelValidationErrors($validator->errors()));
        }

        $user = (new UserRepository(app()))->findByToken(request()->bearerToken());
        if($user == null){
            return $this->sendError(trans('user.messages.errors.login'));
        }

        /** @var Cart $cart */
        $cart = $this->cartRepository->addCartItem($user->id, $input);

        if (empty($cart)) {
            return $this->sendError(trans('cart.messages.not_found'));
        }

        if ($cart == 'quantity') {
            return $this->sendError(trans('cart.messages.errors.quantity'));
        }

        return $this->sendResponse(CartResource::toArray($cart, $this->language), trans('cart.messages.items.created'));
    }

    /**
     * Add new item to active cart for the specified logged user.
     * GET /cart/remove-item/{$item_id}
     *
     * @param int $item_id
     * @return Response
     */
    public function removeCartItem($item_id)
    {
        $user = (new UserRepository(app()))->findByToken(request()->bearerToken());
        if($user == null){
            return $this->sendError(trans('user.messages.errors.login'));
        }

        /** @var CartItem $cartItem */
        $cartItem = $this->cartRepository->removeCartItem($item_id);

        if ($cartItem == false) {
            return $this->sendError(trans('cart.messages.items.not_found'));
        }
        
        $cart = $this->cartRepository->lists($user->id);
        return $this->sendResponse(CartResource::toArray($cart, $this->language), trans('cart.messages.items.created'));

        //return $this->sendSuccess(trans('cart.messages.items.deleted'));
    }

    /**
     * Update item quantity in active cart for the specified logged user.
     * GET /cart/update-quantity
     *
     * @return Response
     */
    public function updateCartItemQuantity()
    {
        $user = (new UserRepository(app()))->findByToken(request()->bearerToken());
        if($user == null){
            return $this->sendError(trans('user.messages.errors.login'));
        }

        $input = request()->input();

        $validator = Validator::make($input, CartItem::$productRules);

        if($validator->fails()){
            return $this->sendError(BaseAPI::handelValidationErrors($validator->errors()));
        }

        $input['user_id'] = $user->id;

        /** @var CartItem $cartItem */
        $cart = $this->cartRepository->updateCartItemQuantity($input);

        if ($cart == false) {
            return $this->sendError(trans('cart.messages.items.not_found'));
        }

        if ($cart == 'quantity') {
            return $this->sendError(trans('cart.messages.errors.quantity'));
        }

        return $this->sendResponse(CartResource::toArray($cart, $this->language), trans('cart.messages.items.updated'));
    }
}
