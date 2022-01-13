<?php
/**
 * Slider controller class which handel more of business actions
 *
 * @author Amk El-Kabbany at 10 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Controllers;

use App\Core\Controllers\CustomizedAppBaseController;
use App\DataTables\SliderDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateSliderRequest;
use App\Http\Requests\UpdateSliderRequest;
use App\Models\Store;
use App\Repositories\SliderRepository;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Laracasts\Flash\Flash;

class SliderController extends CustomizedAppBaseController 
{
    /** @var  SliderRepository */
    private $sliderRepository;

    /**
     * Current Logged User Selected Language Prefix
     *
     * @var string
     *
     * @author Amk El-Kabbany at 10 May 2020
     * @contact alaa@upbeatdigital.team
     */
    protected $language;

    public function __construct(SliderRepository $sliderRepo)
    {
        parent::__construct();
        $this->sliderRepository = $sliderRepo;
        $this->language = Config::get('languages')[Request::ip()]['admin'];
    }

    /**
     * Display a listing of the Slider.
     *
     * @param SliderDataTable $sliderDataTable
     * @return Response
     */
    public function index(SliderDataTable $sliderDataTable)
    {
        return $sliderDataTable->render('sliders.index');
    }

    /**
     * Show the form for creating a new Slider.
     *
     * @return Response
     */
    public function create()
    {
        $products = (new ProductRepository())->pluckProducts($this->language);

        return view('sliders.create')->with('products', $products);
    }

    /**
     * Store a newly created Slider in storage.
     *
     * @param CreateSliderRequest $request
     *
     * @return Response
     */
    public function store(CreateSliderRequest $request)
    {
        $input = $request->all();

        $slider = $this->sliderRepository->create($input);

        Flash::success(trans('slider.messages.created'));

        return redirect(route('sliders.index'));
    }

    /**
     * Display the specified Slider.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $slider = $this->sliderRepository->find($id);

        if (empty($slider)) {
            Flash::error(trans('slider.messages.not_found'));

            return redirect(route('sliders.index'));
        }

        return view('sliders.show')->with('slider', $slider);
    }

    /**
     * Show the form for editing the specified Slider.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $slider = $this->sliderRepository->find($id);

        if (empty($slider)) {
            Flash::error(trans('slider.messages.not_found'));

            return redirect(route('sliders.index'));
        }

        $products = (new ProductRepository())->pluckProducts($this->language);

        return view('sliders.edit', compact('slider', 'products'));
    }

    /**
     * Update the specified Slider in storage.
     *
     * @param  int              $id
     * @param UpdateSliderRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSliderRequest $request)
    {
        $slider = $this->sliderRepository->find($id);

        if (empty($slider)) {
            Flash::error(trans('slider.messages.not_found'));

            return redirect(route('sliders.index'));
        }

        $slider = $this->sliderRepository->update($request->all(), $id);

        Flash::success(trans('slider.messages.updated'));

        return redirect(route('sliders.index'));
    }

    /**
     * Remove the specified Slider from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $slider = $this->sliderRepository->find($id);

        if (empty($slider)) {
            Flash::error(trans('slider.messages.not_found'));

            return redirect(route('sliders.index'));
        }
        
        $flag = $this->sliderRepository->delete($id);

        if($flag != false){
            Flash::success(trans('slider.messages.deleted'));
        }
        
        return redirect(route('sliders.index'));
    }
}
