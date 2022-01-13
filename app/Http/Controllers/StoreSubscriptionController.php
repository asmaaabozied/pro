<?php

namespace App\Http\Controllers;

use App\Core\Controllers\CustomizedAppBaseController;
use App\DataTables\StoreSubscriptionDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateStoreSubscriptionRequest;
use App\Http\Requests\UpdateStoreSubscriptionRequest;
use App\Models\Store;
use App\Models\Subscription;

use App\Repositories\StoreSubscriptionRepository;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Laracasts\Flash\Flash;

class StoreSubscriptionController extends CustomizedAppBaseController
{
    /** @var  StoreSubscriptionRepository */
    private $storeSubscriptionRepository;

    /**
     * Current Logged User Selected Language Prefix
     *
     * @var string
     *
     * @author Amk El-Kabbany at 12 May 2020
     * @contact alaa@upbeatdigital.team
     */
    protected $language;

    public function __construct(StoreSubscriptionRepository $storeSubscriptionRepo)
    {
        parent::__construct();
        $this->storeSubscriptionRepository = $storeSubscriptionRepo;
        $this->language = Config::get('languages')[Request::ip()]['admin'];
    }

    /**
     * Display a listing of the StoreSubscription.
     *
     * @param StoreSubscriptionDataTable $storeSubscriptionDataTable
     * @return Response
     */
    public function index(StoreSubscriptionDataTable $storeSubscriptionDataTable)
    {
        return $storeSubscriptionDataTable->render('store_subscriptions.index');
    }

    /**
     * Show the form for creating a new StoreSubscription.
     *
     * @return Response
     */
    public function create()
    {
        $title = 'title_'.$this->language;
        $subscriptions = Subscription::where('deleted_at', null)->orderBy($title)->pluck($title, 'id');
        $name = 'name_'.$this->language;
        $stores = Store::where('deleted_at', null)->limited()->orderBy($name)->pluck($name, 'id');

        $user =auth()->user();
        $stores_subscription=[];
        if($user->account_type==3){
            $stores_ids=$user->stores()->pluck('id')->toArray();
            if(!empty($stores_ids) && count($stores_ids)>0 ){
                /////////////////////////////////////////////
                $stores_subscription= Subscription::where('deleted_at', null)->get()->keyBy('id');
            }
            // dd($subscriptions , $stores_subscription  );
        }

        return view('store_subscriptions.create', compact('subscriptions', 'stores','stores_subscription'));
    }

    /**
     * Store a newly created StoreSubscription in storage.
     *
     * @param CreateStoreSubscriptionRequest $request
     *
     * @return Response
     */
    public function store(CreateStoreSubscriptionRequest $request)
    {
        $input = $request->all();

        $storeSubscription = $this->storeSubscriptionRepository->create($input);

        Flash::success(trans('storeSubscription.messages.created'));

        return redirect(route('storeSubscriptions.index'));
    }

    /**
     * Display the specified StoreSubscription.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $storeSubscription = $this->storeSubscriptionRepository->find($id);

        if (empty($storeSubscription)) {
            Flash::error(trans('storeSubscription.messages.not_found'));

            return redirect(route('storeSubscriptions.index'));
        }

        return view('store_subscriptions.show')->with('storeSubscription', $storeSubscription);
    }

    /**
     * Remove the specified StoreSubscription from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $storeSubscription = $this->storeSubscriptionRepository->find($id);

        if (empty($storeSubscription)) {
            Flash::error(trans('storeSubscription.messages.not_found'));

            return redirect(route('storeSubscriptions.index'));
        }

        $this->storeSubscriptionRepository->delete($id);

        Flash::success(trans('storeSubscription.messages.deleted'));

        return redirect(route('storeSubscriptions.index'));
    }

    /**
     * <Ajax POST Action -#subscription_id js/script.blade.php->
     * Route action fetch selected subscription option price
     *
     * @return array
     *
     * @author Amk El-Kabbany at 13 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function getSubscriptionPrice() {
        $id = $_POST['id'];
        $object = Subscription::find($id);

        exit(json_encode($object->price));
    }
}
