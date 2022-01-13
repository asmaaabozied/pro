<?php
/**
 * Country controller class which handel more of business actions
 *
 * @author Amk El-Kabbany at 4 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Controllers;

use App\Core\Controllers\CustomizedAppBaseController;
use App\DataTables\CountryDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Repositories\CountryRepository;
use Illuminate\Support\Facades\Response;
use Laracasts\Flash\Flash;

class CountryController extends CustomizedAppBaseController
{
    /** @var  CountryRepository */
    private $countryRepository;

    public function __construct(CountryRepository $countryRepo)
    {
            parent::__construct();
        $this->countryRepository = $countryRepo;
    }

    /**
     * Display a listing of the Country.
     *
     * @param CountryDataTable $countryDataTable
     * @return Response
     */
    public function index(CountryDataTable $countryDataTable)
    {
        return $countryDataTable->render('countries.index');
    }

    /**
     * Show the form for creating a new Country.
     *
     * @return Response
     */
    public function create()
    {
        return view('countries.create');
    }

    /**
     * Store a newly created Country in storage.
     *
     * @param CreateCountryRequest $request
     *
     * @return Response
     */
    public function store(CreateCountryRequest $request)
    {
        $input = $request->all();

        $country = $this->countryRepository->create($input);

        Flash::success(trans('country.messages.created'));

        return redirect(route('countries.index'));
    }

    /**
     * Display the specified Country.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $country = $this->countryRepository->find($id);

        if (empty($country)) {
            Flash::error(trans('country.messages.not_found'));

            return redirect(route('countries.index'));
        }

        return view('countries.show')->with('country', $country);
    }

    /**
     * Show the form for editing the specified Country.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $country = $this->countryRepository->find($id);

        if (empty($country)) {
            Flash::error(trans('country.messages.not_found'));

            return redirect(route('countries.index'));
        }

        return view('countries.edit')->with('country', $country);
    }

    /**
     * Update the specified Country in storage.
     *
     * @param  int              $id
     * @param UpdateCountryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCountryRequest $request)
    {
        $country = $this->countryRepository->find($id);

        if (empty($country)) {
            Flash::error(trans('country.messages.not_found'));

            return redirect(route('countries.index'));
        }

        $country = $this->countryRepository->update($request->all(), $id);

        Flash::success(trans('country.messages.updated'));

        return redirect(route('countries.index'));
    }

    /**
     * Remove the specified Country from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $country = $this->countryRepository->find($id);

        if (empty($country)) {
            Flash::error(trans('country.messages.not_found'));

            return redirect(route('countries.index'));
        }

        $flag = $this->countryRepository->delete($id);

        if($flag != false){
            Flash::success(trans('country.messages.deleted'));
        }

        return redirect(route('countries.index'));
    }
}
