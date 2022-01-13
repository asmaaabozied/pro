<?php
/**
 * Notification controller class which handel more of business actions
 *
 * @author Amk El-Kabbany at 25 June 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Controllers;

use App\Core\Controllers\CustomizedAppBaseController;
use App\DataTables\NotificationDataTable;
use App\Http\Requests\CreateNotificationRequest;
use App\Http\Requests\UpdateNotificationRequest;
use App\Models\Country;
use App\Repositories\CountryRepository;
use App\Repositories\NotificationRepository;
use App\Repositories\SubscriptionRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Laracasts\Flash\Flash;

class NotificationController extends CustomizedAppBaseController
{
    /** @var  NotificationRepository */
    private $notificationRepository;

    /**
     * Current Logged User Selected Language Prefix
     *
     * @var string
     *
     * @author Amk El-Kabbany at 7 May 2020
     * @contact alaa@upbeatdigital.team
     */
    protected $language;

    public function __construct(NotificationRepository $notificationRepo)
    {
        parent::__construct();
        $this->notificationRepository = $notificationRepo;
        $this->language = Config::get('languages')[Request::ip()]['admin'];
    }

    /**
     * Display a listing of the Notification.
     *
     * @param NotificationDataTable $notificationDataTable
     * @return Response
     */
    public function index(NotificationDataTable $notificationDataTable)
    {
        return $notificationDataTable->render('notifications.index');
    }

    /**
     * Show the form for creating a new Notification.
     *
     * @return Response
     */
    public function create()
    {
        $users = (new UserRepository(app()))->pluck();
        $countries = (new CountryRepository(app()))->pluck($this->language);
        $subscriptions = (new SubscriptionRepository(app()))->pluck($this->language);

        return view('notifications.create', compact('users', 'countries', 'subscriptions'));
    }

    /**
     * Store a newly created Notification in storage.
     *
     * @param CreateNotificationRequest $request
     *
     * @return Response
     */
    public function store(CreateNotificationRequest $request)
    {
        $input = $request->all();

        $notification = $this->notificationRepository->create($input);

        Flash::success(trans('notification.messages.created'));

        return redirect(route('notifications.index'));
    }

    public function referalStore(CreateNotificationRequest $request)
    {
        $input = $request->all();

        $notification = $this->notificationRepository->create($input);

        Flash::success(trans('notification.messages.created'));
       return back();
    }

    /**
     * Display the specified Notification.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $notification = $this->notificationRepository->find($id);

        if (empty($notification)) {
            Flash::error(trans('notification.messages.not_found'));

            return redirect(route('notifications.index'));
        }

        return view('notifications.show')->with('notification', $notification);
    }

    /**
     * Show the form for editing the specified Notification.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $notification = $this->notificationRepository->find($id);

        if (empty($notification)) {
            Flash::error(trans('notification.messages.not_found'));

            return redirect(route('notifications.index'));
        }

        $users = (new UserRepository(app()))->pluck();
        $countries = (new CountryRepository(app()))->pluck($this->language);
        $subscriptions = (new SubscriptionRepository(app()))->pluck($this->language);

        return view('notifications.edit', compact('notification', 'users', 'countries', 'subscriptions'));
    }

    /**
     * Update the specified Notification in storage.
     *
     * @param  int              $id
     * @param UpdateNotificationRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateNotificationRequest $request)
    {
        $notification = $this->notificationRepository->find($id);

        if (empty($notification)) {
            Flash::error(trans('notification.messages.not_found'));

            return redirect(route('notifications.index'));
        }

        $notification = $this->notificationRepository->update($request->all(), $id);

        Flash::success(trans('notification.messages.updated'));

        return redirect(route('notifications.index'));
    }

    /**
     * Remove the specified Notification from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $notification = $this->notificationRepository->find($id);

        if (empty($notification)) {
            Flash::error(trans('notification.messages.not_found'));

            return redirect(route('notifications.index'));
        }

        $this->notificationRepository->delete($id);

        Flash::success(trans('notification.messages.deleted'));

        return redirect(route('notifications.index'));
    }
}
