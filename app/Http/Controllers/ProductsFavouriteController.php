<?php
/**
 * Product favourites and reviews controller class which handel more of business actions
 *
 * @author Amk El-Kabbany at 27 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Controllers;

use App\Core\Controllers\CustomizedAppBaseController;
use App\DataTables\ProductsFavouriteDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateProductsFavouriteRequest;
use App\Http\Requests\UpdateProductsFavouriteRequest;
use App\Repositories\ProductRepository;
use App\Repositories\ProductsFavouriteRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Laracasts\Flash\Flash;

class ProductsFavouriteController extends CustomizedAppBaseController
{
    /** @var  ProductsFavouriteRepository */
    private $productsFavouriteRepository;

    /**
     * Current Logged User Selected Language Prefix
     *
     * @var string
     *
     * @author Amk El-Kabbany at 27 May 2020
     * @contact alaa@upbeatdigital.team
     */
    protected $language;

    public function __construct(ProductsFavouriteRepository $productsFavouriteRepo)
    {
        parent::__construct();
        $this->productsFavouriteRepository = $productsFavouriteRepo;
        $this->language = Config::get('languages')[Request::ip()]['admin'];
    }

    /**
     * Display a listing of the ProductsFavourite.
     *
     * @param ProductsFavouriteDataTable $productsFavouriteDataTable
     * @return Response
     */
    public function index(ProductsFavouriteDataTable $productsFavouriteDataTable)
    {
        return $productsFavouriteDataTable->render('products_favourites.index');
    }

    /**
     * Show the form for creating a new ProductsFavourite.
     *
     * @return Response
     */
    public function create()
    {
        $products = (new ProductRepository())->pluck($this->language);
        $users = (new UserRepository(app()))->pluck();

        return view('products_favourites.create', compact('products', 'users'));

    }

    /**
     * Store a newly created ProductsFavourite in storage.
     *
     * @param CreateProductsFavouriteRequest $request
     *
     * @return Response
     */
    public function store(CreateProductsFavouriteRequest $request)
    {
        $input = $request->all();

        $productsFavourite = $this->productsFavouriteRepository->create($input);

        Flash::success(trans('productsFavourite.messages.created'));

        return redirect(route('productsFavourites.index'));
    }

    /**
     * Display the specified ProductsFavourite.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $productsFavourite = $this->productsFavouriteRepository->find($id);

        if (empty($productsFavourite)) {
            Flash::error(trans('productsFavourite.messages.not_found'));

            return redirect(route('productsFavourites.index'));
        }

        return view('products_favourites.show')->with('productsFavourite', $productsFavourite);
    }

    /**
     * Show the form for editing the specified ProductsFavourite.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $productsFavourite = $this->productsFavouriteRepository->find($id);

        if (empty($productsFavourite)) {
            Flash::error(trans('productsFavourites.messages.not_found'));

            return redirect(route('productsFavourites.index'));
        }

        $products = (new ProductRepository())->pluck($this->language);
        $users = (new UserRepository(app()))->pluck();

        return view('products_favourites.edit', compact('products', 'users', 'productsFavourite'));
    }

    /**
     * Update the specified ProductsFavourite in storage.
     *
     * @param  int              $id
     * @param UpdateProductsFavouriteRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProductsFavouriteRequest $request)
    {
        $productsFavourite = $this->productsFavouriteRepository->find($id);

        if (empty($productsFavourite)) {
            Flash::error(trans('productsFavourite.messages.not_found'));

            return redirect(route('productsFavourites.index'));
        }

        $productsFavourite = $this->productsFavouriteRepository->update($request->all(), $id);

        Flash::success(trans('productsFavourite.messages.updated'));

        return redirect(route('productsFavourites.index'));
    }

    /**
     * Remove the specified ProductsFavourite from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $productsFavourite = $this->productsFavouriteRepository->find($id);

        if (empty($productsFavourite)) {
            Flash::error(trans('productsFavourite.messages.not_found'));

            return redirect(route('productsFavourites.index'));
        }

        $flag = $this->productsFavouriteRepository->delete($id);

        if($flag != false){
            Flash::success(trans('productsFavourite.messages.deleted'));
        }

        return redirect(route('productsFavourites.index'));
    }
}
