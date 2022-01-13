<?php
/**
 * Notification controller class which handel more of business actions
 *
 * @author Amk El-Kabbany at 1 July 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Controllers\API;

use App\Core\Controllers\APIs\BaseAPI;
use App\Http\Requests\API\CreateNotificationAPIRequest;
use App\Http\Requests\API\UpdateNotificationAPIRequest;
use App\Http\Resources\NotificationResource;
use App\Models\Notification;
use App\Repositories\NotificationRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Response;

/**
 * Class NotificationController
 * @package App\Http\Controllers\API
 *
 * @author Amk El-Kabbany at 1 July 2020
 * @contact alaa@upbeatdigital.team
 */

class NotificationAPIController extends AppBaseController
{
    /** @var  NotificationRepository */
    private $notificationRepository;

    /**
     * Current Logged User Selected Language Prefix
     *
     * @var string
     *
     * @author Amk El-Kabbany at 1 July 2020
     * @contact alaa@upbeatdigital.team
     */
    protected $language;

    public function __construct(NotificationRepository $notificationRepo)
    {
        $this->notificationRepository = $notificationRepo;
        $this->language = request()->header('Accept-Language');
    }

    /**
     * Display a listing of the Notification.
     * GET|HEAD /notifications
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $notifications = $this->notificationRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($notifications->toArray(), 'Notifications retrieved successfully');
    }

    /**
     * Display a listing of logged user notifications.
     * GET|HEAD /notifications
     *
     * @return Response
     */
    public function lists()
    {
        $user = (new UserRepository(app()))->findByToken(request()->bearerToken());

        if($user == null){
            return $this->sendError(trans('user.messages.errors.login'));
        }

        $notifications = $this->notificationRepository->lists($user->id);

        return $this->sendResponse(NotificationResource::toArray($notifications, $this->language), trans('notification.messages.retrieved'));
    }

    /**
     * Display a listing of logged user notifications.
     * GET|HEAD /notifications/mark-seen/{id}
     *
     * @param int $id
     * @return Response
     */
    public function markSeen($id)
    {
        $flag = $this->notificationRepository->markSeen($id);
        if ($flag == false) {
            return $this->sendError(trans('notification.messages.not_found'));
        }
        return $this->sendResponse([], trans('notification.messages.marked'));
    }

    /**
     * Store a newly created Notification in storage.
     * POST /notifications
     *
     * @param CreateNotificationAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateNotificationAPIRequest $request)
    {
        $input = $request->all();

        $notification = $this->notificationRepository->create($input);

        return $this->sendResponse($notification->toArray(), 'Notification saved successfully');
    }

    /**
     * Display the specified Notification.
     * GET|HEAD /notifications/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Notification $notification */
        $notification = $this->notificationRepository->find($id);

        if (empty($notification)) {
            return $this->sendError('Notification not found');
        }

        return $this->sendResponse($notification->toArray(), 'Notification retrieved successfully');
    }

    /**
     * Update the specified Notification in storage.
     * PUT/PATCH /notifications/{id}
     *
     * @param int $id
     * @param UpdateNotificationAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateNotificationAPIRequest $request)
    {
        $input = $request->all();

        /** @var Notification $notification */
        $notification = $this->notificationRepository->find($id);

        if (empty($notification)) {
            return $this->sendError('Notification not found');
        }

        $notification = $this->notificationRepository->update($input, $id);

        return $this->sendResponse($notification->toArray(), 'Notification updated successfully');
    }

    /**
     * Remove the specified Notification from storage.
     * DELETE /notifications/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Notification $notification */
        $notification = $this->notificationRepository->find($id);

        if (empty($notification)) {
            return $this->sendError('Notification not found');
        }

        $notification->delete();

        return $this->sendSuccess('Notification deleted successfully');
    }
}
