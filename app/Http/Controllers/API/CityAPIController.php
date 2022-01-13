<?php
/**
 * City API controller class which handel more of business actions
 *
 * @author Amk El-Kabbany at 17 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Controllers\API;

use App\Core\Controllers\APIs\BaseAPI;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\CityResource;
use App\Models\City;
use App\Repositories\CityRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

/**
 * Class CityController
 * @package App\Http\Controllers\API
 *
 * @author Amk El-Kabbany at 17 May 2020
 * @contact alaa@upbeatdigital.team
 */

class CityAPIController extends AppBaseController
{
    /** @var  CityRepository */
    private $cityRepository;

    /**
     * Current Logged User Selected Language Prefix
     *
     * @var string
     *
     * @author Amk El-Kabbany at 17 May 2020
     * @contact alaa@upbeatdigital.team
     */
    protected $language;

    public function __construct(CityRepository $cityRepo)
    {
        $this->cityRepository = $cityRepo;
        $this->language = request()->header('Accept-Language');
    }

    /**
     * Display a listing of the City.
     * GET|HEAD /cities
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $cities = $this->cityRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(CityResource::toArray($cities, $this->language), trans('city.messages.retrieved'));
    }

    /**
     * Display the specified City.
     * GET|HEAD /cities/{id}
     *
     * @param int $country_id
     *
     * @return Response
     */
    public function showByCountry($country_id = null)
    {
        /** @var City $city */
        $city = $this->cityRepository->showByCountry($country_id);

        if (empty($city)) {
            return $this->sendError(trans('country.messages.not_found'));
        }

        return $this->sendResponse(CityResource::toArray($city, $this->language), trans('city.messages.retrieved'));
    }

    /**
     * Retrieve a pluck of the Brand.
     * GET|HEAD /brands
     *
     * @param int $country_id
     * @return Response
     *
     * @author Amk El-Kabbany at 17 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function pluck($country_id = null)
    {
        $cities = $this->cityRepository->pluck($this->language, $country_id);
        return $this->sendResponse($cities, trans('city.messages.retrieved'));
    }

    /**
     * Store a newly created City in storage.
     * POST /cities
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $input = CityResource::casts($request->all(), $this->language);

        $validator = Validator::make($input, City::$rules);

        if($validator->fails()){
            return $this->sendError(BaseAPI::handelValidationErrors($validator->errors()));
        }

        $city = $this->cityRepository->create($input);

        if (! $city) {
            return $this->sendError(BaseAPI::handelFlashErrors(trans('city.messages.errors.created')));
        }

        return $this->sendResponse(CityResource::toArray($city, $this->language), trans('city.messages.created'));
    }

    /**
     * Display the specified City.
     * GET|HEAD /cities/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var City $city */
        $city = $this->cityRepository->find($id);

        if (empty($city)) {
            return $this->sendError(trans('city.messages.not_found'));
        }

        return $this->sendResponse(CityResource::toArray($city, $this->language), trans('city.messages.retrieved'));
    }

    /**
     * Update the specified City in storage.
     * PUT/PATCH /cities/{id}
     *
     * @param int $id
     * @param Request $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {

        $input = CityResource::casts($request->all(), $this->language, $id);

        $validator = Validator::make($input, City::$rules);

        if($validator->fails()){
            return $this->sendError(BaseAPI::handelValidationErrors($validator->errors()));
        }

        if (empty($this->cityRepository->find($id))) {
            return $this->sendError(trans('country.messages.not_found'));
        }

        $country = $this->cityRepository->update($input, $id);

        if (! $country) {
            return $this->sendError(BaseAPI::handelFlashErrors(trans('country.messages.errors.updated')));
        }

        return $this->sendResponse(CityResource::toArray($country, $this->language), trans('country.messages.updated'));
    }

    /**
     * Remove the specified City from storage.
     * DELETE /cities/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var City $city */
        $city = $this->cityRepository->find($id);

        if (empty($city)) {
            return $this->sendError(trans('city.messages.not_found'));
        }

        $city->delete();

        return $this->sendSuccess(trans('city.messages.deleted'));
    }
}
