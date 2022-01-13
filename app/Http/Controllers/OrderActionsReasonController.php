<?php
/**
 * Order actions reason controller class which handel more of business actions
 *
 * @author Amk El-Kabbany at 14 July 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Controllers;

use App\Core\Controllers\CustomizedAppBaseController;
use App\DataTables\OrderActionsReasonDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateOrderActionsReasonRequest;
use App\Http\Requests\UpdateOrderActionsReasonRequest;
use App\Repositories\OrderActionsReasonRepository;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Laracasts\Flash\Flash;

class OrderActionsReasonController extends CustomizedAppBaseController
{
    /** @var  OrderActionsReasonRepository */
    private $orderActionsReasonRepository;

    /**
     * Current Logged User Selected Language Prefix
     *
     * @var string
     *
     * @author Amk El-Kabbany at 14 July 2020
     * @contact alaa@upbeatdigital.team
     */
    protected $language;

    public function __construct(OrderActionsReasonRepository $orderActionsReasonRepo)
    {
        parent::__construct();
        $this->orderActionsReasonRepository = $orderActionsReasonRepo;
        $this->language = Config::get('languages')[Request::ip()]['admin'];
    }

    /**
     * Display a listing of the OrderActionsReason.
     *
     * @param OrderActionsReasonDataTable $orderActionsReasonDataTable
     * @return Response
     */
    public function index(OrderActionsReasonDataTable $orderActionsReasonDataTable)
    {
        return $orderActionsReasonDataTable->render('order_actions_reasons.index');
    }

    /**
     * Show the form for creating a new OrderActionsReason.
     *
     * @return Response
     */
    public function create()
    {
        return view('order_actions_reasons.create');
    }

    /**
     * Store a newly created OrderActionsReason in storage.
     *
     * @param CreateOrderActionsReasonRequest $request
     *
     * @return Response
     */
    public function store(CreateOrderActionsReasonRequest $request)
    {
        $input = $request->all();

        $orderActionsReason = $this->orderActionsReasonRepository->create($input);

        Flash::success(trans('orderActionsReason.messages.created'));

        return redirect(route('orderActionsReasons.index'));
    }

    /**
     * Display the specified OrderActionsReason.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $orderActionsReason = $this->orderActionsReasonRepository->find($id);

        if (empty($orderActionsReason)) {
            Flash::error(trans('orderActionsReason.messages.not_found'));

            return redirect(route('orderActionsReasons.index'));
        }

        return view('order_actions_reasons.show')->with('orderActionsReason', $orderActionsReason);
    }

    /**
     * Show the form for editing the specified OrderActionsReason.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $orderActionsReason = $this->orderActionsReasonRepository->find($id);

        if (empty($orderActionsReason)) {
            Flash::error(trans('orderActionsReason.messages.not_found'));

            return redirect(route('orderActionsReasons.index'));
        }

        return view('order_actions_reasons.edit')->with('orderActionsReason', $orderActionsReason);
    }

    /**
     * Update the specified OrderActionsReason in storage.
     *
     * @param  int              $id
     * @param UpdateOrderActionsReasonRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOrderActionsReasonRequest $request)
    {
        $orderActionsReason = $this->orderActionsReasonRepository->find($id);

        if (empty($orderActionsReason)) {
            Flash::error(trans('orderActionsReason.messages.not_found'));

            return redirect(route('orderActionsReasons.index'));
        }

        $orderActionsReason = $this->orderActionsReasonRepository->update($request->all(), $id);

        Flash::success(trans('orderActionsReason.messages.updated'));

        return redirect(route('orderActionsReasons.index'));
    }

    /**
     * Remove the specified OrderActionsReason from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $orderActionsReason = $this->orderActionsReasonRepository->find($id);

        if (empty($orderActionsReason)) {
            Flash::error(trans('orderActionsReason.messages.not_found'));

            return redirect(route('orderActionsReasons.index'));
        }

        $this->orderActionsReasonRepository->delete($id);

        Flash::success(trans('orderActionsReason.messages.deleted'));

        return redirect(route('orderActionsReasons.index'));
    }
}
