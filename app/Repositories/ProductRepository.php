<?php
/**
 * Product repository class which handel more of logic actions
 *
 * @author Amk El-Kabbany at 18 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Repositories;

use App\Core\Controllers\APIs\BaseAPI;
use App\Events\API\Product\ProductAdded;
use App\Models\Category;
use App\Models\Language;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductImage;
use App\Models\RelatedProduct;
use App\Models\Store;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Validator;
use Laracasts\Flash\Flash;

/**
 * Class ProductRepository
 * @package App\Repositories
 * @version May 19, 2020, 2:06 pm UTC
 *
 * @author Amk El-Kabbany at 18 May 2020
 * @contact alaa@upbeatdigital.team
*/

class ProductRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'store_id',
        'category_id',
        'brand_id',
        'title_en',
        'description_en',
        'image',
        'price',
        'quantity',
        'discount',
        'discount_rate',
        'discount_start_date',
        'discount_end_date',
        'featured',
        'active',
        'en'
    ];

    /**
     * Class constructor
     *
     * @author Amk El-Kabbany at 18 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function __construct()
    {
        parent::__construct(app());
        $this->fieldSearchable = array_keys(alterLangArrayElements('products', ['fields' => array_combine($this->fieldSearchable,$this->fieldSearchable)], $key = 'fields')['fields']);
    }

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Product::class;
    }

    /**
     * Lists all featured product
     *
     * @param int $paginate
     * @return Product
     *
     * @author Amk El-Kabbany at 23 June 2020
     * @contact alaa@upbeatdigital.team
     **/
    public function lists($paginate = 8)
    {
        $query = $this->model->newQuery()->where('deleted_at', null)->where('active', true);

        return $query->paginate($paginate)->toArray();
    }

    /**
     * Lists all in slider products
     *
     * @param int $paginate
     * @return Product
     *
     * @author Mahmoud Bakr at 16 Sep 2020
     * @contact m.bakr@upbeatdigital.team
     **/
    public function in_slider($category_id)
    {
        $categories = Category::where('deleted_at', null)->where('parent', $category_id)->pluck('id');
        $categories[] = $category_id;
        $query = $this->model->newQuery()->where('deleted_at', null)->where('active', true)->whereIn('category_id', $categories)->where('in_slider', 1);

        return $query->get();
    }

    /**
     * Lists all featured product
     *
     * @return Product
     *
     * @author Amk El-Kabbany at 23 June 2020
     * @contact alaa@upbeatdigital.team
     **/
    public function featured()
    {
        return Product::featured();
    }

    /**
     * Lists all related product to this product
     *
     * @param int $id
     * @return array
     *
     * @author Amk El-Kabbany at 21 June 2020
     * @contact alaa@upbeatdigital.team
     **/
    public function relatedProducts($id)
    {
        return RelatedProduct::relatedProducts($id);
    }

    /**
     * Lists all product that have discount
     *
     * @return Product
     *
     * @author Amk El-Kabbany at 16 June 2020
     * @contact alaa@upbeatdigital.team
     **/
    public function discounts()
    {
        return Product::discounts();
    }

    /**
     * Lists latest product
     *
     * @param int $store_id
     * @return Product
     *
     * @author Amk El-Kabbany at 16 June 2020
     * @contact alaa@upbeatdigital.team
     **/
    public function latest($store_id = null)
    {
        return Product::latest($store_id);
    }

    /**
     * search among products by specific term
     *
     * @param string $term
     * @return Collection
     *
     * @author Amk El-Kabbany at 16 June 2020
     * @contact alaa@upbeatdigital.team
     **/
    public function search($term)
    {
        return Product::search($term);
    }

    /**
     * filter products by specific criteria
     *
     * @param array $criteria
     * @return Collection
     *
     * @author Amk El-Kabbany at 16 June 2020
     * @contact alaa@upbeatdigital.team
     **/
    public function filter($criteria)
    {
        $paginate = 8;
        $header = 'value_' . request()->header('Accept-Language');
        if(!empty($criteria['paginate']) && intval($criteria['paginate']) > 0) {
            $paginate = intval($criteria['paginate']);
        }
        $query = $this->model->newQuery()->where('deleted_at', null)->whereRaw('(quantity >0 AND  active != false)');
        if(!empty($criteria['store'])){
            $query = $query->where('store_id', $criteria['store']);
        }
        if(!empty($criteria['latest']) && $criteria['latest'] == true) {
            $query = $query->orderBy('created_at');
        }
        if(!empty($criteria['category']) && empty($criteria['subcategory'])) {
            $categories = Category::where('deleted_at', null)->where('parent', $criteria['category'])->pluck('id');
            $categories[] = $criteria['category'];
            $query = $query->whereIn('category_id', $categories);
        }
        if(!empty($criteria['subcategory'])) {
            $query = $query->where('category_id', $criteria['subcategory']);
        }
        if(!empty($criteria['brands'])) {
            $query = $query->whereHas('brand', function ($q) use($criteria) {
                $q->whereIn('brand_id', $criteria['brands']);
            });
        }
        if(!empty($criteria['minimum_price'])) {
            $query = $query->where('price', '>=',$criteria['minimum_price']);
        }
        if(!empty($criteria['maximum_price'])) {
            $query = $query->where('price', '<=',$criteria['maximum_price']);
        }
        if(!empty($criteria['featured']) && $criteria['featured'] == true) {
            $query = $query->where('featured', $criteria['featured']);
        }
        if(!empty($criteria['rate'])) {
            $query = $query->whereHas('ratings', function ($q) use($criteria) {
                $q->where('rate', $criteria['rate']);
            });
        }
        if(!empty($criteria['attributes'])) {
            $query = $query->whereHas('attributes', function ($q) use($criteria, $header) {
                foreach($criteria['attributes'] as $attribute) {
                    $q->where($header, $attribute);
                }
                // $q->whereI($header, $criteria['attributes']);
            });
        }
        return $query->paginate($paginate)->toArray();
    }

    /**
     * Fetch requested Products according to it's ids.
     *
     * @param array $ids
     * @return array
     *
     * @author Amk El-Kabbany at 7 July 2020
     * @contact alaa@upbeatdigital.team
     **/
    public function fetchByIds($ids)
    {
        return Product::whereIn('id', $ids)->where('deleted_at', null)->where('quantity', '>', 0)
                        ->where('active', true)->get();
    }

    /**
     * Pluck model entries according to provided language
     *
     * @param string $language
     * @param int $store_id
     * @return array
     *
     * @author Amk El-Kabbany at 18 May 2020
     * @contact alaa@upbeatdigital.team
     **/
    public function pluck($language, $store_id = null)
    {
        $title = 'title_'.$language;
        return Product::where('deleted_at', null)->when($store_id != null, function ($query, $store_id){
            return $query->where('store_id', $store_id);
        })->where($language, true)->orderBy($title)->pluck($title, 'id');
    }

    /**
     * Pluck model entries according to provided language
     *
     * @param string $language
     * @param int $store_id
     * @return array
     *
     * @author Amk El-Kabbany at 18 May 2020
     * @contact alaa@upbeatdigital.team
     **/
    public function pluckProducts($language)
    {
        return Product::where('deleted_at', null)->where('active', true)->pluck('title_'. $language, 'id');
    }

    /**
     * Create model record
     *
     * @param array $input
     *
     * @return Product|boolean
     */
    public function create($input)
    {
        $images = [];
        if (request()->hasFile('images')) {
            foreach (request()->file('images') as $key => $image) {
                $destinationPath = 'storage/Coupons/images';
                $file_info = getimagesize($image);
                if (empty($file_info)) { // No Image?
                    Flash::error(trans('common.messages.valid_image'));
                    return false;
                }
                $file = $image;
                $attach = $destinationPath . '/' . rand() . '-coupons-' . date("d-m-y-H-M") . '-' . $file->getClientOriginalName();
                $file->move($destinationPath, ($attach));
                $images[$key]['image'] = trim($attach);
            }
        } else {
            Flash::error(trans('common.messages.required_image'));
            return false;
        }
        unset($input['images']);
        $input['image'] = (isset($images[0]['image']))? $images[0]['image'] : null;
        (isset($images[0]['image']))? $images[0]['main'] = true : null;
        // dd($images);

        $attributes = (Category::find($input['category_id']))->attributes;
        $languages = Language::where('prefix', '!=', 'en')->pluck('prefix');
        $attributes_array = [];
        foreach ($attributes as $key => $attribute) {
            $attributes_array[$key] = [
              'category_attribute_id' => $attribute->id,
              'title_en' => $attribute->title_en,
              'description_en' => $attribute->description_en,
              'value_en' => isset($input['value_en'.$key])? $input['value_en'.$key] : '',
              'active' => isset($input['active'.$key])? $input['active'.$key] : false,
            ];
            foreach ($languages as $prefix) {
                $title = 'title_'.$prefix;
                $description = 'description_'.$prefix;
                $value = 'value_'.$prefix;
                $attributes_array[$key][$title] = $attribute->$title;
                $attributes_array[$key][$description] = $attribute->$description;
                $attributes_array[$key][$value] = isset($input[$value.$key])? $input[$value.$key] : '';
            }
        }

        $related_products = [];
        if(isset($input['related_products'])) {
            $related_products = $input['related_products'];
            unset($input['related_products']);
        }

        $product = new Product();
        if($input['quantity'] == 0){
            $input['active'] = false;
        }
        $product->fill($input)->save();
        event(new ProductAdded($product));
        foreach ($images as $key => $image){
            $image['product_id'] = $product->id;

            /*$validator = Validator::make($image, ProductImage::$rules);
            if($validator->fails()){
                Flash::error(BaseAPI::handelValidationErrors($validator->errors()));
                $product->forceDelete();
                return false;
            }*/

            $product_image = new ProductImage();
            $product_image->fill($image)->save();
        }

        foreach ($attributes_array as $key => $attribute){
            $attribute['product_id'] = $product->id;

            /*$validator = Validator::make($attribute, ProductAttribute::$rules);
            if($validator->fails()){
                Flash::error(BaseAPI::handelValidationErrors($validator->errors()));
                $product->forceDelete();
                return false;
            }*/

            $product_attribute = new ProductAttribute();
            $product_attribute->fill($attribute)->save();
        }

        foreach ($related_products as $related_product){
            $data = [
                'product_id'        => $product->id,
                'related_product_id'=> $related_product,
            ];

            $validator = Validator::make($data, RelatedProduct::$rules);
            if($validator->fails()){
                Flash::error(BaseAPI::handelValidationErrors($validator->errors()));
                $product->forceDelete();
                return false;
            }

            $relatedProduct = new RelatedProduct();
            $relatedProduct->fill($data)->save();
        }

        return $product;
    }

    /**
     * Update model record for given id
     *
     * @param array $input
     * @param int $id
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model|boolean
     *
     * @author Amk El-Kabbany at 21 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function update($input, $id)
    {
        $images = [];
        if (request()->hasFile('images')) {
            foreach (request()->file('images') as $key => $image) {
                $destinationPath = 'storage/Products/images';
                $file_info = getimagesize($image);
                if (empty($file_info)) { // No Image?
                    Flash::error(trans('common.messages.valid_image'));
                    return false;
                }
                $file = $image;
                $attach = $destinationPath . '/' . rand() . '-products-' . date("d-m-y-H-M") . '-' . $file->getClientOriginalName();
                $file->move($destinationPath, ($attach));
                $images[$key]['image'] = trim($attach);
            }
        }
        unset($input['images']);

        $related_products = [];
        if(isset($input['related_products'])) {
            $related_products = $input['related_products'];
            unset($input['related_products']);
        }

        $product = Product::findOrFail($id);
        if($input['quantity'] == 0){
            $input['active'] = false;
        }
        $input['image'] = $product->mainImage();
        if($input['image'] == null){
            $input['image'] = (isset($images[0]['image']))? $images[0]['image'] : null;
            (isset($images[0]['image']))? $images[0]['main'] = true : null;
        }

        foreach ($images as $key => $image){
            $image['product_id'] = $product->id;

            /*$validator = Validator::make($image, ProductImage::$rules);
            if($validator->fails()){
                Flash::error(BaseAPI::handelValidationErrors($validator->errors()));
                $product->forceDelete();
                return false;
            }*/

            $product_image = new ProductImage();
            $product_image->fill($image)->save();
        }

        foreach ($related_products as $related_product){
            $data = [
                'product_id'        => $product->id,
                'related_product_id'=> $related_product,
            ];

            if(! RelatedProduct::where('product_id', $data['product_id'])->where('related_product_id', $data['related_product_id'])->exists()) {
                $validator = Validator::make($data, RelatedProduct::$rules);
                if ($validator->fails()) {
                    Flash::error(BaseAPI::handelValidationErrors($validator->errors()));
                    $product->forceDelete();
                    return false;
                }

                $relatedProduct = new RelatedProduct();
                $relatedProduct->fill($data)->save();
            }
        }

        $product->fill($input)->save();

        return $product;
    }

    /**
     * @param int $id
     *
     * @throws \Exception
     *
     * @return bool|mixed|null
     *
     * @author Amk El-Kabbany at 21 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function delete($id)
    {
        $query = $this->model->newQuery();
        $product = $query->findOrFail($id);

        foreach ($product->attributes as $attribute) {
            $attribute->delete();
        }

        return $product->delete();
    }
}
