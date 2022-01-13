<?php
/**
 * Store controller class which handel more of business actions
 *
 * @author Amk El-Kabbany at 8 June 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Controllers;

use App\Core\Controllers\CustomizedAppBaseController;
use App\DataTables\SupportTicketDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateSupportTicketRequest;
use App\Http\Requests\UpdateSupportTicketRequest;
use App\Repositories\SupportTicketRepository;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Laracasts\Flash\Flash;

class SupportTicketController extends CustomizedAppBaseController 
{
    /** @var  SupportTicketRepository */
    private $supportTicketRepository;

    /**
     * Current Logged User Selected Language Prefix
     *
     * @var string
     *
     * @author Amk El-Kabbany at 8 June 2020
     * @contact alaa@upbeatdigital.team
     */
    protected $language;

    public function __construct(SupportTicketRepository $supportTicketRepo)
    {
        parent::__construct();
        $this->supportTicketRepository = $supportTicketRepo;
        $this->language = Config::get('languages')[Request::ip()]['admin'];
    }

    /**
     * Display a listing of the SupportTicket.
     *
     * @param SupportTicketDataTable $supportTicketDataTable
     * @return Response
     */
    public function index(SupportTicketDataTable $supportTicketDataTable)
    {
        return $supportTicketDataTable->render('support_tickets.index');
    }

    /**
     * Show the form for creating a new SupportTicket.
     *
     * @return Response
     */
    public function create()
    {
        return view('support_tickets.create');
    }

    /**
     * Store a newly created SupportTicket in storage.
     *
     * @param CreateSupportTicketRequest $request
     *
     * @return Response
     */
    public function store(CreateSupportTicketRequest $request)
    {
        $input = $request->all();

        $supportTicket = $this->supportTicketRepository->create($input);

        Flash::success(trans('supportTicket.messages.created'));

        return redirect(route('supportTickets.index'));
    }

    /**
     * Display the specified SupportTicket.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $supportTicket = $this->supportTicketRepository->find($id);

        if (empty($supportTicket)) {
            Flash::error(trans('supportTicket.messages.not_found'));

            return redirect(route('supportTickets.index'));
        }

        return view('support_tickets.show')->with('supportTicket', $supportTicket);
    }

    /**
     * Show the form for editing the specified SupportTicket.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $supportTicket = $this->supportTicketRepository->find($id);

        if (empty($supportTicket)) {
            Flash::error(trans('supportTicket.messages.not_found'));

            return redirect(route('supportTickets.index'));
        }

        return view('support_tickets.edit')->with('supportTicket', $supportTicket);
    }

    /**
     * Update the specified SupportTicket in storage.
     *
     * @param  int              $id
     * @param UpdateSupportTicketRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSupportTicketRequest $request)
    {
        $supportTicket = $this->supportTicketRepository->find($id);

        if (empty($supportTicket)) {
            Flash::error(trans('supportTicket.messages.not_found'));

            return redirect(route('supportTickets.index'));
        }

        $supportTicket = $this->supportTicketRepository->update($request->all(), $id);

        Flash::success(trans('supportTicket.messages.updated'));

        return redirect(route('supportTickets.index'));
    }

    /**
     * Remove the specified SupportTicket from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $supportTicket = $this->supportTicketRepository->find($id);

        if (empty($supportTicket)) {
            Flash::error(trans('supportTicket.messages.not_found'));

            return redirect(route('supportTickets.index'));
        }

        $this->supportTicketRepository->delete($id);

        Flash::success(trans('supportTicket.messages.deleted'));

        return redirect(route('supportTickets.index'));
    }
}
