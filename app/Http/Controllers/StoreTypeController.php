<?php
/**
 * Store Type controller class which handel more of business actions
 *
 * @author Amk El-Kabbany at 7 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Controllers;

use App\Core\Controllers\CustomizedAppBaseController;
use App\DataTables\StoreTypeDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateStoreTypeRequest;
use App\Http\Requests\UpdateStoreTypeRequest;
use App\Repositories\StoreTypeRepository;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Laracasts\Flash\Flash;

class StoreTypeController extends CustomizedAppBaseController
{
    /** @var  StoreTypeRepository */
    private $storeTypeRepository;

    /**
     * Current Logged User Selected Language Prefix
     *
     * @var string
     *
     * @author Amk El-Kabbany at 7 May 2020
     * @contact alaa@upbeatdigital.team
     */
    protected $language;

    public function __construct(StoreTypeRepository $storeTypeRepo)
    {
        parent::__construct();
        $this->storeTypeRepository = $storeTypeRepo;
        $this->language = Config::get('languages')[Request::ip()]['admin'];
    }

    /**
     * Display a listing of the StoreType.
     *
     * @param StoreTypeDataTable $storeTypeDataTable
     * @return Response
     */
    public function index(StoreTypeDataTable $storeTypeDataTable)
    {
        return $storeTypeDataTable->render('store_types.index');
    }

    /**
     * Show the form for creating a new StoreType.
     *
     * @return Response
     */
    public function create()
    {
        return view('store_types.create');
    }

    /**
     * Store a newly created StoreType in storage.
     *
     * @param CreateStoreTypeRequest $request
     *
     * @return Response
     */
    public function store(CreateStoreTypeRequest $request)
    {
        $input = $request->all();

        $storeType = $this->storeTypeRepository->create($input);


        Flash::success(trans('storeType.messages.created'));

        return redirect(route('storeTypes.index'));
    }

    /**
     * Display the specified StoreType.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $storeType = $this->storeTypeRepository->find($id);

        if (empty($storeType)) {
            Flash::error(trans('storeType.messages.not_found'));

            return redirect(route('storeTypes.index'));
        }

        return view('store_types.show')->with('storeType', $storeType);
    }

    /**
     * Show the form for editing the specified StoreType.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $storeType = $this->storeTypeRepository->find($id);

        if (empty($storeType)) {
            Flash::error(trans('storeType.messages.not_found'));

            return redirect(route('storeTypes.index'));
        }

        return view('store_types.edit')->with('storeType', $storeType);
    }

    /**
     * Update the specified StoreType in storage.
     *
     * @param  int              $id
     * @param UpdateStoreTypeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStoreTypeRequest $request)
    {
        $storeType = $this->storeTypeRepository->find($id);

        if (empty($storeType)) {
            Flash::error(trans('storeType.messages.not_found'));

            return redirect(route('storeTypes.index'));
        }

        $storeType = $this->storeTypeRepository->update($request->all(), $id);

        Flash::success(trans('storeType.messages.updated'));

        return redirect(route('storeTypes.index'));
    }

    /**
     * Remove the specified StoreType from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $storeType = $this->storeTypeRepository->find($id);

        if (empty($storeType)) {
            Flash::error(trans('storeType.messages.not_found'));

            return redirect(route('storeTypes.index'));
        }

        $flag = $this->storeTypeRepository->delete($id);

        if($flag){
            Flash::success(trans('storeType.messages.deleted'));
        }

        return redirect(route('storeTypes.index'));
    }
}
