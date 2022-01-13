<?php
/**
 * Store controller class which handel more of business actions
 *
 * @author Amk El-Kabbany at 7 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Controllers;

use App\Console\Commands\AlterApplicationSchemaLanguagesCommand;
use App\Core\Controllers\CustomizedAppBaseController;
use App\DataTables\StoreDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateStoreRequest;
use App\Http\Requests\UpdateStoreRequest;
use App\Models\StoreTermsAndPolicy;
use App\Models\StoreType;
use App\Repositories\StoreRepository;
use App\Repositories\StoreTypeRepository;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Laracasts\Flash\Flash;

class StoreController extends CustomizedAppBaseController
{
    /** @var  StoreRepository */
    private $storeRepository;

    /**
     * Current Logged User Selected Language Prefix
     *
     * @var string
     *
     * @author Amk El-Kabbany at 7 May 2020
     * @contact alaa@upbeatdigital.team
     */
    protected $language;

    public function __construct(StoreRepository $storeRepo)
    {
        parent::__construct();
        $this->storeRepository = $storeRepo;
        $this->language = Config::get('languages')[Request::ip()]['admin'];
    }

    /**
     * Display a listing of the Store.
     *
     * @param StoreDataTable $storeDataTable
     * @return Response
     */
    public function index(StoreDataTable $storeDataTable)
    {
        return $storeDataTable->render('stores.index');
    }

    /**
     * Show the form for creating a new Store.
     *
     * @return Response
     */
    public function create()
    {
        $types = (new StoreTypeRepository())->pluck($this->language);

        $owners = (new UserRepository(app()))->pluck();
        Config::set('paragraph_counter', '');
        Config::set('system_languages', ['']);


        return view('stores.create', compact('types', 'owners'));
    }

    /**
     * Store a newly created Store in storage.
     *
     * @param CreateStoreRequest $request
     *
     * @return Response
     */
    public function store(CreateStoreRequest $request)
    {
        $input = $request->all();

        $store = $this->storeRepository->create($input);

        Flash::success(trans('store.messages.created'));

        return redirect(route('stores.index'));
    }

    /**
     * Display the specified Store.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $store = $this->storeRepository->find($id);

        if (empty($store)) {
            Flash::error(trans('store.messages.not_found'));

            return redirect(route('stores.index'));
        }

        $types = (new StoreTypeRepository())->pluck($this->language);
        $owners = (new UserRepository(app()))->pluck();

        return view('stores.show', compact('types', 'owners', 'store'));
    }

    /**
     * Show the form for editing the specified Store.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $store = $this->storeRepository->find($id);

        if (empty($store)) {
            Flash::error(trans('store.messages.not_found'));

            return redirect(route('stores.index'));
        }

        $title = 'type_'.$this->language;
        $types = StoreType::where('deleted_at', null)->orderBy($title)->pluck($title, 'id');
        $owners = User::where('deleted_at', null)->orderBy('name')->pluck('name', 'id');
        Config::set('paragraph_counter', '');
        Config::set('system_languages', ['']);

        return view('stores.edit', compact('types', 'owners', 'store'));
    }

    /**
     * Update the specified Store in storage.
     *
     * @param  int              $id
     * @param UpdateStoreRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStoreRequest $request)
    {
        $store = $this->storeRepository->find($id);

        if (empty($store)) {
            Flash::error(trans('store.messages.not_found'));

            return redirect(route('stores.index'));
        }

        $store = $this->storeRepository->update($request->all(), $id);

        Flash::success(trans('store.messages.updated'));

        return redirect(route('stores.index'));
    }

    /**
     * Remove the specified Store from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $store = $this->storeRepository->find($id);

        if (empty($store)) {
            Flash::error(trans('store.messages.not_found'));

            return redirect(route('stores.index'));
        }

        $flag = $this->storeRepository->delete($id);

        if($flag){
            Flash::success(trans('store.messages.deleted'));
        }

        return redirect(route('stores.index'));
    }

    /**
     * <Ajax POST Action -.addParagraph js/script.blade.php->
     * Route action add new terms and policy paragraph to selected store
     *
     * @return array
     *
     * @author Amk El-Kabbany at 10 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function addParagraph() {
        $id = $_POST['id'];
        $paragraphs = [
            'store_id' => intval($id),
        ];
        $object = new StoreTermsAndPolicy();
        $object->fill($paragraphs)->save();
        return $object->id;
    }

    /**
     * <Ajax POST Action -.deleteParagraph js/script.blade.php->
     * Route action delete selected terms and policy paragraph from selected store
     *
     * @return boolean
     *
     * @author Amk El-Kabbany at 10 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function deleteParagraph() {
        $id = $_POST['id'];
        $paragraph = StoreTermsAndPolicy::find($id);
        $paragraph->delete();
        exit(json_encode(true));
    }

    /**
     * <Ajax POST Action -.title js/script.blade.php->
     * Route action edit selected store's terms and policy paragraph title
     *
     * @return array
     *
     * @author Amk El-Kabbany at 10 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function editParagraphTitle() {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $object = StoreTermsAndPolicy::find($id);
        $object->$name = $_POST['value'];
        $object->save();

        exit(json_encode([$name . $id]));
    }

    /**
     * <Ajax POST Action -.description js/script.blade.php->
     * Route action edit selected store's terms and policy paragraph description
     *
     * @return array
     *
     * @author Amk El-Kabbany at 10 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function editParagraphDescription() {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $object = StoreTermsAndPolicy::find($id);
        $object->$name = $_POST['value'];
        $object->save();

        exit(json_encode([$name . $id]));
    }

    /**
     * <Ajax POST Action -.active js/script.blade.php->
     * Route action edit selected store's terms and policy paragraph active attribute
     *
     * @return array
     *
     * @author Amk El-Kabbany at 10 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function editParagraphActive() {
        $id = $_POST['id'];
        $object = StoreTermsAndPolicy::find($id);
        $object->active = ($_POST['value'] == 'true') ? true : false;
        $object->save();

        exit(json_encode(['active' . $id]));
    }

    /**
     * <Ajax POST Action -.language js/script.blade.php->
     * Route action edit selected store's terms and policy paragraph language display option
     *
     * @return array
     *
     * @author Amk El-Kabbany at 10 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function editParagraphLanguage() {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $object = StoreTermsAndPolicy::find($id);
        $object->$name = ($_POST['value'] == 'true') ? true : false;
        $object->save();

        exit(json_encode(['language' . $id]));
    }
}
