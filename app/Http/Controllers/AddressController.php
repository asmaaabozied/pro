<?php
/**
 * Address controller class which handel more of business actions
 *
 * @author Amk El-Kabbany at 9 July 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Controllers;

use App\Core\Controllers\CustomizedAppBaseController;
use App\DataTables\AddressDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateAddressRequest;
use App\Http\Requests\UpdateAddressRequest;
use App\Repositories\AddressRepository;
use App\Repositories\CountryRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Laracasts\Flash\Flash;

class AddressController extends CustomizedAppBaseController
{
    /** @var  AddressRepository */
    private $addressRepository;

    /**
     * Current Logged User Selected Language Prefix
     *
     * @var string
     *
     * @author Amk El-Kabbany at 9 July 2020
     * @contact alaa@upbeatdigital.team
     */
    protected $language;

    public function __construct(AddressRepository $addressRepo)
    {
        parent::__construct();
        $this->addressRepository = $addressRepo;
        $this->language = Config::get('languages')[Request::ip()]['admin'];

    }

    /**
     * Display a listing of the Address.
     *
     * @param AddressDataTable $addressDataTable
     * @return Response
     */
    public function index(AddressDataTable $addressDataTable)
    {
        return $addressDataTable->render('addresses.index');
    }

    /**
     * Show the form for creating a new Address.
     *
     * @return Response
     */
    public function create()
    {
        $users = (new UserRepository(app()))->pluck();
        $countries = (new CountryRepository())->pluck($this->language);

        return view('addresses.create', compact('users', 'countries'));

    }

    /**
     * Store a newly created Address in storage.
     *
     * @param CreateAddressRequest $request
     *
     * @return Response
     */
    public function store(CreateAddressRequest $request)
    {
        $input = $request->all();

        $address = $this->addressRepository->create($input);

        Flash::success(trans('address.messages.created'));

        return redirect(route('addresses.index'));
    }

    /**
     * Display the specified Address.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $address = $this->addressRepository->find($id);

        if (empty($address)) {
            Flash::error(trans('address.messages.not_found'));

            return redirect(route('addresses.index'));
        }

        return view('addresses.show')->with('address', $address);
    }

    /**
     * Show the form for editing the specified Address.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $address = $this->addressRepository->find($id);

        if (empty($address)) {
            Flash::error(trans('address.messages.not_found'));

            return redirect(route('addresses.index'));
        }

        $users = (new UserRepository(app()))->pluck();
        $countries = (new CountryRepository())->pluck($this->language);

        return view('addresses.edit', compact('address', 'users', 'countries'));
    }

    /**
     * Update the specified Address in storage.
     *
     * @param  int              $id
     * @param UpdateAddressRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAddressRequest $request)
    {
        $address = $this->addressRepository->find($id);

        if (empty($address)) {
            Flash::error(trans('address.messages.not_found'));

            return redirect(route('addresses.index'));
        }

        $address = $this->addressRepository->update($request->all(), $id);

        Flash::success(trans('address.messages.updated'));

        return redirect(route('addresses.index'));
    }

    /**
     * Remove the specified Address from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $address = $this->addressRepository->find($id);

        if (empty($address)) {
            Flash::error(trans('address.messages.not_found'));

            return redirect(route('addresses.index'));
        }

        $flag = $this->addressRepository->delete($id);

        if($flag){
            Flash::success(trans('address.messages.deleted'));
        }

        return redirect(route('addresses.index'));
    }
}
