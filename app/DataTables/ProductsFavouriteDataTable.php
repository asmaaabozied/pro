<?php
/**
 * Product favorites and reviews data-table class which handling module data-table actions
 *
 * @author Amk El-Kabbany at 27 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\DataTables;

use App\Models\ProductsFavourite;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class ProductsFavouriteDataTable extends DataTable
{
    /**
     * Columns array length
     *
     * @var integer
     *
     * @author Amk El-Kabbany at 27 May 2020
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

        return $dataTable->addColumn('action', 'products_favourites.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ProductsFavourite $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ProductsFavourite $model)
    {
        return $model->where('deleted_at', null)->with('product', 'user');
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
        $title = 'title_'.Config::get('languages')[Request::ip()]['admin'];
        $columns =  [
            trans('productRating.fields.product_id')  => ['name' => 'product_id', 'data' => "product.$title", 'defaultContent' => 'N/A'],
            trans('productRating.fields.user_id')  => ['name' => 'user_id', 'data' => 'user.name', 'defaultContent' => 'N/A'],
            trans('productRating.fields.created_at')  => ['name' => 'created_at', 'data' => 'created_at', 'visible' => false],
        ];

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
