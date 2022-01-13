<?php
/**
 * Category controller class which handel more of business actions
 *
 * @author Amk El-Kabbany at 28 Apr 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Controllers;

use App\Core\Controllers\CustomizedAppBaseController;
use App\DataTables\CategoryDataTable;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Repositories\CategoryRepository;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Laracasts\Flash\Flash;

class CategoryController extends CustomizedAppBaseController
{
    /** @var  CategoryRepository */
    private $categoryRepository;

    /**
     * Current Logged User Selected Language Prefix
     *
     * @var string
     *
     * @author Amk El-Kabbany at 28 Apr 2020
     * @contact alaa@upbeatdigital.team
     */
    protected $language;

    public function __construct(CategoryRepository $categoryRepo)
    {
        parent::__construct();
        $this->categoryRepository = $categoryRepo;
        $this->language = Config::get('languages')[Request::ip()]['admin'];
    }

    /**
     * Seed main data into categories table.
     *
     * @return Response
     */
    public function seed()
    {
        $seeder = new \CategorySeeder();
        $seeder->run();
        return redirect()->back();
    }



    /**
     * Display a listing of the Category.
     *
     * @param CategoryDataTable $categoryDataTable
     * @return Response
     */
    public function index(CategoryDataTable $categoryDataTable)
    {
        return $categoryDataTable->render('categories.index');
    }

    /**
     * Show the form for creating a new Category.
     *
     * @return Response
     */
    public function create()
    {
        $categories = $this->categoryRepository->parentPluck($this->language);

        return view('categories.create', compact('categories'));
    }

    /**
     * Store a newly created Category in storage.
     *
     * @param CreateCategoryRequest $request
     *
     * @return Response
     */
    public function store(CreateCategoryRequest $request)
    {
        $input = $request->all();

        $category = $this->categoryRepository->create($input);

        Flash::success(trans('category.messages.created'));

        return redirect(route('categories.index'));
    }

    /**
     * Display the specified Category.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $category = $this->categoryRepository->find($id);

        if (empty($category)) {
                Flash::error(trans('category.messages.not_found'));

            return redirect(route('categories.index'));
        }

        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified Category.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $category = $this->categoryRepository->find($id);

        if (empty($category)) {
            Flash::error(trans('category.messages.not_found'));

            return redirect(route('categories.index'));
        }

        $categories = $this->categoryRepository->parentPluck($this->language);

        return view('categories.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified Category in storage.
     *
     * @param  int              $id
     * @param UpdateCategoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCategoryRequest $request)
    {
        $category = $this->categoryRepository->find($id);

        if (empty($category)) {
            Flash::error(trans('category.messages.not_found'));

            return redirect(route('categories.index'));
        }

        $category = $this->categoryRepository->update($request->all(), $id);

        Flash::success(trans('category.messages.updated'));

        return redirect(route('categories.index'));
    }

    /**
     * Remove the specified Category from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $category = $this->categoryRepository->find($id);

        if (empty($category)) {
            Flash::error(trans('category.messages.not_found'));

            return redirect(route('categories.index'));
        }

        $flag = $this->categoryRepository->delete($id);

        if($flag != false){
            Flash::success(trans('category.messages.deleted'));
        }

        return redirect(route('categories.index'));
    }
}
