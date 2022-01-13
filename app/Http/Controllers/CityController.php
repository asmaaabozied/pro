<?php
/**
 * City controller class which handel more of business actions
 *
 * @author Amk El-Kabbany at 4 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Controllers;

use App\Core\Controllers\CustomizedAppBaseController;
use App\DataTables\CityDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateCityRequest;
use App\Http\Requests\UpdateCityRequest;
use App\Models\Country;
use App\Repositories\CityRepository;
use App\Repositories\CountryRepository;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Laracasts\Flash\Flash;

class CityController extends CustomizedAppBaseController 
{
    /** @var  CityRepository */
    private $cityRepository;

    /**
     * Current Logged User Selected Language Prefix
     *
     * @var string
     *
     * @author Amk El-Kabbany at 4 May 2020
     * @contact alaa@upbeatdigital.team
     */
    protected $language;


    public function __construct(CityRepository $cityRepo)
    {
        parent::__construct();
        $this->cityRepository = $cityRepo;
        $this->language = Config::get('languages')[Request::ip()]['admin'];
    }

    /**
     * Display a listing of the City.
     *
     * @param CityDataTable $cityDataTable
     * @return Response
     */
    public function index(CityDataTable $cityDataTable)
    {
        return $cityDataTable->render('cities.index');
    }

    /**
     * Show the form for creating a new City.
     *
     * @return Response
     */
    public function create()
    {
        $countries = (new CountryRepository())->pluck($this->language);

        return view('cities.create', compact('countries'));
    }

    /**
     * Store a newly created City in storage.
     *
     * @param CreateCityRequest $request
     *
     * @return Response
     */
    public function store(CreateCityRequest $request)
    {
        $input = $request->all();

        $city = $this->cityRepository->create($input);

        Flash::success(trans('city.messages.created'));

        return redirect(route('cities.index'));
    }

    /**
     * Display the specified City.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $city = $this->cityRepository->find($id);

        if (empty($city)) {
            Flash::error(trans('city.messages.not_found'));

            return redirect(route('cities.index'));
        }

        return view('cities.show')->with('city', $city);
    }

    /**
     * Show the form for editing the specified City.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $city = $this->cityRepository->find($id);

        if (empty($city)) {
            Flash::error(trans('city.messages.not_found'));

            return redirect(route('cities.index'));
        }

        $countries = (new CountryRepository())->pluck($this->language);

        return view('cities.edit', compact('city', 'countries'));
    }

    /**
     * Update the specified City in storage.
     *
     * @param  int              $id
     * @param UpdateCityRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCityRequest $request)
    {
        $city = $this->cityRepository->find($id);

        if (empty($city)) {
            Flash::error(trans('city.messages.not_found'));

            return redirect(route('cities.index'));
        }

        $city = $this->cityRepository->update($request->all(), $id);

        Flash::success(trans('city.messages.updated'));

        return redirect(route('cities.index'));
    }

    /**
     * Remove the specified City from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $city = $this->cityRepository->find($id);

        if (empty($city)) {
            Flash::error(trans('city.messages.not_found'));

            return redirect(route('cities.index'));
        }
        
        $flag = $this->cityRepository->delete($id);

        if($flag){
            Flash::error(trans('city.messages.deleted'));
        }
        
        return redirect(route('cities.index'));
    }
}
