<?php
/**
 * Product data-table class which handling module data-table actions
 *
 * @author Amk El-Kabbany at 19 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\DataTables;

use App\Models\Language;
use App\Models\Product;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class ProductDataTable extends DataTable
{
    /**
     * Columns array length
     *
     * @var integer
     *
     * @author Amk El-Kabbany at 19 May 2020
     * @contact alaa@upbeatdigital.team
     */
    protected $columnsLength;
    
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable->addColumn('action', 'products.datatables_actions')
                        ->editColumn('category_id', 'products.grid.category')
                        ->editColumn('brand_id', 'products.grid.brand')
                        ->editColumn('image', 'products.grid.image')
                        ->editColumn('active', 'products.grid.active')
                        ->editColumn('featured', 'products.grid.featured')
                        ->rawColumns(['image', 'active', 'featured', 'category_id', 'brand_id', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Product $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Product $model)
    {
        return $model->limited()->where('deleted_at', null)->with('category', 'brand', 'attributes', 'store');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '120px', 'printable' => false])
            ->parameters([
                'stateSave' => false,
                'order'     => [[($this->columnsLength-1), 'desc']],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        $language = Config::get('languages')[Request::ip()]['admin'];
        $columns =  [
            trans('product.fields.image')  => ['name' => 'image', 'data' => 'image'],
            trans('product.fields.store_id')  => ['name' => 'store_id', 'data' => "store.name_$language", 'defaultContent' => 'N/A'],
            trans('product.fields.category_id')  => ['name' => 'category_id', 'data' => "category.title_$language", 'defaultContent' => 'N/A'],
            trans('product.fields.brand_id')  => ['name' => 'brand_id', 'data' => "brand.title_$language", 'defaultContent' => 'N/A'],
            trans('product.fields.title_en')  => ['name' => 'title_en', 'data' => 'title_en', 'defaultContent' => 'N/A'],
        ];
        $system_languages = Language::where('prefix', '!=', 'en')->pluck('prefix');
        foreach ($system_languages as $system_language) {
            $title = 'title_'.$system_language;
            $columns[trans("product.fields.$title")] = ['name' => $title, 'data' => "$title", 'defaultContent' => 'N/A'];
        }
        $columns[trans('product.fields.price')] = ['name' => 'price', 'data' => 'price'];
        $columns[trans('product.fields.quantity')] = ['name' => 'quantity', 'data' => 'quantity'];
        $columns[trans('product.fields.featured')] = ['name' => 'featured', 'data' => 'featured'];
        $columns[trans('product.fields.active')] = ['name' => 'active', 'data' => 'active'];
        $columns['created_at'] = ['name' => 'created_at', 'data' => 'created_at', 'visible' => false];

        $this->columnsLength = sizeof($columns);

        return $columns;
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return '$MODEL_NAME_PLURAL_SNAKE_$datatable_' . time();
    }
}
