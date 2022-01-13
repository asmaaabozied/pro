<?php
/**
 * storeRating data-table class which handling module data-table actions
 *
 * @author Amk El-Kabbany at 11 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\DataTables;

use App\Models\Language;
use App\Models\StoreRating;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class StoreRatingDataTable extends DataTable
{
    /**
     * Columns array length
     *
     * @var integer
     *
     * @author Amk El-Kabbany at 10 May 2020
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

        return $dataTable->addColumn('action', 'store_ratings.datatables_actions')
                        ->editColumn('rate', 'store_ratings.grid.rate')
                        ->rawColumns(['rate', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\StoreRating $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(StoreRating $model)
    {
        return $model->where('deleted_at', null)->limited()->with('store', 'user');
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
        $name = 'name_'.Config::get('languages')[Request::ip()]['admin'];
        $columns =  [
            trans('storeRating.fields.user_id')  => ['name' => 'user_id', 'data' => 'user.name', 'defaultContent' => 'N/A'],
            trans('storeRating.fields.store_id')  => ['name' => 'store_id', 'data' => "store.$name", 'defaultContent' => 'N/A'],
            trans('storeRating.fields.rate')  => ['name' => 'rate', 'data' => 'rate', 'defaultContent' => 'N/A'],
            trans('storeRating.fields.review')  => ['name' => 'review', 'data' => 'review', 'defaultContent' => 'N/A'],
            trans('storeRating.fields.created_at')  => ['name' => 'created_at', 'data' => 'created_at', 'visible' => false],
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
