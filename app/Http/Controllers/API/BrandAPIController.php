<?php
/**
 * Brand API controller class which handel more of business actions
 *
 * @author Amk El-Kabbany at 12 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Controllers\API;

use App\Core\Controllers\APIs\BaseAPI;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\BrandResource;
use App\Models\Brand;
use App\Repositories\BrandRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

/**
 * Class BrandController
 * @package App\Http\Controllers\API
 *
 * @author Amk El-Kabbany at 12 May 2020
 * @contact alaa@upbeatdigital.team
 */

class BrandAPIController extends AppBaseController
{
    /** @var  BrandRepository */
    private $brandRepository;

    /**
     * Current Logged User Selected Language Prefix
     *
     * @var string
     *
     * @author Amk El-Kabbany at 12 May 2020
     * @contact alaa@upbeatdigital.team
     */
    protected $language;

    public function __construct(BrandRepository $brandRepo)
    {
        $this->brandRepository = $brandRepo;
        $this->language = request()->header('Accept-Language');
    }

    /**
     * Display a listing of the Brand.
     * GET|HEAD /brands
     *
     * @param Request $request
     * @return Response
     *
     * @author Amk El-Kabbany at 17 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function index(Request $request)
    {
        $brands = $this->brandRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(BrandResource::toArray($brands, $this->language), trans('brand.messages.retrieved'));
    }

    /**
     * Display the specified Brand.
     * GET|HEAD /brands/{id}
     *
     * @param int $category_id
     *
     * @return Response
     */
    public function showByCategory($category_id)
    {
        /** @var Brand $brand */
        $brand = $this->brandRepository->showByCategory($category_id);

        if (empty($brand)) {
            return $this->sendError(trans('category.messages.not_found'));
        }

        return $this->sendResponse(BrandResource::toArray($brand, $this->language), trans('brand.messages.retrieved'));
    }

    /**
     * Retrieve a pluck of the Brand.
     * GET|HEAD /brands
     *
     * @return Response
     *
     * @author Amk El-Kabbany at 17 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function pluck()
    {
        $brands = $this->brandRepository->pluck($this->language);
        return $this->sendResponse($brands, trans('brand.messages.retrieved'));
    }

    /**
     * Store a newly created Brand in storage.
     * POST /brands
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $input = BrandResource::casts($request->all(), $this->language);

        $validator = Validator::make($input, Brand::$rules);

        if($validator->fails()){
            return $this->sendError(BaseAPI::handelValidationErrors($validator->errors()));
        }

        $brand = $this->brandRepository->create($input);

        if (! $brand) {
            return $this->sendError(BaseAPI::handelFlashErrors(trans('brand.messages.errors.created')));
        }
        
        return $this->sendResponse(BrandResource::toArray($brand, $this->language), trans('brand.messages.created'));
    }

    /**
     * Display the specified Brand.
     * GET|HEAD /brands/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Brand $brand */
        $brand = $this->brandRepository->find($id);

        if (empty($brand)) {
            return $this->sendError(trans('brand.messages.not_found'));
        }

        return $this->sendResponse(BrandResource::toArray($brand, $this->language), trans('brand.messages.retrieved'));
    }

    /**
     * Update the specified Brand in storage.
     * PUT/PATCH /brands/{id}
     *
     * @param int $id
     * @param Request $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $input = BrandResource::casts($request->all(), $this->language, $id);

        $validator = Validator::make($input, Brand::$rules);

        if($validator->fails()){
            return $this->sendError(BaseAPI::handelValidationErrors($validator->errors()));
        }

        if (empty($this->brandRepository->find($id))) {
            return $this->sendError(trans('brand.messages.not_found'));
        }

        $brand = $this->brandRepository->update($input, $id);

        if (! $brand) {
            return $this->sendError(BaseAPI::handelFlashErrors(trans('brand.messages.errors.updated')));
        }

        return $this->sendResponse(BrandResource::toArray($brand, $this->language), trans('brand.messages.updated'));
    }

    /**
     * Remove the specified Brand from storage.
     * DELETE /brands/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Brand $brand */
        $brand = $this->brandRepository->find($id);

        if (empty($brand)) {
            return $this->sendError(trans('brand.messages.not_found'));
        }

        $brand->delete();

        return $this->sendSuccess(trans('brand.messages.deleted'));
    }
}
