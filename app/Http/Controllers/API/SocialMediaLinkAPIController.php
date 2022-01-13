<?php
/**
 * Social Media Link API controller class which handel more of business actions
 *
 * @author Amk El-Kabbany at 8 June 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Controllers\API;

use App\Core\Controllers\APIs\BaseAPI;
use App\Http\Resources\SocialMediaLinkResource;
use App\Models\SocialMediaLink;
use App\Repositories\SocialMediaLinkRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

/**
 * Class SocialMediaLinkController
 * @package App\Http\Controllers\API
 *
 * @author Amk El-Kabbany at 8 June 2020
 * @contact alaa@upbeatdigital.team
 */

class SocialMediaLinkAPIController extends AppBaseController
{
    /** @var  SocialMediaLinkRepository */
    private $socialMediaLinkRepository;

    /**
     * Current Logged User Selected Language Prefix
     *
     * @var string
     *
     * @author Amk El-Kabbany at 8 June 2020
     * @contact alaa@upbeatdigital.team
     */
    protected $language;

    public function __construct(SocialMediaLinkRepository $socialMediaLinkRepo)
    {
        $this->socialMediaLinkRepository = $socialMediaLinkRepo;
        $this->language = request()->header('Accept-Language');
    }

    /**
     * Display a listing of the SocialMediaLink.
     * GET|HEAD /socialMediaLinks
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $socialMediaLinks = $this->socialMediaLinkRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(SocialMediaLinkResource::toArray($socialMediaLinks, $this->language), trans('socialMediaLink.messages.retrieved'));
    }

    /**
     * Store a newly created SocialMediaLink in storage.
     * POST /socialMediaLinks
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $input = SocialMediaLinkResource::casts($request->all(), $this->language);

        $validator = Validator::make($input, SocialMediaLink::$rules);

        if($validator->fails()){
            return $this->sendError(BaseAPI::handelValidationErrors($validator->errors()));
        }

        $socialMediaLink = $this->socialMediaLinkRepository->create($input);

        if (! $socialMediaLink) {
            return $this->sendError(BaseAPI::handelFlashErrors(trans('socialMediaLink.messages.errors.created')));
        }

        return $this->sendResponse(SocialMediaLinkResource::toArray($socialMediaLink, $this->language), trans('socialMediaLink.messages.created'));
    }

    /**
     * Display the specified SocialMediaLink.
     * GET|HEAD /socialMediaLinks/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var SocialMediaLink $socialMediaLink */
        $socialMediaLink = $this->socialMediaLinkRepository->find($id);

        if (empty($socialMediaLink)) {
            return $this->sendError(trans('socialMediaLink.messages.not_found'));
        }

        return $this->sendResponse(SocialMediaLinkResource::toArray($socialMediaLink, $this->language), trans('socialMediaLink.messages.retrieved'));
    }

    /**
     * Update the specified SocialMediaLink in storage.
     * PUT/PATCH /socialMediaLinks/{id}
     *
     * @param int $id
     * @param Request $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $input = SocialMediaLinkResource::casts($request->all(), $this->language, $id);

        $validator = Validator::make($input, SocialMediaLink::$rules);

        if($validator->fails()){
            return $this->sendError(BaseAPI::handelValidationErrors($validator->errors()));
        }

        if (empty($this->socialMediaLinkRepository->find($id))) {
            return $this->sendError(trans('socialMediaLink.messages.not_found'));
        }

        $socialMediaLink = $this->socialMediaLinkRepository->update($input, $id);

        if (! $socialMediaLink) {
            return $this->sendError(BaseAPI::handelFlashErrors(trans('socialMediaLink.messages.errors.updated')));
        }

        return $this->sendResponse(SocialMediaLinkResource::toArray($socialMediaLink, $this->language), trans('socialMediaLink.messages.updated'));
    }

    /**
     * Remove the specified SocialMediaLink from storage.
     * DELETE /socialMediaLinks/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var SocialMediaLink $socialMediaLink */
        $socialMediaLink = $this->socialMediaLinkRepository->find($id);

        if (empty($socialMediaLink)) {
            return $this->sendError(trans('socialMediaLink.messages.not_found'));
        }

        $socialMediaLink->delete();

        return $this->sendSuccess(trans('socialMediaLink.messages.deleted'));
    }
}
