<?php
/**
 * Store API controller class which handel more of business actions
 *
 * @author Amk El-Kabbany at 18 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Controllers\API;

use App\Core\Controllers\APIs\BaseAPI;
use App\Http\Resources\StoreResource;
use App\Models\Store;
use App\Repositories\StoreRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

/**
 * Class StoreController
 * @package App\Http\Controllers\API
 *
 * @author Amk El-Kabbany at 18 May 2020
 * @contact alaa@upbeatdigital.team
 */

class StoreAPIController extends AppBaseController
{
    /** @var  StoreRepository */
    private $storeRepository;

    /**
     * Current Logged User Selected Language Prefix
     *
     * @var string
     *
     * @author Amk El-Kabbany at 18 May 2020
     * @contact alaa@upbeatdigital.team
     */
    protected $language;

    public function __construct(StoreRepository $storeRepo)
    {
        $this->storeRepository = $storeRepo;
        $this->language = request()->header('Accept-Language');
    }

    /**
     * Display a listing of the Store.
     * GET|HEAD /stores
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $stores = $this->storeRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(StoreResource::toArray($stores, $this->language), trans('store.messages.retrieved'));
    }

    /**
     * Retrieve a pluck of the Brand.
     * GET|HEAD /brands
     *
     * @param  boolean $activated
     * @return Response
     *
     * @author Amk El-Kabbany at 17 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function pluck($activated = null)
    {
        $stores = $this->storeRepository->pluck($this->language, $activated);
        return $this->sendResponse($stores, trans('store.messages.retrieved'));
    }

    /**
     * Store a newly created Store in storage.
     * POST /stores
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $input = StoreResource::casts($request->all(), $this->language);

        $validator = Validator::make($input, Store::$rules);

        if($validator->fails()){
            return $this->sendError(BaseAPI::handelValidationErrors($validator->errors()));
        }

        $store = $this->storeRepository->create($input);

        if (! $store) {
            return $this->sendError(BaseAPI::handelFlashErrors(trans('store.messages.errors.created')));
        }

        return $this->sendResponse(StoreResource::toArray($store, $this->language), trans('store.messages.created'));
    }

    /**
     * Display the specified Store.
     * GET|HEAD /stores/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Store $store */
        $store = $this->storeRepository->find($id);

        if (empty($store)) {
            return $this->sendError(trans('store.messages.not_found'));
        }

        return $this->sendResponse(StoreResource::toArray($store, $this->language), trans('store.messages.retrieved'));
    }

    /**
     * Update the specified Store in storage.
     * PUT/PATCH /stores/{id}
     *
     * @param int $id
     * @param Request $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $input = StoreResource::casts($request->all(), $this->language, $id);

        $validator = Validator::make($input, Store::$rules);

        if($validator->fails()){
            return $this->sendError(BaseAPI::handelValidationErrors($validator->errors()));
        }

        if (empty($this->storeRepository->find($id))) {
            return $this->sendError(trans('store.messages.not_found'));
        }

        $store = $this->storeRepository->update($input, $id);

        if (! $store) {
            return $this->sendError(BaseAPI::handelFlashErrors(trans('store.messages.errors.updated')));
        }

        return $this->sendResponse(StoreResource::toArray($store, $this->language), trans('store.messages.updated'));
    }

    /**
     * Remove the specified Store from storage.
     * DELETE /stores/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Store $store */
        $store = $this->storeRepository->find($id);

        if (empty($store)) {
            return $this->sendError(trans('store.messages.not_found'));
        }

        $store->delete();

        return $this->sendSuccess(trans('store.messages.deleted'));
    }
}
