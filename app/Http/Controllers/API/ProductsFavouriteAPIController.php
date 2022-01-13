<?php
/**
 * Product Favourites API controller class which handel more of business actions
 *
 * @author Amk El-Kabbany at 27 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Controllers\API;

use App\Core\Controllers\APIs\BaseAPI;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductsFavouriteResource;
use App\Models\ProductsFavourite;
use App\Repositories\ProductsFavouriteRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

/**
 * Class ProductsFavouriteController
 * @package App\Http\Controllers\API
 *
 * @author Amk El-Kabbany at 27 May 2020
 * @contact alaa@upbeatdigital.team
 */

class ProductsFavouriteAPIController extends AppBaseController
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
        $this->productsFavouriteRepository = $productsFavouriteRepo;
        $this->language = request()->header('Accept-Language');
    }

    /**
     * Display a listing of the ProductsFavourite.
     * GET|HEAD /productsFavourites
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $productsFavourites = $this->productsFavouriteRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(ProductsFavouriteResource::toArray($productsFavourites, $this->language), trans('productsFavourite.messages.retrieved'));
    }

    /**
     * Display a listing of the new Products.
     * GET|HEAD /productsFavourites/lists
     *
     * @return Response
     */
    public function lists()
    {
        $user = (new UserRepository(app()))->findByToken(request()->bearerToken());
        if($user == null){
            return $this->sendError(trans('user.messages.errors.login'));
        }

        $products = $this->productsFavouriteRepository->lists($user->id);

        return $this->sendResponse(ProductResource::toArray($products, $this->language), trans('product.messages.retrieved'));
    }

    /**
     * Display a listing of the new Products.
     * GET|HEAD /productsFavourites/favourite/{product_id}
     *
     * @param int $product_id
     * @return Response
     */
    public function favourite($product_id)
    {
        $user = (new UserRepository(app()))->findByToken(request()->bearerToken());
        if($user == null){
            return $this->sendError(trans('user.messages.errors.login'));
        }

        $input = [
            'product_id' => $product_id,
            'user_id'    => $user->id,
        ];

        $validator = Validator::make($input, ProductsFavourite::$rules);

        if($validator->fails()){
            return $this->sendError(BaseAPI::handelValidationErrors($validator->errors()));
        }

        $this->productsFavouriteRepository->favourite($product_id, $user->id);

        return $this->sendResponse([], trans('productsFavourite.messages.favourite'));
    }

    /**
     * Display a listing of the new Products.
     * GET|HEAD /products-favourites/un-favourite/{product_id}
     *
     * @param int $product_id
     * @return Response
     */
    public function unFavourite($product_id)
    {
        $user = (new UserRepository(app()))->findByToken(request()->bearerToken());
        if($user == null){
            return $this->sendError(trans('user.messages.errors.login'));
        }

        $this->productsFavouriteRepository->unFavourite($product_id, $user->id);

        return $this->sendResponse([], trans('productsFavourite.messages.un-favourite'));
    }

    /**
     * Retrieve a pluck of the Brand.
     * GET|HEAD /brands
     *
     * @param  integer $product_id
     * @param  string $attribute
     * @return Response
     *
     * @author Amk El-Kabbany at 27 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function pluck($product_id, $attribute = 'user')
    {
        $products = $this->productsFavouriteRepository->pluck($product_id, $attribute);
        return $this->sendResponse($products, trans('productsFavourite.messages.retrieved'));
    }

    /**
     * Store a newly created ProductsFavourite in storage.
     * POST /productsFavourites
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {   $input = $request->all();

        $validator = Validator::make($input, ProductsFavourite::$rules);

        if($validator->fails()){
            return $this->sendError(BaseAPI::handelValidationErrors($validator->errors()));
        }

        $productsFavourite = $this->productsFavouriteRepository->create($input);

        if (! $productsFavourite) {
            return $this->sendError(BaseAPI::handelFlashErrors(trans('productsFavourite.messages.errors.created')));
        }

        return $this->sendResponse(ProductsFavouriteResource::toArray($productsFavourite, $this->language), trans('productsFavourite.messages.created'));
    }

    /**
     * Display the specified ProductsFavourite.
     * GET|HEAD /productsFavourites/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ProductsFavourite $productsFavourite */
        $productsFavourite = $this->productsFavouriteRepository->find($id);

        if (empty($productsFavourite)) {
            return $this->sendError(trans('productsFavourite.messages.not_found'));
        }

        return $this->sendResponse(ProductsFavouriteResource::toArray($productsFavourite, $this->language), trans('productsFavourite.messages.retrieved'));
    }

    /**
     * Update the specified ProductsFavourite in storage.
     * PUT/PATCH /productsFavourites/{id}
     *
     * @param int $id
     * @param Request $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, ProductsFavourite::$rules);

        if($validator->fails()){
            return $this->sendError(BaseAPI::handelValidationErrors($validator->errors()));
        }

        if (empty($this->productsFavouriteRepository->find($id))) {
            return $this->sendError(trans('productsFavourite.messages.not_found'));
        }

        $productsFavourite = $this->productsFavouriteRepository->update($input, $id);

        if (! $productsFavourite) {
            return $this->sendError(BaseAPI::handelFlashErrors(trans('productsFavourite.messages.errors.updated')));
        }

        return $this->sendResponse(ProductsFavouriteResource::toArray($productsFavourite, $this->language), trans('productsFavourite.messages.updated'));
    }

    /**
     * Remove the specified ProductsFavourite from storage.
     * DELETE /productsFavourites/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ProductsFavourite $productsFavourite */
        $productsFavourite = $this->productsFavouriteRepository->find($id);

        if (empty($productsFavourite)) {
            return $this->sendError(trans('productsFavourite.messages.not_found'));
        }

        $productsFavourite->delete();

        return $this->sendSuccess(trans('productsFavourite.messages.deleted'));
    }
}
