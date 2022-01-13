<?php
/**
 * Product ratings and reviews controller class which handel more of business actions
 *
 * @author Amk El-Kabbany at 27 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Controllers;

use App\Core\Controllers\CustomizedAppBaseController;
use App\DataTables\ProductRatingDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateProductRatingRequest;
use App\Http\Requests\UpdateProductRatingRequest;
use App\Repositories\ProductRatingRepository;
use App\Repositories\ProductRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Laracasts\Flash\Flash;

class ProductRatingController extends CustomizedAppBaseController 
{
    /** @var  ProductRatingRepository */
    private $productRatingRepository;

    /**
     * Current Logged User Selected Language Prefix
     *
     * @var string
     *
     * @author Amk El-Kabbany at 27 May 2020
     * @contact alaa@upbeatdigital.team
     */
    protected $language;

    public function __construct(ProductRatingRepository $productRatingRepo)
    {
        parent::__construct();
        $this->productRatingRepository = $productRatingRepo;
        $this->language = Config::get('languages')[Request::ip()]['admin'];
    }

    /**
     * Display a listing of the ProductRating.
     *
     * @param ProductRatingDataTable $productRatingDataTable
     * @return Response
     */
    public function index(ProductRatingDataTable $productRatingDataTable)
    {
        return $productRatingDataTable->render('product_ratings.index');
    }

    /**
     * Show the form for creating a new ProductRating.
     *
     * @return Response
     */
    public function create()
    {
        $products = (new ProductRepository())->pluck($this->language);
        $users = (new UserRepository(app()))->pluck($this->language);

        return view('product_ratings.create', compact('products', 'users'));
    }

    /**
     * Store a newly created ProductRating in storage.
     *
     * @param CreateProductRatingRequest $request
     *
     * @return Response
     */
    public function store(CreateProductRatingRequest $request)
    {
        $input = $request->all();

        $productRating = $this->productRatingRepository->create($input);

        Flash::success(trans('productRating.messages.created'));

        return redirect(route('productRatings.index'));
    }

    /**
     * Display the specified ProductRating.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $productRating = $this->productRatingRepository->find($id);

        if (empty($productRating)) {
            Flash::error(trans('productRating.messages.not_found'));

            return redirect(route('productRatings.index'));
        }

        return view('product_ratings.show')->with('productRating', $productRating);
    }

    /**
     * Show the form for editing the specified ProductRating.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $productRating = $this->productRatingRepository->find($id);

        if (empty($productRating)) {
            Flash::error(trans('productRating.messages.not_found'));

            return redirect(route('productRatings.index'));
        }
        
        $products = (new ProductRepository())->pluck($this->language);
        $users = (new UserRepository(app()))->pluck($this->language);

        return view('product_ratings.edit', compact('products', 'users', 'productRating'));

    }

    /**
     * Update the specified ProductRating in storage.
     *
     * @param  int              $id
     * @param UpdateProductRatingRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProductRatingRequest $request)
    {
        $productRating = $this->productRatingRepository->find($id);

        if (empty($productRating)) {
            Flash::error(trans('productRating.messages.not_found'));

            return redirect(route('productRatings.index'));
        }

        $productRating = $this->productRatingRepository->update($request->all(), $id);

        Flash::success(trans('productRating.messages.updated'));

        return redirect(route('productRatings.index'));
    }

    /**
     * Remove the specified ProductRating from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $productRating = $this->productRatingRepository->find($id);

        if (empty($productRating)) {
            Flash::error(trans('productRating.messages.not_found'));

            return redirect(route('productRatings.index'));
        }

        $flag = $this->productRatingRepository->delete($id);

        if($flag != false){
            Flash::success(trans('productRating.messages.deleted'));
        }
        
        return redirect(route('productRatings.index'));
    }
}
