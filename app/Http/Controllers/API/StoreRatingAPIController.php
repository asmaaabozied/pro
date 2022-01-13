<?php
/**
 * Store Rating API controller class which handel more of business actions
 *
 * @author Amk El-Kabbany at 18 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Controllers\API;

use App\Core\Controllers\APIs\BaseAPI;
use App\Http\Resources\StoreRatingResource;
use App\Models\StoreRating;
use App\Repositories\StoreRatingRepository;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

/**
 * Class StoreRatingController
 * @package App\Http\Controllers\API
 *
 * @author Amk El-Kabbany at 18 May 2020
 * @contact alaa@upbeatdigital.team
 */

class StoreRatingAPIController extends AppBaseController
{
    /** @var  StoreRatingRepository */
    private $storeRatingRepository;

    /**
     * Current Logged User Selected Language Prefix
     *
     * @var string
     *
     * @author Amk El-Kabbany at 18 May 2020
     * @contact alaa@upbeatdigital.team
     */
    protected $language;

    public function __construct(StoreRatingRepository $storeRatingRepo)
    {
        $this->storeRatingRepository = $storeRatingRepo;
        $this->language = request()->header('Accept-Language');
    }

    /**
     * Display a listing of the StoreRating.
     * GET|HEAD /storeRatings
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $storeRatings = $this->storeRatingRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(StoreRatingResource::toArray($storeRatings, $this->language), trans('storeRating.messages.retrieved'));
    }

    /**
     * lists StoreRating according to store id.
     * GET|HEAD /storeRatings/{id}
     *
     * @param int $store_id
     *
     * @return Response
     *
     * @author Amk El-Kabbany at 14 June 2020
     * @contact alaa@upbeatdigital.team
     */
    public function lists($store_id)
    {
        $user = (new UserRepository(app()))->findByToken(request()->bearerToken());

        /** @var StoreRating $storeRating */
        $storeRating = $this->storeRatingRepository->lists($store_id);

        if (empty($storeRating)) {
            return $this->sendError(trans('store.messages.not_found'));
        }

        return $this->sendResponse(StoreRatingResource::toArray($storeRating, $this->language, @$user->id), trans('storeRating.messages.retrieved'));
    }

    /**
     * Add like for Store Rating Review.
     * GET|HEAD /store_ratings/likes/add/{id}
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

        $this->storeRatingRepository->addLike($id, $user->id);

        return $this->sendResponse([], trans('storeRating.messages.likes'));
    }

    /**
     * Remove like for Store Rating Review.
     * GET|HEAD /store_ratings/likes/remove/{id}
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

        $this->storeRatingRepository->removeLike($id, $user->id);

        return $this->sendResponse([], trans('storeRating.messages.likes'));
    }

    /**
     * Add dislike for Store Rating Review.
     * GET|HEAD /store_ratings/dislikes/add/{id}
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

        $this->storeRatingRepository->addDislike($id, $user->id);

        return $this->sendResponse([], trans('storeRating.messages.dislikes'));
    }

    /**
     * Remove like for Store Rating Review.
     * GET|HEAD /store_ratings/dislikes/remove/{id}
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

        $this->storeRatingRepository->removeLike($id, $user->id);

        return $this->sendResponse([], trans('storeRating.messages.dislikes'));
    }

    /**
     * Store a newly created StoreRating in storage.
     * POST /storeRatings
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $input['user_id'] = User::findByToken($request->bearerToken())->id;

        $validator = Validator::make($input, StoreRating::$rules);

        if($validator->fails()){
            return $this->sendError(BaseAPI::handelValidationErrors($validator->errors()));
        }

        $storeRating = $this->storeRatingRepository->create($input);

        if (! $storeRating) {
            return $this->sendError(BaseAPI::handelFlashErrors(trans('storeRating.messages.errors.created')));
        }

        return $this->sendResponse(StoreRatingResource::toArray($storeRating, $this->language), trans('storeRating.messages.created'));
    }

    /**
     * Display the specified StoreRating.
     * GET|HEAD /storeRatings/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var StoreRating $storeRating */
        $storeRating = $this->storeRatingRepository->find($id);

        if (empty($storeRating)) {
            return $this->sendError(trans('storeRating.messages.not_found'));
        }

        return $this->sendResponse(StoreRatingResource::toArray($storeRating, $this->language), trans('storeRating.messages.retrieved'));
    }

    /**
     * Update the specified StoreRating in storage.
     * PUT/PATCH /storeRatings/{id}
     *
     * @param int $id
     * @param Request $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $input = StoreRatingResource::casts($request->input(), $id);

        $validator = Validator::make($input, StoreRating::$rules);

        if($validator->fails()){
            return $this->sendError(BaseAPI::handelValidationErrors($validator->errors()));
        }

        if (empty($this->storeRatingRepository->find($id))) {
            return $this->sendError(trans('storeRating.messages.not_found'));
        }

        $storeRating = $this->storeRatingRepository->update($input, $id);

        if (! $storeRating) {
            return $this->sendError(BaseAPI::handelFlashErrors(trans('storeRating.messages.errors.updated')));
        }

        return $this->sendResponse(StoreRatingResource::toArray($storeRating, $this->language), trans('storeRating.messages.updated'));
    }

    /**
     * Remove the specified StoreRating from storage.
     * DELETE /storeRatings/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var StoreRating $storeRating */
        $storeRating = $this->storeRatingRepository->find($id);

        if (empty($storeRating)) {
            return $this->sendError(trans('storeRating.messages.not_found'));
        }

        $storeRating->delete();

        return $this->sendSuccess(trans('storeRating.messages.deleted'));
    }
}
