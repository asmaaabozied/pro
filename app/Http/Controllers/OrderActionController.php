<?php

namespace App\Http\Controllers;

use App\DataTables\OrderActionDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateOrderActionRequest;
use App\Http\Requests\UpdateOrderActionRequest;
use App\Repositories\OrderActionRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class OrderActionController extends AppBaseController
{
    /** @var  OrderActionRepository */
    private $orderActionRepository;

    public function __construct(OrderActionRepository $orderActionRepo)
    {
        $this->orderActionRepository = $orderActionRepo;
    }

    /**
     * Display a listing of the OrderAction.
     *
     * @param OrderActionDataTable $orderActionDataTable
     * @return Response
     */
    public function index(OrderActionDataTable $orderActionDataTable)
    {
        return $orderActionDataTable->render('order_actions.index');
    }

    /**
     * Show the form for creating a new OrderAction.
     *
     * @return Response
     */
    public function create()
    {
        return view('order_actions.create');
    }

    /**
     * Store a newly created OrderAction in storage.
     *
     * @param CreateOrderActionRequest $request
     *
     * @return Response
     */
    public function store(CreateOrderActionRequest $request)
    {
        $input = $request->all();

        $orderAction = $this->orderActionRepository->create($input);

        Flash::success('Order Action saved successfully.');

        return redirect(route('orderActions.index'));
    }

    /**
     * Display the specified OrderAction.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $orderAction = $this->orderActionRepository->find($id);

        if (empty($orderAction)) {
            Flash::error('Order Action not found');

            return redirect(route('orderActions.index'));
        }

        return view('order_actions.show')->with('orderAction', $orderAction);
    }

    /**
     * Show the form for editing the specified OrderAction.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $orderAction = $this->orderActionRepository->find($id);

        if (empty($orderAction)) {
            Flash::error('Order Action not found');

            return redirect(route('orderActions.index'));
        }

        return view('order_actions.edit')->with('orderAction', $orderAction);
    }

    /**
     * Update the specified OrderAction in storage.
     *
     * @param  int              $id
     * @param UpdateOrderActionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOrderActionRequest $request)
    {
        $orderAction = $this->orderActionRepository->find($id);

        if (empty($orderAction)) {
            Flash::error('Order Action not found');

            return redirect(route('orderActions.index'));
        }

        $orderAction = $this->orderActionRepository->update($request->all(), $id);

        Flash::success('Order Action updated successfully.');

        return redirect(route('orderActions.index'));
    }

    /**
     * Remove the specified OrderAction from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $orderAction = $this->orderActionRepository->find($id);

        if (empty($orderAction)) {
            Flash::error('Order Action not found');

            return redirect(route('orderActions.index'));
        }

        $this->orderActionRepository->delete($id);

        Flash::success('Order Action deleted successfully.');

        return redirect(route('orderActions.index'));
    }
}
