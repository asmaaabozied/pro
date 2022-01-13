<?php
/**
 * Country API controller class which handel more of business actions
 *
 * @author Amk El-Kabbany at 17 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Controllers\API;

use App\Core\Controllers\APIs\BaseAPI;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\CountryResource;
use App\Models\Country;
use App\Repositories\CountryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

/**
 * Class CountryController
 * @package App\Http\Controllers\API
 *
 * @author Amk El-Kabbany at 17 May 2020
 * @contact alaa@upbeatdigital.team
 */

class CountryAPIController extends AppBaseController
{
    /** @var  CountryRepository */
    private $countryRepository;

    /**
     * Current Logged User Selected Language Prefix
     *
     * @var string
     *
     * @author Amk El-Kabbany at 17 May 2020
     * @contact alaa@upbeatdigital.team
     */
    protected $language;

    public function __construct(CountryRepository $countryRepo)
    {
        $this->countryRepository = $countryRepo;
        $this->language = request()->header('Accept-Language');
    }

    /**
     * Display a listing of the Country.
     * GET|HEAD /countries
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $countries = $this->countryRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(CountryResource::toArray($countries, $this->language), trans('country.messages.retrieved'));
    }

    /**
     * Retrieve a pluck of the Brand.
     * GET|HEAD /brands
     *
     * @return Response
     *
     * @author Amk El-Kabbany at 17 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function pluck()
    {
        $countries = $this->countryRepository->pluck($this->language);
        return $this->sendResponse($countries, trans('country.messages.retrieved'));
    }

    /**
     * Store a newly created Country in storage.
     * POST /countries
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $input = CountryResource::casts($request->all(), $this->language);

        $validator = Validator::make($input, Country::$rules);

        if($validator->fails()){
            return $this->sendError(BaseAPI::handelValidationErrors($validator->errors()));
        }

        $country = $this->countryRepository->create($input);

        if (! $country) {
            return $this->sendError(BaseAPI::handelFlashErrors(trans('country.messages.errors.created')));
        }

        return $this->sendResponse(CountryResource::toArray($country, $this->language), trans('country.messages.created'));
    }

    /**
     * Display the specified Country.
     * GET|HEAD /countries/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Country $country */
        $country = $this->countryRepository->find($id);

        if (empty($country)) {
            return $this->sendError(trans('country.messages.not_found'));
        }

        return $this->sendResponse(CountryResource::toArray($country, $this->language), trans('country.messages.retrieved'));
    }

    /**
     * Update the specified Country in storage.
     * PUT/PATCH /countries/{id}
     *
     * @param int $id
     * @param Request $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $input = CountryResource::casts($request->all(), $this->language, $id);

        $validator = Validator::make($input, Country::$rules);

        if($validator->fails()){
            return $this->sendError(BaseAPI::handelValidationErrors($validator->errors()));
        }

        if (empty($this->countryRepository->find($id))) {
            return $this->sendError(trans('country.messages.not_found'));
        }

        $country = $this->countryRepository->update($input, $id);

        if (! $country) {
            return $this->sendError(BaseAPI::handelFlashErrors(trans('country.messages.errors.updated')));
        }

        return $this->sendResponse(CountryResource::toArray($country, $this->language), trans('country.messages.updated'));
    }

    /**
     * Remove the specified Country from storage.
     * DELETE /countries/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Country $country */
        $country = $this->countryRepository->find($id);

        if (empty($country)) {
            return $this->sendError(trans('country.messages.not_found'));
        }

        $country->delete();

        return $this->sendSuccess(trans('country.messages.deleted'));
    }
}
