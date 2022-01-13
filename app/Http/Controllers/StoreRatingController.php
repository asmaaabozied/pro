<?php
/**
 * Store ratings and reviews controller class which handel more of business actions
 *
 * @author Amk El-Kabbany at 11 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Controllers;

use App\Core\Controllers\CustomizedAppBaseController;
use App\DataTables\StoreRatingDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateStoreRatingRequest;
use App\Http\Requests\UpdateStoreRatingRequest;
use App\Models\Store;
use App\Repositories\StoreRatingRepository;
use App\Repositories\StoreRepository;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Laracasts\Flash\Flash;

class StoreRatingController extends CustomizedAppBaseController 
{
    /** @var  StoreRatingRepository */
    private $storeRatingRepository;

    /**
     * Current Logged User Selected Language Prefix
     *
     * @var string
     *
     * @author Amk El-Kabbany at 11 May 2020
     * @contact alaa@upbeatdigital.team
     */
    protected $language;

    public function __construct(StoreRatingRepository $storeRatingRepo)
    {
        parent::__construct();
        $this->storeRatingRepository = $storeRatingRepo;
        $this->language = Config::get('languages')[Request::ip()]['admin'];

    }

    /**
     * Display a listing of the StoreRating.
     *
     * @param StoreRatingDataTable $storeRatingDataTable
     * @return Response
     */
    public function index(StoreRatingDataTable $storeRatingDataTable)
    {
        return $storeRatingDataTable->render('store_ratings.index');
    }

    /**
     * Show the form for creating a new StoreRating.
     *
     * @return Response
     */
    public function create()
    {
        $stores = (new StoreRepository())->pluck($this->language);
        $users = (new UserRepository(app()))->pluck();

        return view('store_ratings.create', compact('stores', 'users'));
    }

    /**
     * Store a newly created StoreRating in storage.
     *
     * @param CreateStoreRatingRequest $request
     *
     * @return Response
     */
    public function store(CreateStoreRatingRequest $request)
    {
        $input = $request->all();

        $storeRating = $this->storeRatingRepository->create($input);

        Flash::success(trans('storeRating.messages.created'));

        return redirect(route('storeRatings.index'));
    }

    /**
     * Display the specified StoreRating.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $storeRating = $this->storeRatingRepository->find($id);

        if (empty($storeRating)) {
            Flash::error(trans('storeRating.messages.not_found'));

            return redirect(route('storeRatings.index'));
        }

        return view('store_ratings.show')->with('storeRating', $storeRating);
    }

    /**
     * Show the form for editing the specified StoreRating.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $storeRating = $this->storeRatingRepository->find($id);

        if (empty($storeRating)) {
            Flash::error(trans('storeRating.messages.not_found'));

            return redirect(route('storeRatings.index'));
        }

        $stores = (new StoreRepository())->pluck($this->language);
        $users = (new UserRepository(app()))->pluck();

        return view('store_ratings.edit', compact('stores', 'users', 'storeRating'));
    }

    /**
     * Update the specified StoreRating in storage.
     *
     * @param  int              $id
     * @param UpdateStoreRatingRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStoreRatingRequest $request)
    {
        $storeRating = $this->storeRatingRepository->find($id);

        if (empty($storeRating)) {
            Flash::error(trans('storeRating.messages.not_found'));

            return redirect(route('storeRatings.index'));
        }

        $storeRating = $this->storeRatingRepository->update($request->all(), $id);

        Flash::success(trans('storeRating.messages.updated'));

        return redirect(route('storeRatings.index'));
    }

    /**
     * Remove the specified StoreRating from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $storeRating = $this->storeRatingRepository->find($id);

        if (empty($storeRating)) {
                Flash::error(trans('storeRating.messages.not_found'));

            return redirect(route('storeRatings.index'));
        }
        
        $flag = $this->storeRatingRepository->delete($id);

        if($flag != false){
            Flash::success(trans('storeRating.messages.deleted'));
        }

        return redirect(route('storeRatings.index'));
    }
}
