<?php
/**
 * Category Attribute controller class which handel more of business actions
 *
 * @author Amk El-Kabbany at 12 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Controllers;

use App\Core\Controllers\CustomizedAppBaseController;
use App\DataTables\CategoryAttributeDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateCategoryAttributeRequest;
use App\Http\Requests\UpdateCategoryAttributeRequest;
use App\Models\Category;
use App\Repositories\CategoryAttributeRepository;
use App\Repositories\CategoryRepository;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Laracasts\Flash\Flash;

class CategoryAttributeController extends CustomizedAppBaseController
{
    /** @var  CategoryAttributeRepository */
    private $categoryAttributeRepository;

    /**
     * Current Logged User Selected Language Prefix
     *
     * @var string
     *
     * @author Amk El-Kabbany at 12 May 2020
     * @contact alaa@upbeatdigital.team
     */
    protected $language;

    public function __construct(CategoryAttributeRepository $categoryAttributeRepo)
    {
        parent::__construct();
        $this->categoryAttributeRepository = $categoryAttributeRepo;
        $this->language = Config::get('languages')[Request::ip()]['admin'];
    }

    /**
     * Display a listing of the CategoryAttribute.
     *
     * @param CategoryAttributeDataTable $categoryAttributeDataTable
     * @return Response
     */
    public function index(CategoryAttributeDataTable $categoryAttributeDataTable)
    {
        return $categoryAttributeDataTable->render('category_attributes.index');
    }

    /**
     * Show the form for creating a new CategoryAttribute.
     *
     * @return Response
     */
    public function create()
    {
        $categories = (new CategoryRepository())->pluck($this->language);

        return view('category_attributes.create', compact('categories'));
    }

    /**
     * Store a newly created CategoryAttribute in storage.
     *
     * @param CreateCategoryAttributeRequest $request
     *
     * @return Response
     */
    public function store(CreateCategoryAttributeRequest $request)
    {
        $input = $request->all();

        $categoryAttribute = $this->categoryAttributeRepository->create($input);

        Flash::success(trans('categoryAttribute.messages.created'));

        return redirect(route('categoryAttributes.index'));
    }

    /**
     * Display the specified CategoryAttribute.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $categoryAttribute = $this->categoryAttributeRepository->find($id);

        if (empty($categoryAttribute)) {
            Flash::error(trans('categoryAttribute.messages.not_found'));

            return redirect(route('categoryAttributes.index'));
        }

        return view('category_attributes.show')->with('categoryAttribute', $categoryAttribute);
    }

    /**
     * Show the form for editing the specified CategoryAttribute.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $categoryAttribute = $this->categoryAttributeRepository->find($id);

        if (empty($categoryAttribute)) {
            Flash::error(trans('categoryAttribute.messages.not_found'));

            return redirect(route('categoryAttributes.index'));
        }

        $categories = (new CategoryRepository())->pluck($this->language);

        return view('category_attributes.edit', compact('categoryAttribute', 'categories'));
    }

    /**
     * Update the specified CategoryAttribute in storage.
     *
     * @param  int              $id
     * @param UpdateCategoryAttributeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCategoryAttributeRequest $request)
    {
        $categoryAttribute = $this->categoryAttributeRepository->find($id);

        if (empty($categoryAttribute)) {
            Flash::error(trans('categoryAttribute.messages.not_found'));

            return redirect(route('categoryAttributes.index'));
        }

        $categoryAttribute = $this->categoryAttributeRepository->update($request->all(), $id);

        Flash::success(trans('categoryAttribute.messages.updated'));

        return redirect(route('categoryAttributes.index'));
    }

    /**
     * Remove the specified CategoryAttribute from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $categoryAttribute = $this->categoryAttributeRepository->find($id);

        if (empty($categoryAttribute)) {
            Flash::error(trans('categoryAttribute.messages.not_found'));

            return redirect(route('categoryAttributes.index'));
        }

        $flag = $this->categoryAttributeRepository->delete($id);

        if($flag != false){
            Flash::success(trans('categoryAttribute.messages.deleted'));
        }


        return redirect(route('categoryAttributes.index'));
    }
}
