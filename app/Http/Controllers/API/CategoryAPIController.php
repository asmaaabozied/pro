<?php
/**
 * Category API controller class which handel more of business actions
 *
 * @author Amk El-Kabbany at 12 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Controllers\API;

use App\Core\Controllers\APIs\BaseAPI;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

/**
 * Class CategoryController
 * @package App\Http\Controllers\API
 *
 * @author Amk El-Kabbany at 12 May 2020
 * @contact alaa@upbeatdigital.team
 */

class CategoryAPIController extends AppBaseController
{
    /** @var  CategoryRepository */
    private $categoryRepository;

    /**
     * Current Logged User Selected Language Prefix
     *
     * @var string
     *
     * @author Amk El-Kabbany at 12 May 2020
     * @contact alaa@upbeatdigital.team
     */
    protected $language;

    public function __construct(CategoryRepository $categoryRepo)
    {
        $this->categoryRepository = $categoryRepo;
        $this->language = request()->header('Accept-Language');
    }

    /**
     * Display a listing of the Category.
     * GET|HEAD /categories
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $categories = $this->categoryRepository->List();

        return $this->sendResponse(CategoryResource::toArray($categories, $this->language), trans('category.messages.retrieved'));
    }

    /**
     * Display Menu Category.
     * GET|HEAD /categories/{id}
     *
     * @return Response
     */
    public function menu()
    {
        /** @var Category $category */
        $category = $this->categoryRepository->menu($this->language);

        return $this->sendResponse(CategoryResource::toArray($category, $this->language), trans('category.messages.retrieved'));
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
        $categories = $this->categoryRepository->pluck($this->language);
        return $this->sendResponse($categories, trans('category.messages.retrieved'));
    }

    /**
     * Store a newly created Category in storage.
     * POST /categories
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $input = CategoryResource::casts($request->all(), $this->language);

        $validator = Validator::make($input, Category::$rules);

        if($validator->fails()){
            return $this->sendError(BaseAPI::handelValidationErrors($validator->errors()));
        }

        $category = $this->categoryRepository->create($input);

        if (! $category) {
            return $this->sendError(BaseAPI::handelFlashErrors(trans('category.messages.errors.created')));
        }
       
        return $this->sendResponse(CategoryResource::toArray($category, $this->language), trans('category.messages.created'));
    }

    /**
     * Display the specified Category.
     * GET|HEAD /categories/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Category $category */
        $category = $this->categoryRepository->find($id);

        if (empty($category)) {
            return $this->sendError(trans('category.messages.not_found'));
        }

        return $this->sendResponse(CategoryResource::toArray($category, $this->language), trans('category.messages.retrieved'));
    }

    /**
     * Display the specified Category sub-categories.
     * GET|HEAD /categories/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function subCategories($id)
    {
        /** @var Category $category */
        $category = $this->categoryRepository->subCategories($id);

        if (empty($category)) {
            return $this->sendError(trans('category.messages.not_found'));
        }

        return $this->sendResponse(CategoryResource::toArray($category, $this->language), trans('category.messages.retrieved'));
    }

    /**
     * Update the specified Category in storage.
     * PUT/PATCH /categories/{id}
     *
     * @param int $id
     * @param Request $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $input = CategoryResource::casts($request->all(), $this->language, $id);

        $validator = Validator::make($input, Category::$rules);

        if($validator->fails()){
            return $this->sendError(BaseAPI::handelValidationErrors($validator->errors()));
        }

        if (empty($this->categoryRepository->find($id))) {
            return $this->sendError(trans('category.messages.not_found'));
        }

        $category = $this->categoryRepository->update($input, $id);

        if (! $category) {
            return $this->sendError(BaseAPI::handelFlashErrors(trans('category.messages.errors.updated')));
        }

        return $this->sendResponse(CategoryResource::toArray($category, $this->language), trans('category.messages.updated'));
    }

    /**
     * Remove the specified Category from storage.
     * DELETE /categories/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Category $category */
        $category = $this->categoryRepository->find($id);

        if (empty($category)) {
            return $this->sendError(trans('category.messages.not_found'));
        }

        $flag = $category->delete();

        if($flag != false){
            return $this->sendSuccess(trans('category.messages.deleted'));
        }
    }
}
