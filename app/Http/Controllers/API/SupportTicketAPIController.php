<?php
/**
 * Support Ticket API controller class which handel more of business actions
 *
 * @author Amk El-Kabbany at 8 June 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Controllers\API;

use App\Core\Controllers\APIs\BaseAPI;
use App\Http\Resources\SupportTicketResource;
use App\Models\SupportTicket;
use App\Repositories\SupportTicketRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

/**
 * Class SupportTicketController
 * @package App\Http\Controllers\API
 *
 * @author Amk El-Kabbany at 8 June 2020
 * @contact alaa@upbeatdigital.team
 */

class SupportTicketAPIController extends AppBaseController
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
        $this->supportTicketRepository = $supportTicketRepo;
        $this->language = request()->header('Accept-Language');
    }

    /**
     * Display a listing of the SupportTicket.
     * GET|HEAD /supportTickets
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $supportTickets = $this->supportTicketRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(SupportTicketResource::toArray($supportTickets), trans('supportTicket.messages.retrieved'));
    }

    /**
     * Store a newly created SupportTicket in storage.
     * POST /supportTickets
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {

        $input = $request->all();

        $validator = Validator::make($input, SupportTicket::$rules);

        if($validator->fails()){
            return $this->sendError(BaseAPI::handelValidationErrors($validator->errors()));
        }
        if(! key_exists($input['type'], trans('supportTicket.types_api'))){
            return $this->sendError(trans('supportTicket.messages.errors.type'));
        }

        $input['type'] = trans('supportTicket.types_api')[intval($input['type'])];

        $supportTicket = $this->supportTicketRepository->create($input);

        if (! $supportTicket) {
            return $this->sendError(BaseAPI::handelFlashErrors(trans('supportTicket.messages.errors.created')));
        }

        return $this->sendResponse(SupportTicketResource::toArray($supportTicket), trans('supportTicket.messages.created'));
    }

    /**
     * Display the specified SupportTicket.
     * GET|HEAD /supportTickets/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var SupportTicket $supportTicket */
        $supportTicket = $this->supportTicketRepository->find($id);

        if (empty($supportTicket)) {
            return $this->sendError(trans('supportTicket.messages.not_found'));
        }

        return $this->sendResponse(SupportTicketResource::toArray($supportTicket), trans('supportTicket.messages.retrieved'));
    }

    /**
     * Update the specified SupportTicket in storage.
     * PUT/PATCH /supportTickets/{id}
     *
     * @param int $id
     * @param Request $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $input = SupportTicketResource::casts($request->all(), $id);

        $validator = Validator::make($input, SupportTicket::$rules);

        if($validator->fails()){
            return $this->sendError(BaseAPI::handelValidationErrors($validator->errors()));
        }

        if (empty($this->supportTicketRepository->find($id))) {
            return $this->sendError(trans('supportTicket.messages.not_found'));
        }

        $supportTicket = $this->supportTicketRepository->update($input, $id);

        if (! $supportTicket) {
            return $this->sendError(BaseAPI::handelFlashErrors(trans('supportTicket.messages.errors.updated')));
        }

        return $this->sendResponse(SupportTicketResource::toArray($supportTicket, $this->language), trans('supportTicket.messages.updated'));
    }

    /**
     * Remove the specified SupportTicket from storage.
     * DELETE /supportTickets/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var SupportTicket $supportTicket */
        $supportTicket = $this->supportTicketRepository->find($id);

        if (empty($supportTicket)) {
            return $this->sendError(trans('supportTicket.messages.not_found'));
        }

        $supportTicket->delete();

        return $this->sendSuccess(trans('supportTicket.messages.deleted'));
    }
}
