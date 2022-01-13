<?php
/**
 * Voucher controller class which handel more of business actions
 *
 * @author Amk El-Kabbany at 31 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Controllers;

use App\Core\Controllers\CustomizedAppBaseController;
use App\DataTables\VoucherDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateVoucherRequest;
use App\Http\Requests\UpdateVoucherRequest;
use App\Repositories\VoucherRepository;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Laracasts\Flash\Flash;

class VoucherController extends CustomizedAppBaseController 
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
        parent::__construct();
        $this->voucherRepository = $voucherRepo;
        $this->language = Config::get('languages')[Request::ip()]['admin'];
    }

    /**
     * Display a listing of the Voucher.
     *
     * @param VoucherDataTable $voucherDataTable
     * @return Response
     */
    public function index(VoucherDataTable $voucherDataTable)
    {
        return $voucherDataTable->render('vouchers.index');
    }

    /**
     * Show the form for creating a new Voucher.
     *
     * @return Response
     */
    public function create()
    {
        return view('vouchers.create');
    }

    /**
     * Store a newly created Voucher in storage.
     *
     * @param CreateVoucherRequest $request
     *
     * @return Response
     */
    public function store(CreateVoucherRequest $request)
    {
        $input = $request->all();

        $voucher = $this->voucherRepository->create($input);

        Flash::success(trans('voucher.messages.created'));

        return redirect(route('vouchers.index'));
    }

    /**
     * Display the specified Voucher.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $voucher = $this->voucherRepository->find($id);

        if (empty($voucher)) {
            Flash::error(trans('voucher.messages.not_found'));

            return redirect(route('vouchers.index'));
        }

        return view('vouchers.show')->with('voucher', $voucher);
    }

    /**
     * Show the form for editing the specified Voucher.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $voucher = $this->voucherRepository->find($id);

        if (empty($voucher)) {
            Flash::error(trans('voucher.messages.not_found'));

            return redirect(route('vouchers.index'));
        }

        return view('vouchers.edit')->with('voucher', $voucher);
    }

    /**
     * Update the specified Voucher in storage.
     *
     * @param  int              $id
     * @param UpdateVoucherRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateVoucherRequest $request)
    {
        $voucher = $this->voucherRepository->find($id);

        if (empty($voucher)) {
            Flash::error(trans('voucher.messages.not_found'));

            return redirect(route('vouchers.index'));
        }

        $voucher = $this->voucherRepository->update($request->all(), $id);

        Flash::success(trans('voucher.messages.updated'));

        return redirect(route('vouchers.index'));
    }

    /**
     * Remove the specified Voucher from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $voucher = $this->voucherRepository->find($id);

        if (empty($voucher)) {
            Flash::error(trans('voucher.messages.not_found'));

            return redirect(route('vouchers.index'));
        }

        $this->voucherRepository->delete($id);

        Flash::success(trans('voucher.messages.deleted'));

        return redirect(route('vouchers.index'));
    }
}
