<?php
/**
 * Slider API controller class which handel more of business actions
 *
 * @author Amk El-Kabbany at 17 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Controllers\API;

use App\Core\Controllers\APIs\BaseAPI;
use App\Http\Resources\SliderResource;
use App\Models\Slider;
use App\Repositories\SliderRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

/**
 * Class SliderController
 * @package App\Http\Controllers\API
 *
 * @author Amk El-Kabbany at 17 May 2020
 * @contact alaa@upbeatdigital.team
 */

class SliderAPIController extends AppBaseController
{
    /** @var  SliderRepository */
    private $sliderRepository;

    /**
     * Current Logged User Selected Language Prefix
     *
     * @var string
     *
     * @author Amk El-Kabbany at 17 May 2020
     * @contact alaa@upbeatdigital.team
     */
    protected $language;

    public function __construct(SliderRepository $sliderRepo)
    {
        $this->sliderRepository = $sliderRepo;
        $this->language = request()->header('Accept-Language');
    }

    /**
     * Display a listing of the Slider.
     * GET|HEAD /sliders
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $sliders = $this->sliderRepository->List();

        return $this->sendResponse(SliderResource::toArray($sliders, $this->language), trans('slider.messages.retrieved'));
    }

    /**
     * Retrieve a pluck of the Brand.
     * GET|HEAD /brands
     *
     * @param  int $store_id
     * @return Response
     *
     * @author Amk El-Kabbany at 17 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function pluck($store_id)
    {
        $sliders = $this->sliderRepository->pluck($this->language, $store_id);
        return $this->sendResponse($sliders, trans('slider.messages.retrieved'));
    }

    /**
     * Store a newly created Slider in storage.
     * POST /sliders
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    { 
        $input = SliderResource::casts($request->all(), $this->language);

        $validator = Validator::make($input, Slider::$rules);

        if($validator->fails()){
            return $this->sendError(BaseAPI::handelValidationErrors($validator->errors()));
        }

        $slider = $this->sliderRepository->create($input);

        if (! $slider) {
            return $this->sendError(BaseAPI::handelFlashErrors(trans('slider.messages.errors.created')));
        }

        return $this->sendResponse(SliderResource::toArray($slider, $this->language), trans('slider.messages.created'));
    }

    /**
     * Display the specified Slider.
     * GET|HEAD /sliders/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Slider $slider */
        $slider = $this->sliderRepository->find($id);

        if (empty($slider)) {
            return $this->sendError(trans('slider.messages.not_found'));
        }

        return $this->sendResponse(SliderResource::toArray($slider, $this->language), trans('slider.messages.retrieved'));
    }

    /**
     * Update the specified Slider in storage.
     * PUT/PATCH /sliders/{id}
     *
     * @param int $id
     * @param Request $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $input = SliderResource::casts($request->all(), $this->language, $id);

        $validator = Validator::make($input, Slider::$rules);

        if($validator->fails()){
            return $this->sendError(BaseAPI::handelValidationErrors($validator->errors()));
        }

        if (empty($this->sliderRepository->find($id))) {
            return $this->sendError(trans('slider.messages.not_found'));
        }

        $slider = $this->sliderRepository->update($input, $id);

        if (! $slider) {
            return $this->sendError(BaseAPI::handelFlashErrors(trans('slider.messages.errors.updated')));
        }

        return $this->sendResponse(SliderResource::toArray($slider, $this->language), trans('slider.messages.updated'));
    }

    /**
     * Remove the specified Slider from storage.
     * DELETE /sliders/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Slider $slider */
        $slider = $this->sliderRepository->find($id);

        if (empty($slider)) {
            return $this->sendError(trans('slider.messages.not_found'));
        }

        $slider->delete();

        return $this->sendSuccess(trans('slider.messages.deleted'));
    }
}
