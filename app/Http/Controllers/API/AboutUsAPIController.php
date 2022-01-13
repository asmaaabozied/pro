<?php
/**
 * About us API controller class which handel more of business actions
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

class AboutUsAPIController extends AppBaseController
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
     * GET|HEAD /aboutuses
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $aboutuses = AboutUs::where('deleted_at', null)->where('slug', 'about-us')->get();

        return $this->sendResponse(AboutUsResource::toArray($aboutuses, $this->language), trans('aboutus.messages.retrieved'));
    }

    /**
     * Store a newly created AboutUs in storage.
     * POST /aboutuses
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

        $input['slug'] = 'about-us';
        $aboutus = new AboutUs();
        $aboutus->fill($input)->save();

        if (! $aboutus) {
            return $this->sendError(BaseAPI::handelFlashErrors(trans('aboutus.messages.errors.created')));
        }

        return $this->sendResponse(AboutUsResource::toArray($aboutus, $this->language), trans('aboutus.messages.created'));
    }

    /**
     * Display the specified AboutUs.
     * GET|HEAD /about-us
     *
     * @return Response
     */
    public function show()
    {
        /** @var AboutUs $aboutUs */
        $aboutus = AboutUs::find(1);

        if (empty($aboutus) || $aboutus->slug != 'about-us') {
            return $this->sendError(trans('aboutus.messages.not_found'));
        }

        return $this->sendResponse(AboutUsResource::toArray($aboutus, $this->language), trans('aboutus.messages.retrieved'));
    }

    /**
     * Update the specified AboutUs in storage.
     * PUT/PATCH /aboutuses/{id}
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

        $aboutus = AboutUs::find($id);
        if (empty($aboutus) || $aboutus->slug != 'about-us') {
            return $this->sendError(trans('aboutus.messages.not_found'));
        }
        $aboutus->fill($input)->save();

        if (! $aboutus) {
            return $this->sendError(BaseAPI::handelFlashErrors(trans('aboutus.messages.errors.updated')));
        }

        return $this->sendResponse(AboutUsResource::toArray($aboutus, $this->language), trans('aboutus.messages.updated'));
    }

    /**
     * Remove the specified AboutUs from storage.
     * DELETE /aboutuses/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {

        /** @var AboutUs $aboutus */
        $aboutus = AboutUs::find($id);

        if (empty($aboutus)) {
            return $this->sendError(trans('aboutus.messages.not_found'));
        }

        if (in_array($id, [1,2])) {
            return $this->sendError(trans('aboutus.messages.errors.can_not_deleted'));
        }

        $aboutus->delete();

        return $this->sendSuccess(trans('aboutus.messages.deleted'));
    }
}
