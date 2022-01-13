<?php
/**
 * Brands controller class which handel more of business actions
 *
 * @author Amk El-Kabbany at 30 Apr 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Controllers;

use App\Core\Controllers\CustomizedAppBaseController;
use App\DataTables\BrandDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Repositories\BrandRepository;
use App\Repositories\CategoryRepository;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Laracasts\Flash\Flash;

class BrandController extends CustomizedAppBaseController
{
    /** @var  BrandRepository */
    private $brandRepository;

    /**
     * Current Logged User Selected Language Prefix
     *
     * @var string
     *
     * @author Amk El-Kabbany at 30 Apr 2020
     * @contact alaa@upbeatdigital.team
     */
    protected $language;

    public function __construct(BrandRepository $brandRepo)
    {
        parent::__construct();
        $this->brandRepository = $brandRepo;
        $this->language = Config::get('languages')[Request::ip()]['admin'];
    }

    /**
     * Display a listing of the Brand.
     *
     * @param BrandDataTable $brandDataTable
     * @return Response
     */
    public function index(BrandDataTable $brandDataTable)
    {
        return $brandDataTable->render('brands.index');
    }

    /**
     * Show the form for creating a new Brand.
     *
     * @return Response
     */
    public function create()
    {
        $categories = (new CategoryRepository())->pluck($this->language);
        return view('brands.create', compact('categories'));
    }

    /**
     * Store a newly created Brand in storage.
     *
     * @param CreateBrandRequest $request
     *
     * @return Response
     */
    public function store(CreateBrandRequest $request)
    {


        $input = $request->all();

        $brand = $this->brandRepository->create($input);

        Flash::success(trans('brand.messages.created'));

        return redirect(route('brands.index'));
    }

    /**
     * Display the specified Brand.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $brand = $this->brandRepository->find($id);

        if (empty($brand)) {
            Flash::error(trans('brand.messages.not_found'));

            return redirect(route('brands.index'));
        }

        return view('brands.show')->with('brand', $brand);
    }

    /**
     * Show the form for editing the specified Brand.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $brand = $this->brandRepository->find($id);

        if (empty($brand)) {
            Flash::error(trans('brand.messages.not_found'));

            return redirect(route('brands.index'));
        }

        $categories = (new CategoryRepository())->pluck($this->language);
        return view('brands.edit', compact('brand', 'categories'));
    }

    /**
     * Update the specified Brand in storage.
     *
     * @param  int              $id
     * @param UpdateBrandRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBrandRequest $request)
    {
        $brand = $this->brandRepository->find($id);

        if (empty($brand)) {
            Flash::error(trans('brand.messages.not_found'));

            return redirect(route('brands.index'));
        }

        $brand = $this->brandRepository->update($request->all(), $id);

        Flash::success(trans('brand.messages.updated'));

        return redirect(route('brands.index'));
    }

    /**
     * Remove the specified Brand from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $brand = $this->brandRepository->find($id);

        if (empty($brand)) {
            Flash::error(trans('brand.messages.not_found'));

            return redirect(route('brands.index'));
        }

        $flag = $this->brandRepository->delete($id);

        if($flag){
            Flash::success(trans('brand.messages.deleted'));
        }

        return redirect(route('brands.index'));
    }
}
