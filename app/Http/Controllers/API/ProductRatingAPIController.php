<?php
/**
 * Product Rating API controller class which handel more of business actions
 *
 * @author Amk El-Kabbany at 27 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Controllers\API;

use App\Core\Controllers\APIs\BaseAPI;
use App\Http\Resources\ProductRatingResource;
use App\Models\ProductRating;
use App\Repositories\ProductRatingRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

/**
 * Class ProductRatingController
 * @package App\Http\Controllers\API
 *
 * @author Amk El-Kabbany at 27 May 2020
 * @contact alaa@upbeatdigital.team
 */

class ProductRatingAPIController extends AppBaseController
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
        $this->productRatingRepository = $productRatingRepo;
        $this->language = request()->header('Accept-Language');
    }

    /**
     * Display a listing of the ProductRating.
     * GET|HEAD /productRatings
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $productRatings = $this->productRatingRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(ProductRatingResource::toArray($productRatings, $this->language), trans('productRating.messages.retrieved'));
    }

    /**
     * Display the specified productRatings.
     * GET|HEAD /productRatings/{id}
     *
     * @param int $product_id
     *
     * @return Response
     */
    public function lists($product_id)
    {
        $user = (new UserRepository(app()))->findByToken(request()->bearerToken());

        /** @var ProductRating $productRating */
        $productRating = $this->productRatingRepository->lists($product_id);

        if (empty($productRating)) {
            return $this->sendError(trans('product.messages.not_found'));
        }

        return $this->sendResponse(ProductRatingResource::toArray($productRating, $this->language, @$user->id), trans('productRating.messages.retrieved'));
    }

    /**
     * Add like for Product Rating Review.
     * GET|HEAD /productRatings/likes/add/{id}
     *
     * @param int $id
     * @return Response
     */
    public function addLike($id)
    {
        $user = (new UserRepository(app()))->findByToken(request()->bearerToken());
        if($user == null){
            return $this->sendError(trans('user.messages.errors.login'));
        }

        $this->productRatingRepository->addLike($id, $user->id);

        return $this->sendResponse([], trans('productRating.messages.likes'));
    }

    /**
     * Remove like for Product Rating Review.
     * GET|HEAD /productRatings/likes/remove/{id}
     *
     * @param int $id
     * @return Response
     */
    public function removeLike($id)
    {
        $user = (new UserRepository(app()))->findByToken(request()->bearerToken());
        if($user == null){
            return $this->sendError(trans('user.messages.errors.login'));
        }

        $this->productRatingRepository->removeLike($id, $user->id);

        return $this->sendResponse([], trans('productRating.messages.likes'));
    }

    /**
     * Add dislike for Product Rating Review.
     * GET|HEAD /productRatings/dislikes/add/{id}
     *
     * @param int $id
     * @return Response
     */
    public function addDislike($id)
    {
        $user = (new UserRepository(app()))->findByToken(request()->bearerToken());
        if($user == null){
            return $this->sendError(trans('user.messages.errors.login'));
        }

        $this->productRatingRepository->addDislike($id, $user->id);

        return $this->sendResponse([], trans('productRating.messages.dislikes'));
    }

    /**
     * Remove like for Product Rating Review.
     * GET|HEAD /productRatings/dislikes/remove/{id}
     *
     * @param int $id
     * @return Response
     */
    public function removeDislike($id)
    {
        $user = (new UserRepository(app()))->findByToken(request()->bearerToken());
        if($user == null){
            return $this->sendError(trans('user.messages.errors.login'));
        }

        $this->productRatingRepository->removeLike($id, $user->id);

        return $this->sendResponse([], trans('productRating.messages.dislikes'));
    }

    /**
     * Store a newly created ProductRating in storage.
     * POST /productRatings
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $user = (new UserRepository(app()))->findByToken(request()->bearerToken());
        if($user == null){
            return $this->sendError(trans('user.messages.errors.login'));
        }
        $input['user_id'] = $user->id;

        $validator = Validator::make($input, ProductRating::$rules);

        if($validator->fails()){
            return $this->sendError(BaseAPI::handelValidationErrors($validator->errors()));
        }

        $productRating = $this->productRatingRepository->create($input);

        if (! $productRating) {
            return $this->sendError(BaseAPI::handelFlashErrors(trans('productRating.messages.errors.created')));
        }

        return $this->sendResponse(ProductRatingResource::toArray($productRating, $this->language), trans('productRating.messages.created'));
    }

    /**
     * Display the specified ProductRating.
     * GET|HEAD /productRatings/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ProductRating $productRating */
        $productRating = $this->productRatingRepository->find($id);

        if (empty($productRating)) {
            return $this->sendError(trans('productRating.messages.not_found'));
        }

        return $this->sendResponse(ProductRatingResource::toArray($productRating, $this->language), trans('productRating.messages.retrieved'));
    }

    /**
     * Update the specified ProductRating in storage.
     * PUT/PATCH /productRatings/{id}
     *
     * @param int $id
     * @param Request $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $input = ProductRatingResource::casts($request->input(), $id);

        $validator = Validator::make($input, ProductRating::$rules);

        if($validator->fails()){
            return $this->sendError(BaseAPI::handelValidationErrors($validator->errors()));
        }

        if (empty($this->productRatingRepository->find($id))) {
            return $this->sendError(trans('productRating.messages.not_found'));
        }

        $productRating = $this->productRatingRepository->update($input, $id);

        if (! $productRating) {
            return $this->sendError(BaseAPI::handelFlashErrors(trans('productRating.messages.errors.updated')));
        }

        return $this->sendResponse(ProductRatingResource::toArray($productRating, $this->language), trans('productRating.messages.updated'));
    }

    /**
     * Remove the specified ProductRating from storage.
     * DELETE /productRatings/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ProductRating $productRating */
        $productRating = $this->productRatingRepository->find($id);

        if (empty($productRating)) {
            return $this->sendError(trans('productRating.messages.not_found'));
        }

        $productRating->delete();

        return $this->sendSuccess(trans('productRating.messages.deleted'));
    }
}
