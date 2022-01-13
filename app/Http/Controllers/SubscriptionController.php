<?php
/**
 * Subscription Attribute controller class which handel more of business actions
 *
 * @author Amk El-Kabbany at 12 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Controllers;

use App\Core\Controllers\CustomizedAppBaseController;
use App\DataTables\SubscriptionDataTable;
use App\Http\Requests\CreateSubscriptionRequest;
use App\Http\Requests;
use App\Http\Requests\UpdateSubscriptionRequest;
use App\Repositories\SubscriptionRepository;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Laracasts\Flash\Flash;
use App\models\Subscription;
use App\models\Store;
use App\Models\storeSubscription;

class SubscriptionController extends CustomizedAppBaseController
{
    /** @var  SubscriptionRepository */
    private $subscriptionRepository;

    /**
     * Current Logged User Selected Language Prefix
     *
     * @var string
     *
     * @author Amk El-Kabbany at 12 May 2020
     * @contact alaa@upbeatdigital.team
     */
    protected $language;

    public function __construct(SubscriptionRepository $subscriptionRepo)
    {
        parent::__construct();
        $this->subscriptionRepository = $subscriptionRepo;
        $this->language = Config::get('languages')[Request::ip()]['admin'];
    }

    /**
     * Display a listing of the Subscription.
     *
     * @param SubscriptionDataTable $subscriptionDataTable
     * @return Response
     */
    public function index(SubscriptionDataTable $subscriptionDataTable)
    {
        return $subscriptionDataTable->render('subscriptions.index');
    }

    /**
     * Show the form for creating a new Subscription.
     *
     * @return Response
     */
    public function create()
    {
        return view('subscriptions.create');
    }

    /**
     * Store a newly created Subscription in storage.
     *
     * @param CreateSubscriptionRequest $request
     *
     * @return Response
     */
    public function store(CreateSubscriptionRequest $request)
    {
        $input = $request->all();

        $subscription = $this->subscriptionRepository->create($input);

        Flash::success(trans('subscription.messages.created'));

        return redirect(route('subscriptions.index'));
    }

    /**
     * Display the specified Subscription.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $subscription = $this->subscriptionRepository->find($id);

        if (empty($subscription)) {
            Flash::error(trans('subscription.messages.not_found'));

            return redirect(route('subscriptions.index'));
        }

        return view('subscriptions.show')->with('subscription', $subscription);
    }

    /**
     * Show the form for editing the specified Subscription.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $subscription = $this->subscriptionRepository->find($id);

        if (empty($subscription)) {
            Flash::error(trans('subscription.messages.not_found'));

            return redirect(route('subscriptions.index'));
        }

        return view('subscriptions.edit')->with('subscription', $subscription);
    }

    /**
     * Update the specified Subscription in storage.
     *
     * @param  int              $id
     * @param UpdateSubscriptionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSubscriptionRequest $request)
    {
        $subscription = $this->subscriptionRepository->find($id);

        if (empty($subscription)) {
            Flash::error(trans('subscription.messages.not_found'));

            return redirect(route('subscriptions.index'));
        }

        $subscription = $this->subscriptionRepository->update($request->all(), $id);

        Flash::success(trans('subscription.messages.updated'));

        return redirect(route('subscriptions.index'));
    }

    /**
     * Remove the specified Subscription from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $subscription = $this->subscriptionRepository->find($id);

        if (empty($subscription)) {
            Flash::error(trans('subscription.messages.not_found'));

            return redirect(route('subscriptions.index'));
        }

        $flag = $this->subscriptionRepository->delete($id);

        if($flag != false){
            Flash::success(trans('subscription.messages.deleted'));
        }

        return redirect(route('subscriptions.index'));
    }

    public function view_subscriptions()
    {
        $lang=(!empty($this->language)) ?$this->language :'en';
        $user =auth()->user();
        $title = 'title_'.$lang.' AS title';
        $description = 'description_'.$lang.' AS description';
        $orderTitle = 'title_'.$lang;

        $subscriptions =Subscription::select('id',$title , $description ,'price','duration','max_product')
                        ->where('deleted_at', null)
                        ->where('active', true)
                        ->orderBy($orderTitle)->get();
        
        $stores_subscription=[]; $stores_subscription_ids_Arr=[];
        // get stores_ids if user type is 3 and owner_id== userid
        // get store supscription of this user where store_id in stores_ids
        if($user->account_type==3){
            $stores=$user->stores()->pluck('id')->toArray();
            if(!empty($stores) && count($stores)>0 ){
                /////////////////////////////////////////////
                $stores_subscription=storeSubscription::whereIn("store_id" ,$stores)->whereDate('expire_date','>=',date('Y-m-d'))->with('store')->get()->keyBy('subscription_id');
                $stores_subscription_ids_Arr=$stores_subscription->pluck('subscription_id')->toArray();
            }

            // dd($subscriptions , $stores_subscription ,$stores_subscription_ids_Arr );
        }


        return view('subscriptions.view_subscriptions' ,compact('subscriptions','stores_subscription' ,'stores_subscription_ids_Arr'));
    
    }
}
