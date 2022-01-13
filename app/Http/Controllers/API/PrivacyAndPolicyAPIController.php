<?php
/**
 * Privacy And Policy API controller class which handel more of business actions
 *
 * @author Amk El-Kabbany at 22 June 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Controllers\API;

use App\Core\Controllers\APIs\BaseAPI;
use App\Http\Resources\AboutUsResource;
use App\Models\AboutUs;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

/**
 * Class AboutUsController
 * @package App\Http\Controllers\API
 *
 * @author Amk El-Kabbany at 22 June 2020
 * @contact alaa@upbeatdigital.team
 */

class PrivacyAndPolicyAPIController extends AppBaseController
{
    /**
     * Current Logged User Selected Language Prefix
     *
     * @var string
     *
     * @author Amk El-Kabbany at 22 June 2020
     * @contact alaa@upbeatdigital.team
     */
    protected $language;

    public function __construct()
    {
        $this->language = request()->header('Accept-Language');
    }

    /**
     * Display a listing of the AboutUs.
     * GET|HEAD /privacy-and-policy
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $privacyAndPolicies = AboutUs::where('deleted_at', null)->where('slug', 'privacy-and-policy')->get();

        return $this->sendResponse(AboutUsResource::toArray($privacyAndPolicies, $this->language), trans('aboutus.messages.retrieved'));
    }

    /**
     * Store a newly created AboutUs in storage.
     * POST /privacy-and-policy
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $input = AboutUsResource::casts($request->all(), $this->language);

        $validator = Validator::make($input, AboutUs::$rules);

        if($validator->fails()){
            return $this->sendError(BaseAPI::handelValidationErrors($validator->errors()));
        }

        $input['slug'] = 'privacy-and-policy';
        $privacyAndPolicy = new AboutUs();
        $privacyAndPolicy->fill($input)->save();

        if (! $privacyAndPolicy) {
            return $this->sendError(BaseAPI::handelFlashErrors(trans('aboutus.messages.errors.created')));
        }

        return $this->sendResponse(AboutUsResource::toArray($privacyAndPolicy, $this->language), trans('aboutus.messages.created'));
    }

    /**
     * Display the specified AboutUs.
     * GET|HEAD /privacy-and-policy
     *
     * @return Response
     */
    public function show()
    {
        /** @var AboutUs $privacyAndPolicy */
        $privacyAndPolicy = AboutUs::find(3);

        if (empty($privacyAndPolicy) || $privacyAndPolicy->slug != 'privacy-and-policy') {
            return $this->sendError(trans('aboutus.messages.not_found'));
        }

        return $this->sendResponse(AboutUsResource::toArray($privacyAndPolicy, $this->language), trans('aboutus.messages.retrieved'));
    }

    /**
     * Update the specified AboutUs in storage.
     * PUT/PATCH /privacy-and-policy/{id}
     *
     * @param int $id
     * @param Request $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $input = AboutUsResource::casts($request->all(), $this->language, $id);

        $validator = Validator::make($input, AboutUs::$rules);

        if($validator->fails()){
            return $this->sendError(BaseAPI::handelValidationErrors($validator->errors()));
        }

        $privacyAndPolicy = AboutUs::find($id);
        if (empty($privacyAndPolicy) || $privacyAndPolicy->slug != 'privacy-and-policy') {
            return $this->sendError(trans('aboutus.messages.not_found'));
        }
        $privacyAndPolicy->fill($input)->save();

        if (! $privacyAndPolicy) {
            return $this->sendError(BaseAPI::handelFlashErrors(trans('aboutus.messages.errors.updated')));
        }

        return $this->sendResponse(AboutUsResource::toArray($privacyAndPolicy, $this->language), trans('aboutus.messages.updated'));
    }

    /**
     * Remove the specified AboutUs from storage.
     * DELETE /privacy-and-policy/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {

        /** @var AboutUs $privacyAndPolicy */
        $privacyAndPolicy = AboutUs::find($id);

        if (empty($privacyAndPolicy) || $privacyAndPolicy->slug != 'privacy-and-policy') {
            return $this->sendError(trans('aboutus.messages.not_found'));
        }

        if (in_array($id, [1,2])) {
            return $this->sendError(trans('aboutus.messages.errors.can_not_deleted'));
        }

        $privacyAndPolicy->delete();

        return $this->sendSuccess(trans('aboutus.messages.deleted'));
    }
}
