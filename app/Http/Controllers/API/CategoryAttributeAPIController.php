<?php
/**
 * Category Attribute API controller class which handel more of business actions
 *
 * @author Amk El-Kabbany at 14 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Controllers\API;

use App\Core\Controllers\APIs\BaseAPI;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\CategoryAttributeResource;
use App\Models\CategoryAttribute;
use App\Repositories\CategoryAttributeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

/**
 * Class CategoryAttributeController
 * @package App\Http\Controllers\API
 *
 * @author Amk El-Kabbany at 14 May 2020
 * @contact alaa@upbeatdigital.team
 */

class CategoryAttributeAPIController extends AppBaseController
{
    /** @var  CategoryAttributeRepository */
    private $categoryAttributeRepository;

    /**
     * Current Logged User Selected Language Prefix
     *
     * @var string
     *
     * @author Amk El-Kabbany at 14 May 2020
     * @contact alaa@upbeatdigital.team
     */
    protected $language;

    public function __construct(CategoryAttributeRepository $categoryAttributeRepo)
    {
        $this->categoryAttributeRepository = $categoryAttributeRepo;
        $this->language = request()->header('Accept-Language');
    }

    /**
     * Display a listing of the CategoryAttribute.
     * GET|HEAD /categoryAttributes
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $categoryAttributes = $this->categoryAttributeRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(CategoryAttributeResource::toArray($categoryAttributes, $this->language), trans('categoryAttribute.messages.retrieved'));
    }

    /**
     * Display the specified CategoryAttribute.
     * GET|HEAD /categoryAttributes/{id}
     *
     * @param int $category_id
     *
     * @return Response
     */
    public function lists($category_id)
    {
        /** @var CategoryAttribute $categoryAttribute */
        $categoryAttribute = $this->categoryAttributeRepository->lists($category_id);

        if (empty($categoryAttribute)) {
            return $this->sendError(trans('category.messages.not_found'));
        }

        return $this->sendResponse(CategoryAttributeResource::toArray($categoryAttribute, $this->language), trans('categoryAttribute.messages.retrieved'));
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
        $categoryAttributes = $this->categoryAttributeRepository->pluck($this->language);
        return $this->sendResponse($categoryAttributes, trans('categoryAttribute.messages.retrieved'));
    }

    /**
     * Store a newly created CategoryAttribute in storage.
     * POST /categoryAttributes
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $input = CategoryAttributeResource::casts($request->all(), $this->language);

        $validator = Validator::make($input, CategoryAttribute::$rules);

        if($validator->fails()){
            return $this->sendError(BaseAPI::handelValidationErrors($validator->errors()));
        }

        $categoryAttribute = $this->categoryAttributeRepository->create($input);

        if (! $categoryAttribute) {
            return $this->sendError(BaseAPI::handelFlashErrors(trans('categoryAttribute.messages.errors.created')));
        }

        return $this->sendResponse(CategoryAttributeResource::toArray($categoryAttribute, $this->language), trans('categoryAttribute.messages.created'));
    }

    /**
     * Display the specified CategoryAttribute.
     * GET|HEAD /categoryAttributes/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var CategoryAttribute $categoryAttribute */
        $categoryAttribute = $this->categoryAttributeRepository->find($id);

        if (empty($categoryAttribute)) {
            return $this->sendError(trans('categoryAttribute.messages.not_found'));
        }

        return $this->sendResponse(CategoryAttributeResource::toArray($categoryAttribute, $this->language), trans('categoryAttribute.messages.retrieved'));
    }

    /**
     * Update the specified CategoryAttribute in storage.
     * PUT/PATCH /categoryAttributes/{id}
     *
     * @param int $id
     * @param Request $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $input = CategoryAttributeResource::casts($request->all(), $this->language, $id);

        $validator = Validator::make($input, CategoryAttribute::$rules);

        if($validator->fails()){
            return $this->sendError(BaseAPI::handelValidationErrors($validator->errors()));
        }

        if (empty($this->categoryAttributeRepository->find($id))) {
            return $this->sendError(trans('categoryAttribute.messages.not_found'));
        }

        $categoryAttribute = $this->categoryAttributeRepository->update($input, $id);

        if (! $categoryAttribute) {
            return $this->sendError(BaseAPI::handelFlashErrors(trans('categoryAttribute.messages.errors.updated')));
        }

        return $this->sendResponse(CategoryAttributeResource::toArray($categoryAttribute, $this->language), trans('categoryAttribute.messages.updated'));
    }

    /**
     * Remove the specified CategoryAttribute from storage.
     * DELETE /categoryAttributes/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var CategoryAttribute $categoryAttribute */
        $categoryAttribute = $this->categoryAttributeRepository->find($id);

        if (empty($categoryAttribute)) {
            return $this->sendError(trans('categoryAttribute.messages.not_found'));
        }

        $categoryAttribute->delete();

        return $this->sendSuccess(trans('categoryAttribute.messages.deleted'));
    }
}
