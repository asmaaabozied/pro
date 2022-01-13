<?php
/**
 * Subscription API controller class which handel more of business actions
 *
 * @author Amk El-Kabbany at 18 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Controllers\API;

use App\Core\Controllers\APIs\BaseAPI;
use App\Http\Resources\SubscriptionResource;
use App\Models\Subscription;
use App\Repositories\SubscriptionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

/**
 * Class SubscriptionController
 * @package App\Http\Controllers\API
 *
 * @author Amk El-Kabbany at 18 May 2020
 * @contact alaa@upbeatdigital.team
 */

class SubscriptionAPIController extends AppBaseController
{
    /** @var  SubscriptionRepository */
    private $subscriptionRepository;

    /**
     * Current Logged User Selected Language Prefix
     *
     * @var string
     *
     * @author Amk El-Kabbany at 18 May 2020
     * @contact alaa@upbeatdigital.team
     */
    protected $language;

    public function __construct(SubscriptionRepository $subscriptionRepo)
    {
        $this->subscriptionRepository = $subscriptionRepo;
        $this->language = request()->header('Accept-Language');
    }

    /**
     * Display a listing of the Subscription.
     * GET|HEAD /subscriptions
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $subscriptions = $this->subscriptionRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(SubscriptionResource::toArray($subscriptions, $this->language), trans('subscription.messages.retrieved'));
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
        $subscriptions = $this->subscriptionRepository->pluck($this->language);
        return $this->sendResponse($subscriptions, trans('subscription.messages.retrieved'));
    }

    /**
     * Store a newly created Subscription in storage.
     * POST /subscriptions
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $input = SubscriptionResource::casts($request->all(), $this->language);

        $validator = Validator::make($input, Subscription::$rules);

        if($validator->fails()){
            return $this->sendError(BaseAPI::handelValidationErrors($validator->errors()));
        }

        $subscription = $this->subscriptionRepository->create($input);

        if (! $subscription) {
            return $this->sendError(BaseAPI::handelFlashErrors(trans('subscription.messages.errors.created')));
        }

        return $this->sendResponse(SubscriptionResource::toArray($subscription, $this->language), trans('subscription.messages.created'));
    }

    /**
     * Display the specified Subscription.
     * GET|HEAD /subscriptions/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Subscription $subscription */
        $subscription = $this->subscriptionRepository->find($id);

        if (empty($subscription)) {
            return $this->sendError(trans('subscription.messages.not_found'));
        }

        return $this->sendResponse(SubscriptionResource::toArray($subscription, $this->language), trans('subscription.messages.retrieved'));
    }

    /**
     * Update the specified Subscription in storage.
     * PUT/PATCH /subscriptions/{id}
     *
     * @param int $id
     * @param Request $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {

        $input = SubscriptionResource::casts($request->all(), $this->language, $id);

        $validator = Validator::make($input, Subscription::$rules);

        if($validator->fails()){
            return $this->sendError(BaseAPI::handelValidationErrors($validator->errors()));
        }

        if (empty($this->subscriptionRepository->find($id))) {
            return $this->sendError(trans('subscription.messages.not_found'));
        }

        $subscription = $this->subscriptionRepository->update($input, $id);

        if (! $subscription) {
            return $this->sendError(BaseAPI::handelFlashErrors(trans('subscription.messages.errors.updated')));
        }

        return $this->sendResponse(SubscriptionResource::toArray($subscription, $this->language), trans('subscription.messages.updated'));
    }

    /**
     * Remove the specified Subscription from storage.
     * DELETE /subscriptions/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Subscription $subscription */
        $subscription = $this->subscriptionRepository->find($id);

        if (empty($subscription)) {
            return $this->sendError(trans('subscription.messages.not_found'));
        }

        $subscription->delete();

        return $this->sendSuccess(trans('subscription.messages.deleted'));
    }
}
