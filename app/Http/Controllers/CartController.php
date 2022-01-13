<?php
/**
 * Cart controller class which handel more of business actions
 *
 * @author Amk El-Kabbany at 31 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Controllers;

use App\Core\Controllers\CustomizedAppBaseController;
use App\DataTables\CartDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Models\Cart;
use App\Repositories\CartRepository;
use App\Repositories\VoucherRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Laracasts\Flash\Flash;

class CartController extends CustomizedAppBaseController
{
    /** @var  CartRepository */
    private $cartRepository;

    /**
     * Current Logged User Selected Language Prefix
     *
     * @var string
     *
     * @author Amk El-Kabbany at 31 May 2020
     * @contact alaa@upbeatdigital.team
     */
    protected $language;

    public function __construct(CartRepository $cartRepo)
    {
        parent::__construct();
        $this->cartRepository = $cartRepo;
        $this->language = Config::get('languages')[Request::ip()]['admin'];
    }

    /**
     * Display a listing of the Cart.
     *
     * @param CartDataTable $cartDataTable
     * @return Response
     */
    public function index(CartDataTable $cartDataTable)
    {
        return $cartDataTable->render('carts.index');
    }

    /**
     * Show the form for creating a new Cart.
     *
     * @return Response
     */
    public function create()
    {
        $users = (new UserRepository(app()))->pluck();
        $coupons = (new VoucherRepository())->pluck($this->language, 'code');

        return view('carts.create', compact('users', 'coupons'));
    }

    /**
     * Store a newly created Cart in storage.
     *
     * @param CreateCartRequest $request
     *
     * @return Response
     */
    public function store(CreateCartRequest $request)
    {
        $input = $request->all();

        $cart = $this->cartRepository->create($input);

        Flash::success(trans('cart.messages.created'));

        return redirect(route('carts.index'));
    }

    /**
     * Display the specified Cart.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $cart = $this->cartRepository->find($id);

        if (empty($cart)) {
            Flash::error(trans('cart.messages.not_found'));

            return redirect(route('carts.index'));
        }

        $users = (new UserRepository(app()))->pluck();
        $coupons = (new VoucherRepository())->pluck($this->language, 'code');

        return view('carts.show', compact('cart', 'users', 'coupons'));
    }

    /**
     * Show the form for editing the specified Cart.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $cart = $this->cartRepository->find($id);

        if (empty($cart)) {
            Flash::error(trans('cart.messages.not_found'));

            return redirect(route('carts.index'));
        }

        $users = (new UserRepository(app()))->pluck();
        $coupons = (new VoucherRepository())->pluck($this->language, 'code');

        return view('carts.edit', compact('cart', 'users', 'coupons'));
    }

    /**
     * Update the specified Cart in storage.
     *
     * @param  int              $id
     * @param UpdateCartRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCartRequest $request)
    {
        $cart = $this->cartRepository->find($id);

        if (empty($cart)) {
            Flash::error(trans('cart.messages.not_found'));

            return redirect(route('carts.index'));
        }

        $cart = $this->cartRepository->update($request->all(), $id);

        Flash::success(trans('cart.messages.updated'));

        return redirect(route('carts.index'));
    }

    /**
     * Remove the specified Cart from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $cart = $this->cartRepository->find($id);

        if (empty($cart)) {
            Flash::error(trans('cart.messages.not_found'));

            return redirect(route('carts.index'));
        }

        $flag = $this->cartRepository->delete($id);

        if($flag){
            Flash::success(trans('cart.messages.deleted'));
        }

        return redirect(route('carts.index'));
    }

    /**
     * <Ajax POST Action -.deleteCartItem js/script.blade.php->
     * Route action delete selected cart item
     *
     * @return array
     *
     * @author Amk El-Kabbany at 1 June 2020
     * @contact alaa@upbeatdigital.team
     */
    public function removeCartItem() {
        $id = $_POST['id'];
        $this->cartRepository->removeItem($id);
        $sum = (Cart::find($_POST['cart_id']))->total();
        exit($sum);
    }
}