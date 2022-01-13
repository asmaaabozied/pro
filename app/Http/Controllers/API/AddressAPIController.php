<?php
/**
 * Address API controller class which handel more of business actions
 *
 * @author Amk El-Kabbany at 9 July 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Controllers\API;

use App\Core\Controllers\APIs\BaseAPI;
use App\Http\Resources\AddressResource;
use App\Models\Address;
use App\Repositories\AddressRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

/**
 * Class AddressController
 * @package App\Http\Controllers\API
 *
 * @author Amk El-Kabbany at 9 July 2020
 * @contact alaa@upbeatdigital.team
 */

class AddressAPIController extends AppBaseController
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
        $this->addressRepository = $addressRepo;
        $this->language = request()->header('Accept-Language');
    }

    /**
     * Display a listing of the Address.
     * GET|HEAD /addresses
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $addresses = $this->addressRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(AddressResource::toArray($addresses, $this->language), trans('address.messages.retrieved'));
    }

    /**
     * Display the specified productRatings.
     * GET|HEAD /addresses
     *
     * @return Response
     */
    public function lists()
    {
        $user = (new UserRepository(app()))->findByToken(request()->bearerToken());
        if($user == null){
            return $this->sendError(trans('user.messages.errors.login'));
        }
        
        /** @var Address $address */
        $address = $this->addressRepository->lists($user->id);

        if (empty($address)) {
            return $this->sendError(trans('user.messages.not_found'));
        }

        return $this->sendResponse(AddressResource::toArray($address, $this->language), trans('address.messages.retrieved'));
    }

    /**
     * Store a newly created Address in storage.
     * POST /addresses
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $user = (new UserRepository(app()))->findByToken(request()->bearerToken());
        if($user == null){
            return $this->sendError(trans('user.messages.errors.login'));
        }

        $input = $request->all();
        $input['user_id'] = $user->id;

        $validator = Validator::make($input, Address::$rules);

        if($validator->fails()){
            return $this->sendError(BaseAPI::handelValidationErrors($validator->errors()));
        }

        $address = $this->addressRepository->create($input);

        if (! $address) {
            return $this->sendError(BaseAPI::handelFlashErrors(trans('address.messages.errors.created')));
        }

        return $this->sendResponse(AddressResource::toArray($address, $this->language), trans('address.messages.created'));
    }

    /**
     * Display the specified Address.
     * GET|HEAD /addresses/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Address $address */
        $address = $this->addressRepository->find($id);
            
        if (empty($address)) {
            return $this->sendError(trans('address.messages.not_found'));
        }

        return $this->sendResponse(AddressResource::toArray($address, $this->language), trans('address.messages.retrieved'));
    }

    /**
     * Update the specified Address in storage.
     * PUT/PATCH /addresses/{id}
     *
     * @param int $id
     * @param Request $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $user = (new UserRepository(app()))->findByToken(request()->bearerToken());
        if($user == null){
            return $this->sendError(trans('user.messages.errors.login'));
        }


        if (empty($this->addressRepository->find($id))) {
            return $this->sendError(trans('address.messages.not_found'));
        }

        $input = $request->all();
        $input['user_id'] = $user->id;

        $input = AddressResource::casts($request->all(), $id);

        $validator = Validator::make($input, Address::$rules);

        if($validator->fails()){
            return $this->sendError(BaseAPI::handelValidationErrors($validator->errors()));
        }

        $address = $this->addressRepository->update($input, $id);

        if (! $address) {
            return $this->sendError(BaseAPI::handelFlashErrors(trans('address.messages.errors.updated')));
        }

        return $this->sendResponse(AddressResource::toArray($address, $this->language), trans('address.messages.updated'));
    }

    /**
     * Remove the specified Address from storage.
     * DELETE /addresses/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Address $address */
        $address = $this->addressRepository->find($id);

        if (empty($address)) {
            return $this->sendError(trans('address.messages.not_found'));
        }

        if ($address->main == true) {
            return $this->sendError(trans('address.messages.errors.main'));
        }

        $address->delete();

        return $this->sendSuccess(trans('address.messages.deleted'));
    }
}
