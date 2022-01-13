<?php

namespace App\Http\Controllers\API;

use App\Core\Controllers\APIs\BaseAPI;
use App\Http\Resources\CouponRatingResource;
use App\Models\Coupon;
use App\Models\CouponRating;
use App\Repositories\CouponRatingRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;


class CouponRatingAPIController extends AppBaseController
{
    /** @var  CouponRatingRepository */
    private $couponRatingRepository;

    protected $language;

    public function __construct(CouponRatingRepository $couponRatingRepo)
    {
        $this->couponRatingRepository = $couponRatingRepo;
        $this->language = request()->header('Accept-Language');
    }


    public function index(Request $request)
    {
        $couponRatings = $this->couponRatingRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(CouponRatingResource::toArray($couponRatings, $this->language), trans('couponRating.messages.retrieved'));
    }


    public function lists($coupon_id)
    {
        $user = (new UserRepository(app()))->findByToken(request()->bearerToken());

        /** @var CouponRating $couponRating */
        $couponRating = $this->couponRatingRepository->lists($coupon_id);
        if (empty($couponRating)) {
            return $this->sendError(trans('coupons.messages.not_found'));
        }

        return $this->sendResponse(CouponRatingResource::toArray($couponRating, $this->language, @$user->id), trans('couponRating.messages.retrieved'));
    }

    public function addLike($id)
    {
        $user = (new UserRepository(app()))->findByToken(request()->bearerToken());
        if($user == null){
            return $this->sendError(trans('user.messages.errors.login'));
        }
        //check if Rating Exist
        $couponRating= CouponRating::where('id',$id)->where('user_id', $user->id)->first();
        if (empty($couponRating)) {
            return $this->sendError(trans('couponRating.messages.not_found'));
        }
       
        $this->couponRatingRepository->addLike($id, $user->id);

        return $this->sendResponse([], trans('couponRating.messages.likes'));
    }


    public function removeLike($id)
    {
        $user = (new UserRepository(app()))->findByToken(request()->bearerToken());
        if($user == null){
            return $this->sendError(trans('user.messages.errors.login'));
        }
        
        //check if Rating Exist
        $couponRating= CouponRating::where('id',$id)->where('user_id', $user->id)->first();
        if (empty($couponRating)) {
            return $this->sendError(trans('couponRating.messages.not_found'));
        }

        $this->couponRatingRepository->removeLike($id, $user->id);

        return $this->sendResponse([], trans('couponRating.messages.likes'));
    }

    public function addDislike($id)
    {
        $user = (new UserRepository(app()))->findByToken(request()->bearerToken());
        if($user == null){
            return $this->sendError(trans('user.messages.errors.login'));
        }

        $this->couponRatingRepository->addDislike($id, $user->id);

        return $this->sendResponse([], trans('couponRating.messages.dislikes'));
    }

   
    public function removeDislike($id)
    {
        $user = (new UserRepository(app()))->findByToken(request()->bearerToken());
        if($user == null){
            return $this->sendError(trans('user.messages.errors.login'));
        }
        $this->couponRatingRepository->removeDislike($id, $user->id);

        return $this->sendResponse([], trans('couponRating.messages.dislikes'));
    }

    /**
     * Store a newly created CouponRating in storage.
     * POST /couponRatings
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
        $coupon_id=$input['coupon_id'];
        $validator = Validator::make($input, CouponRating::$rules);

        if($validator->fails()){
            return $this->sendError(BaseAPI::handelValidationErrors($validator->errors()));
        }

        //check if Coupon Exist
        $coupon= Coupon::where('id',$coupon_id)->first();
        if (empty($coupon)) {return $this->sendError(trans('coupons.messages.not_found'));}
        
        //check if user rate this Before
        $rating= CouponRating::where('coupon_id',$coupon_id)->where('user_id', $user->id)->first();
        if (!empty($rating)) {return $this->sendError(trans('couponRating.messages.rated_before'));}

        $couponRating = $this->couponRatingRepository->create($input);

        if (! $couponRating) {return $this->sendError(BaseAPI::handelFlashErrors(trans('couponRating.messages.errors.created')));}

        return $this->sendResponse(CouponRatingResource::toArray($couponRating, $this->language), trans('couponRating.messages.created'));
    }

    /**
     * Display the specified CouponRating.
     * GET|HEAD /couponRatings/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var CouponRating $couponRating */
        $couponRating = $this->couponRatingRepository->find($id);

        if (empty($couponRating)) {
            return $this->sendError(trans('couponRating.messages.not_found'));
        }

        return $this->sendResponse(CouponRatingResource::toArray($couponRating, $this->language), trans('couponRating.messages.retrieved'));
    }

    /**
     * Update the specified CouponRating in storage.
     * PUT/PATCH /couponRatings/{id}
     *
     * @param int $id
     * @param Request $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $input = CouponRatingResource::casts($request->input(), $id);

        $validator = Validator::make($input, CouponRating::$rules);

        if($validator->fails()){
            return $this->sendError(BaseAPI::handelValidationErrors($validator->errors()));
        }

        if (empty($this->couponRatingRepository->find($id))) {
            return $this->sendError(trans('couponRating.messages.not_found'));
        }

        $couponRating = $this->couponRatingRepository->update($input, $id);

        if (! $couponRating) {
            return $this->sendError(BaseAPI::handelFlashErrors(trans('couponRating.messages.errors.updated')));
        }

        return $this->sendResponse(CouponRatingResource::toArray($couponRating, $this->language), trans('couponRating.messages.updated'));
    }

    /**
     * Remove the specified CouponRating from storage.
     * DELETE /couponRatings/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var CouponRating $couponRating */
        $couponRating = $this->couponRatingRepository->find($id);

        if (empty($couponRating)) {
            return $this->sendError(trans('couponRating.messages.not_found'));
        }

        $couponRating->delete();

        return $this->sendSuccess(trans('couponRating.messages.deleted'));
    }
}
