<?php
/**
 * Product API controller class which handel more of business actions
 *
 * @author Amk El-Kabbany at 21 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Controllers\API;

use App\Core\Controllers\APIs\BaseAPI;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

/**
 * Class ProductController
 * @package App\Http\Controllers\API
 *
 * @author Amk El-Kabbany at 21 May 2020
 * @contact alaa@upbeatdigital.team
 */

class ProductAPIController extends AppBaseController
{
    /** @var  ProductRepository */
    private $productRepository;

    /**
     * Current Logged User Selected Language Prefix
     *
     * @var string
     *
     * @author Amk El-Kabbany at 18 May 2020
     * @contact alaa@upbeatdigital.team
     */
    protected $language;

    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepository = $productRepo;
        $this->language = request()->header('Accept-Language');
    }

    /**
     * Display a listing of the Product.
     * GET|HEAD /products
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $paginate = 8;
        if(!empty($request->input('paginate')) && intval($request->input('paginate') > 0)) {
            $paginate = intval($request->input('paginate'));
        }

        $products = $this->productRepository->lists($paginate);
        $data = Product::hydrate($products['data']);
        $data = ProductResource::toArray($data, $this->language);
        $products['data'] = $data;
        return $this->sendResponse($products, trans('product.messages.retrieved'));
    }

    /**
     * Display a listing of the featured Products.
     * GET|HEAD /products/related-products/lists/{id}
     *
     * @return Response
     */
    public function featured()
    {
        $products = $this->productRepository->featured();

        return $this->sendResponse(ProductResource::toArray($products, $this->language), trans('product.messages.retrieved'));
    }

    /**
     * Display a listing of the featured Products.
     * GET|HEAD /products/related-products/lists/{id}
     *
     * @return Response
     */
    public function in_slider($category_id)
    {
        $products = $this->productRepository->in_slider($category_id);

        return $this->sendResponse(ProductResource::toArray($products, $this->language), trans('product.messages.retrieved'));
    }

    /**
     * Display a listing of the related Products.
     * GET|HEAD /products/related-products/lists/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function relatedProducts($id)
    {
        $products = $this->productRepository->relatedProducts($id);

        return $this->sendResponse(ProductResource::toArray($products, $this->language), trans('product.messages.retrieved'));
    }

    /**
     * Display a listing of the discount Products.
     * GET|HEAD /products/discount/lists
     *
     * @return Response
     */
    public function discounts()
    {
        $products = $this->productRepository->discounts();

        return $this->sendResponse(ProductResource::toArray($products, $this->language), trans('product.messages.retrieved'));
    }

    /**
     * Display a listing of the new Products.
     * GET|HEAD /products/latest/lists/{$store_id?}
     *
     * @param int $store_id
     * @return Response
     */
    public function latest($store_id = null)
    {
        $products = $this->productRepository->latest(intval($store_id));

        return $this->sendResponse(ProductResource::toArray($products, $this->language), trans('product.messages.retrieved'));
    }

    /**
     * Display Products according to user filter.
     * POST /products/filter
     *
     * @param Request $request
     * @return Response
     */
    public function filter(Request $request)
    {
        $input = $request->input();
        $validator = Validator::make($input, Product::$filterRules);

        if($validator->fails()){
            return $this->sendError(BaseAPI::handelValidationErrors($validator->errors()));
        }

        $products = $this->productRepository->filter($input);
        $data = Product::hydrate($products['data']);
        $data = ProductResource::toArray($data, $this->language);
        $products['data'] = $data;

        return $this->sendResponse($products, trans('product.messages.retrieved'));
    }

    /**
     * Fetch requested Products according to it's ids.
     * POST /products/fetch-by-ids
     *
     * @param Request $request
     * @return Response
     */
    public function fetchByIds(Request $request)
    {
        $input = $request->input();
        $validator = Validator::make($input, Product::$fetchByIdsRules);

        if($validator->fails()){
            return $this->sendError(BaseAPI::handelValidationErrors($validator->errors()));
        }

        $products = $this->productRepository->fetchByIds($input['products']);

        return $this->sendResponse(ProductResource::toLiteArray($products, $this->language), trans('product.messages.retrieved'));
    }

    /**
     * Retrieve a pluck of the Brand.
     * GET|HEAD /brands
     *
     * @param  integer $product_id
     * @return Response
     *
     * @author Amk El-Kabbany at 17 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function pluck($product_id)
    {
        $products = $this->productRepository->pluck($this->language, $product_id);
        return $this->sendResponse($products, trans('product.messages.retrieved'));
    }

    /**
     * Store a newly created Product in storage.
     * POST /products
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $input = ProductResource::casts($request->all(), $this->language);

        $validator = Validator::make($input, Product::$rules);

        if($validator->fails()){
            return $this->sendError(BaseAPI::handelValidationErrors($validator->errors()));
        }

        $product = $this->productRepository->create($input);

        if (! $product) {
            return $this->sendError(BaseAPI::handelFlashErrors(trans('product.messages.errors.created')));
        }

        return $this->sendResponse(ProductResource::toArray($product, $this->language), trans('product.messages.created'));
    }

    /**
     * Display the specified Product.
     * GET|HEAD /products/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Product $product */
        $product = $this->productRepository->find($id);

        if (empty($product)) {
            return $this->sendError(trans('product.messages.not_found'));
        }

        return $this->sendResponse(ProductResource::toArray($product, $this->language, request()->bearerToken()), trans('product.messages.retrieved'));
    }

    /**
     * Update the specified Product in storage.
     * PUT/PATCH /products/{id}
     *
     * @param int $id
     * @param Request $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $input = ProductResource::casts($request->all(), $this->language, $id);

        $validator = Validator::make($input, Product::$rules);

        if($validator->fails()){
            return $this->sendError(BaseAPI::handelValidationErrors($validator->errors()));
        }

        if (empty($this->productRepository->find($id))) {
            return $this->sendError(trans('product.messages.not_found'));
        }

        $product = $this->productRepository->update($input, $id);

        if (! $product) {
            return $this->sendError(BaseAPI::handelFlashErrors(trans('product.messages.errors.updated')));
        }

        return $this->sendResponse(ProductResource::toArray($product, $this->language), trans('product.messages.updated'));
    }

    /**
     * Remove the specified Product from storage.
     * DELETE /products/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Product $product */
        $product = $this->productRepository->find($id);

        if (empty($product)) {
            return $this->sendError(trans('product.messages.not_found'));
        }

        $product->delete();

        return $this->sendSuccess(trans('product.messages.deleted'));
    }
}
