<?php
/**
 * Product controller class which handel more of business actions
 *
 * @author Amk El-Kabbany at 19 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Controllers;

use App\Core\Controllers\CustomizedAppBaseController;
use App\DataTables\ProductDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\ProductAttribute;
use App\Models\ProductImage;
use App\Models\RelatedProduct;
use App\Repositories\BrandRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use App\Repositories\StoreRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Laracasts\Flash\Flash;

class ProductController extends CustomizedAppBaseController
{
    /** @var  ProductRepository */
    private $productRepository;

    /**
     * Current Logged User Selected Language Prefix
     *
     * @var string
     *
     * @author Amk El-Kabbany at 7 May 2020
     * @contact alaa@upbeatdigital.team
     */
    protected $language;

    public function __construct(ProductRepository $productRepo)
    {
        parent::__construct();
        $this->productRepository = $productRepo;
        $this->language = Config::get('languages')[Request::ip()]['admin'];
    }

    /**
     * Display a listing of the Product.
     *
     * @param ProductDataTable $productDataTable
     * @return Response
     */
    public function index(ProductDataTable $productDataTable)
    {
        return $productDataTable->render('products.index');
    }

    public function getBrandInAjax($category_id){
        dd($category_id);

    }

    /**
     * Show the form for creating a new Product.
     *
     * @return Response
     */
    public function create()
    {
        $stores = (new StoreRepository())->pluck($this->language);

        $categories = (new CategoryRepository())->categoryPluck($this->language);

        $brands = (new BrandRepository())->pluck($this->language);



        $products = (new ProductRepository())->pluck($this->language);

        return view('products.create', compact('stores', 'categories', 'brands', 'products'));
    }

    /**
     * Store a newly created Product in storage.
     *
     * @param CreateProductRequest $request
     *
     * @return Response|RedirectResponse
     */
    public function store(CreateProductRequest $request)
    {
        $input = $request->all();

        $product = $this->productRepository->create($input);

        if($product != false) {
            Flash::success(trans('product.messages.created'));
            return redirect(route('products.index'));
        } else {
            return redirect()->back()->withInput($input);
        }
    }

    /**
     * Display the specified Product.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $product = $this->productRepository->find($id);

        if (empty($product)) {
            Flash::error(trans('product.messages.not_found'));

            return redirect(route('products.index'));
        }

        return view('products.show')->with('product', $product);
    }

    /**
     * Show the form for editing the specified Product.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $product = $this->productRepository->find($id);

        if (empty($product)) {
            Flash::error(trans('product.messages.not_found'));

            return redirect(route('products.index'));
        }

        $stores = (new StoreRepository())->pluck($this->language);
        $categories = (new CategoryRepository())->categoryPluck($this->language);
        $brands = (new BrandRepository())->pluck($this->language);
        $products = (new ProductRepository())->pluck($this->language);
        unset($products[$product->id]);

        return view('products.edit', compact('product', 'stores', 'categories', 'brands', 'products'));
    }

    /**
     * Update the specified Product in storage.
     *
     * @param  int  $id
     * @param UpdateProductRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProductRequest $request)
    {
        $product = $this->productRepository->find($id);

        if (empty($product)) {
            Flash::error(trans('product.messages.not_found'));

            return redirect(route('products.index'));
        }

        $product = $this->productRepository->update($request->all(), $id);

        Flash::success(trans('product.messages.updated'));

        return redirect(route('products.index'));
    }

    /**
     * Remove the specified Product from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $product = $this->productRepository->find($id);

        if (empty($product)) {
            Flash::error(trans('product.messages.not_found'));

            return redirect(route('products.index'));
        }

        $this->productRepository->delete($id);

        Flash::success(trans('product.messages.deleted'));

        return redirect(route('products.index'));
    }

    /**
     * <Ajax POST Action>
     * Retrieve associated category attributes for given category.

     * @return array
     *
     * @author Amk El-Kabbany at 19 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function fetchCategoryAttributes()
    {
        $language = Config::get('languages')[Request::ip()]['admin'];
        $name = 'name_'.$language;
        $description = 'description_'.$language;
        $data = [];
        $attributes = (Category::find($_POST['category_id']))->productAttributes;
        foreach($attributes as $attribute) {
            $data[] = [
               'id'     => $attribute->id,
               'title'  => $attribute->$name,
               'description'    => $attribute->$description,
            ];
        }
        exit(json_encode($data)) ;
    }

    /**
     * <Ajax POST Action -.active js/script.blade.php->
     * Route action edit selected product attribute active attribute
     *
     * @return array
     *
     * @author Amk El-Kabbany at 20 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function editProductAttributeActive() {
        $id = $_POST['id'];
        $object = ProductAttribute::find($id);
        $object->active = ($_POST['value'] == 'true') ? true : false;
        $object->save();

        exit(json_encode(['active' . $id]));
    }

    /**
     * <Ajax POST Action -.value js/script.blade.php->
     * Route action edit selected product attribute value attribute
     *
     * @return array
     *
     * @author Amk El-Kabbany at 20 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function editProductAttributeValue() {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $object = ProductAttribute::find($id);
        $object->fill([$name => $_POST['value']])->save();

        exit(json_encode([$name . $id]));
    }

    /**
     * <Ajax POST Action -.imageActive js/script.blade.php->
     * Route action edit selected product image active attribute
     *
     * @return array
     *
     * @author Amk El-Kabbany at 21 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function editProductImageActive() {
        $id = $_POST['id'];
        $object = ProductImage::find($id);
        $object->active = ($_POST['value'] == 'true') ? true : false;
        $object->save();

        exit(json_encode(['active' . $id]));
    }

    /**
     * <Ajax POST Action -.main js/script.blade.php->
     * Route action edit selected product image main attribute
     *
     * @return array
     *
     * @author Amk El-Kabbany at 21 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function editProductImageMain() {
        $id = $_POST['id'];
        $object = ProductImage::find($id);
        $object->main = ($_POST['value'] == 'true') ? true : false;
        $object->save();
        $ids = [];

        if($object->main) {
            $query = ProductImage::where('id', '!=', $object->id)->where('main', true);
            $ids = $query->pluck('id');
            $query->update(['main' => false]);
            $object->product->fill(['image' => $object->image])->save();
        }

        exit(json_encode($ids));
    }

    /**
     * <Ajax POST Action -.deleteImage js/script.blade.php->
     * Route action delete selected product image
     *
     * @return array
     *
     * @author Amk El-Kabbany at 21 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function deleteProductImage() {
        $id = $_POST['id'];
        $object = ProductImage::find($id);
        $object->delete();

        if($object->main) {
            $main = ProductImage::where('product_id', $object->product_id)->first();
            $main->update(['main' => true]);
            exit(json_encode($main->id));
        }

        exit(true);
    }

    /**
     * <Ajax POST Action -.unlinkRelatedProduct js/script.blade.php->
     * Route action unlink selected related product
     *
     * @return array
     *
     * @author Amk El-Kabbany at 21 June 2020
     * @contact alaa@upbeatdigital.team
     */
    public function unlinkRelatedProduct() {
        $id = $_POST['id'];
        $object = RelatedProduct::find($id);
        $object->forceDelete();
        exit(true);
    }
}
