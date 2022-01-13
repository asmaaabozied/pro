<?php
/**
 * Voucher API controller class which handel more of business actions
 *
 * @author Amk El-Kabbany at 31 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Controllers\API;

use App\Core\Controllers\APIs\BaseAPI;
use App\Http\Resources\VoucherResource;
use App\Models\Voucher;
use App\Repositories\VoucherRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

/**
 * Class VoucherController
 * @package App\Http\Controllers\API
 *
 * @author Amk El-Kabbany at 31 May 2020
 * @contact alaa@upbeatdigital.team
 */

class VoucherAPIController extends AppBaseController
{
    /** @var  VoucherRepository */
    private $voucherRepository;

    /**
     * Current Logged User Selected Language Prefix
     *
     * @var string
     *
     * @author Amk El-Kabbany at 31 May 2020
     * @contact alaa@upbeatdigital.team
     */
    protected $language;

    public function __construct(VoucherRepository $voucherRepo)
    {
        $this->voucherRepository = $voucherRepo;
        $this->language = request()->header('Accept-Language');
    }

    /**
     * Display a listing of the Voucher.
     * GET|HEAD /vouchers
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $vouchers = $this->voucherRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(VoucherResource::toArray($vouchers, $this->language), trans('voucher.messages.retrieved'));
    }

    /**
     * Validate given voucher code
     * POST /validate-voucher
     *
     * @return Response
     *
     * @author Amk El-Kabbany at 8 July 2020
     * @contact alaa@upbeatdigital.team
     */
    public function validateVoucher()
    {
        $user = (new UserRepository(app()))->findByToken(request()->bearerToken());
        if($user == null){
            return $this->sendError(trans('user.messages.errors.login'));
        }
        $input = request()->input();
        $input['user_id'] = $user->id;
        $voucher = $this->voucherRepository->validateVoucher($input);
        if($voucher == false){
            return $this->sendError(trans('voucher.messages.not_valid'));
        }
        return $this->sendResponse(VoucherResource::toArray($voucher, $this->language), trans('voucher.messages.valid'));
    }

    /**
     * Retrieve a pluck of the Brand.
     * GET|HEAD /brands
     *
     * @param  boolean $activated
     * @return Response
     *
     * @author Amk El-Kabbany at 17 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function pluck($activated = null)
    {
        $vouchers = $this->voucherRepository->pluck($this->language, $activated);
        return $this->sendResponse($vouchers, trans('voucher.messages.retrieved'));
    }

    /**
     * Voucher a newly created Voucher in storage.
     * POST /vouchers
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {

        $input = VoucherResource::casts($request->all(), $this->language);

        $validator = Validator::make($input, Voucher::$rules);

        if($validator->fails()){
            return $this->sendError(BaseAPI::handelValidationErrors($validator->errors()));
        }

        $voucher = $this->voucherRepository->create($input);

        if (! $voucher) {
            return $this->sendError(BaseAPI::handelFlashErrors(trans('voucher.messages.errors.created')));
        }

        return $this->sendResponse(VoucherResource::toArray($voucher, $this->language), trans('voucher.messages.created'));
    }

    /**
     * Display the specified Voucher.
     * GET|HEAD /vouchers/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Voucher $voucher */
        $voucher = $this->voucherRepository->find($id);

        if (empty($voucher)) {
            return $this->sendError(trans('voucher.messages.not_found'));
        }

        return $this->sendResponse(VoucherResource::toArray($voucher, $this->language), trans('voucher.messages.retrieved'));
    }

    /**
     * Update the specified Voucher in storage.
     * PUT/PATCH /vouchers/{id}
     *
     * @param int $id
     * @param Request $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $input = VoucherResource::casts($request->all(), $this->language, $id);

        $validator = Validator::make($input, Voucher::$rules);

        if($validator->fails()){
            return $this->sendError(BaseAPI::handelValidationErrors($validator->errors()));
        }

        if (empty($this->voucherRepository->find($id))) {
            return $this->sendError(trans('voucher.messages.not_found'));
        }

        $voucher = $this->voucherRepository->update($input, $id);

        if (! $voucher) {
            return $this->sendError(BaseAPI::handelFlashErrors(trans('voucher.messages.errors.updated')));
        }

        return $this->sendResponse(VoucherResource::toArray($voucher, $this->language), trans('voucher.messages.updated'));
    }

    /**
     * Remove the specified Voucher from storage.
     * DELETE /vouchers/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Voucher $voucher */
        $voucher = $this->voucherRepository->find($id);

        if (empty($voucher)) {
            return $this->sendError(trans('voucher.messages.not_found'));
        }

        $voucher->delete();

        return $this->sendSuccess(trans('voucher.messages.deleted'));
    }
}
