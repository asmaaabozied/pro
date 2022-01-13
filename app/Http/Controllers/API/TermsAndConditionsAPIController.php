<?php
/**
 * Terms And Policy API controller class which handel more of business actions
 *
 * @author Amk El-Kabbany at 7 June 2020
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
 * @author Amk El-Kabbany at 7 June 2020
 * @contact alaa@upbeatdigital.team
 */

class TermsAndConditionsAPIController extends AppBaseController
{
    /**
     * Current Logged User Selected Language Prefix
     *
     * @var string
     *
     * @author Amk El-Kabbany at 7 June 2020
     * @contact alaa@upbeatdigital.team
     */
    protected $language;

    public function __construct()
    {
        $this->language = request()->header('Accept-Language');
    }

    /**
     * Display a listing of the AboutUs.
     * GET|HEAD /terms-and-conditions
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $termsAndPolicies = AboutUs::where('deleted_at', null)->where('slug', 'terms-and-conditions')->get();

        return $this->sendResponse(AboutUsResource::toArray($termsAndPolicies, $this->language), trans('aboutus.messages.retrieved'));
    }

    /**
     * Store a newly created AboutUs in storage.
     * POST /terms-and-conditions
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

        $input['slug'] = 'terms-and-conditions';
        $termsAndPolicy = new AboutUs();
        $termsAndPolicy->fill($input)->save();

        if (! $termsAndPolicy) {
            return $this->sendError(BaseAPI::handelFlashErrors(trans('aboutus.messages.errors.created')));
        }

        return $this->sendResponse(AboutUsResource::toArray($termsAndPolicy, $this->language), trans('aboutus.messages.created'));
    }

    /**
     * Display the specified AboutUs.
     * GET|HEAD /terms-and-conditions
     *
     * @return Response
     */
    public function show()
    {
        /** @var AboutUs $termsAndPolicy */
        $termsAndPolicy = AboutUs::find(2);

        if (empty($termsAndPolicy) || $termsAndPolicy->slug != 'terms-and-conditions') {
            return $this->sendError(trans('aboutus.messages.not_found'));
        }

        return $this->sendResponse(AboutUsResource::toArray($termsAndPolicy, $this->language), trans('aboutus.messages.retrieved'));
    }

    /**
     * Update the specified AboutUs in storage.
     * PUT/PATCH /terms-and-conditions/{id}
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

        $termsAndPolicy = AboutUs::find($id);
        if (empty($termsAndPolicy) || $termsAndPolicy->slug != 'terms-and-conditions') {
            return $this->sendError(trans('aboutus.messages.not_found'));
        }
        $termsAndPolicy->fill($input)->save();

        if (! $termsAndPolicy) {
            return $this->sendError(BaseAPI::handelFlashErrors(trans('aboutus.messages.errors.updated')));
        }

        return $this->sendResponse(AboutUsResource::toArray($termsAndPolicy, $this->language), trans('aboutus.messages.updated'));
    }

    /**
     * Remove the specified AboutUs from storage.
     * DELETE /terms-and-conditions/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {

        /** @var AboutUs $termsAndPolicy */
        $termsAndPolicy = AboutUs::find($id);

        if (empty($termsAndPolicy) || $termsAndPolicy->slug != 'terms-and-conditions') {
            return $this->sendError(trans('aboutus.messages.not_found'));
        }

        if (in_array($id, [1,2])) {
            return $this->sendError(trans('aboutus.messages.errors.can_not_deleted'));
        }

        $termsAndPolicy->delete();

        return $this->sendSuccess(trans('aboutus.messages.deleted'));
    }
}
