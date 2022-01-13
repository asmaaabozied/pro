<?php

namespace App\Repositories;

use App\Models\City;
use App\Models\Country;
use App\Models\Notification;
use App\Models\NotifiedRegion;
use App\Models\NotifiedSubscription;
use App\Models\NotifiedUser;
use App\Models\Store;
use App\Models\StoreSubscription;
use App\Repositories\BaseRepository;
use App\User;
use App\Helpers\Notification as NotificationHelper;

/**
 * Class NotificationRepository
 * @package App\Repositories
 * @version June 9, 2020, 8:13 pm UTC
*/

class NotificationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'notification_en',
        'type',
        'module',
        'module_id',
        'general',
        'active'
    ];

    /**
     * Class constructor
     *
     * @author Amk El-Kabbany at 4 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function __construct()
    {
        parent::__construct(app());
        $this->fieldSearchable = array_keys(alterLangArrayElements('notifications', ['fields' => array_combine($this->fieldSearchable,$this->fieldSearchable)], $key = 'fields')['fields']);
    }

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Notification::class;
    }

    /**
     * List logged user notifications
     *
     * @param int $user_id
     * @return array
     *
     * @author Amk El-Kabbany at 15 June 2020
     * @contact alaa@upbeatdigital.team
     **/
    public function lists($user_id)
    {
        $ids = NotifiedUser::where('deleted_at', null)->where('seen', false)
                            ->where('user_id', $user_id)->orderBy('notification_id')
                            ->take(15)->pluck('notification_id');
        return Notification::whereIn('id', $ids)->get();
    }

    /**
     * Mark given notification as seen
     *
     * @param int $id
     * @return array|boolean
     *
     * @author Amk El-Kabbany at 15 June 2020
     * @contact alaa@upbeatdigital.team
     **/
    public function markSeen($id)
    {
        $notification = NotifiedUser::find($id);
        if($notification == null) {
            return false;
        }
        return $notification->fill(['seen' => true])->save();
    }

    /**
     * Create model record
     *
     * @param array $input
     *
     * @return Notification
     *
     * @author Amk El-Kabbany at 30 June 2020
     * @contact alaa@upbeatdigital.team
     */
    public function create($input)
    {
        // dd($input);
        $users_ids = [];
        if(intval($input['general']) == 1){
            $input['type'] = 'general';
            $notification = new Notification();
            $notification->fill($input)->save();
            foreach(User::where('deleted_at', null)->get() as $user) {
                $notifiedUser = new NotifiedUser();
                $notifiedUser->fill([
                    'notification_id'   => $notification->id,
                    'user_id'           => $user->id,
                ])->save();
                $users_ids[] = $user->id;
            }
        } else {
            $usersFilter    = [];
            $countryFilter  = 0;
            $citiesFilter   = [];
            $subscriptionsFilter = [];

            if(! empty($input['users'])){
                $usersFilter = $input['users'];
                unset($input['users']);
            }
            if(! empty($input['subscriptions'])){
                $subscriptionsFilter = $input['subscriptions'];
                unset($input['subscriptions']);
            }
            if(! empty($input['country'])){
                $countryFilter = $input['country'];
                $citiesFilter = $input['cities'];
                unset($input['country']);
                unset($input['cities']);
            }

            $notification = new Notification();
            $notification->fill($input)->save();

            if($notification->type == 'sellers') {
                foreach(Store::pluck('owner_id') as $owner) {
                    $notifiedUser = new NotifiedUser();
                    $notifiedUser->fill([
                        'notification_id'   => $notification->id,
                        'user_id'           => $owner,
                    ])->save();
                    $users_ids[] = $owner;
                }
            }

            if($notification->type == 'users' || $notification->type == 'system') {
                foreach(User::storeClients() as $client) {
                    $notifiedUser = new NotifiedUser();
                    $notifiedUser->fill([
                        'notification_id'   => $notification->id,
                        'user_id'           => $client,
                    ])->save();
                    $users_ids[] = $client;
                }
            }

            if($notification->filter_type == 'users') {
                foreach($usersFilter as $user) {
                    $notifiedUser = new NotifiedUser();
                    $notifiedUser->fill([
                        'notification_id'   => $notification->id,
                        'user_id'           => intval($user),
                    ])->save();
                    $users_ids[] = $user;
                }
                
            }

            if($notification->filter_type == 'subscriptions') {
                foreach($subscriptionsFilter as $subscription) {
                    $notifiedSubscription = new NotifiedSubscription();
                    $notifiedSubscription->fill([
                        'notification_id'   => $notification->id,
                        'subscription_id'   => intval($subscription),
                    ])->save();
                    $subscriptions = StoreSubscription::where('subscription_id', $subscription)->get();
                    foreach($subscriptions as $item) {
                        $notifiedUser = new NotifiedUser();
                        $notifiedUser->fill([
                            'notification_id'   => $notification->id,
                            'user_id'           => $item->store->owner->id,
                        ])->save();
                        $users_ids[] = $item->store->owner->id;
                    }
                }
            }

            if($notification->filter_type == 'regions') {
                if(in_array("0", $citiesFilter)){
                    $notifiedRegion = new NotifiedRegion();
                    $notifiedRegion->fill([
                        'notification_id'   => $notification->id,
                        'region_id'         => intval($countryFilter),
                        'type'              => 'country',
                    ])->save();
                    foreach(Country::users(intval($countryFilter)) as $user) {
                        $notifiedUser = new NotifiedUser();
                        $notifiedUser->fill([
                            'notification_id'   => $notification->id,
                            'user_id'           => intval($user->id),
                        ])->save();
                        $users_ids[] = $user->id;
                    }
                } else {
                    foreach($citiesFilter as $city) {
                        $notifiedRegion = new NotifiedRegion();
                        $notifiedRegion->fill([
                            'notification_id'   => $notification->id,
                            'region_id'         => intval($city),
                            'type'              => 'city',
                        ])->save();
                        foreach(City::users(intval($city)) as $user) {
                            $notifiedUser = new NotifiedUser();
                            $notifiedUser->fill([
                                'notification_id'   => $notification->id,
                                'user_id'           => intval($user->id),
                            ])->save();
                            $users_ids[] = $user->id;
                        }
                    }
                }
            }
        }

        foreach($users_ids as $user_id){
            $token = User::where('id', $user_id)->first()->firebase_token;
            if($token != null){
                NotificationHelper::firebase_notification($token, $input['notification_en'], $input['notification_en']);
            }
        }
        return $notification;
    }
}
