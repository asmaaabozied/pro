<?php
/**
 * Store subscription data-table class which handling module data-table actions
 *
 * @author Amk El-Kabbany at 12 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\DataTables;

use App\Models\StoreSubscription;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class StoreSubscriptionDataTable extends DataTable
{
    /**
     * Columns array length
     *
     * @var integer
     *
     * @author Amk El-Kabbany at 12 May 2020
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

        return $dataTable->addColumn('action', 'store_subscriptions.datatables_actions')
                        ->editColumn('expire_date', 'store_subscriptions.grid.expire_date')
                        ->editColumn('active', 'store_subscriptions.grid.active')
                        ->editColumn('created_at', 'store_subscriptions.grid.created_at')
                        ->rawColumns(['expire_date', 'active', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\StoreSubscription $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(StoreSubscription $model)
    {
        return $model->where('deleted_at', null)->limited()->with('store', 'subscription');
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
            trans('storeSubscription.fields.store_id')  => ['name' => 'store_id', 'data' => "store.name_$language", 'defaultContent' => 'N/A'],
            trans('storeSubscription.fields.subscription_id')  => ['name' => 'subscription_id', 'data' => "subscription.title_$language", 'defaultContent' => 'N/A'],
            trans('storeSubscription.fields.actual_price')  => ['name' => 'actual_price', 'data' => 'actual_price', 'defaultContent' => 'N/A'],
            trans('storeSubscription.fields.price')  => ['name' => 'price', 'data' => 'price', 'defaultContent' => 'N/A'],
            trans('storeSubscription.fields.duration')  => ['name' => 'duration', 'data' => 'duration', 'defaultContent' => 'N/A'],
            trans('storeSubscription.fields.subscribe_date')  => ['name' => 'created_at', 'data' => 'created_at'],
            trans('storeSubscription.fields.expire_date')  => ['name' => 'expire_date', 'data' => 'expire_date', 'defaultContent' => 'N/A'],
            trans('storeSubscription.fields.active')  => ['name' => 'active', 'data' => 'active', 'defaultContent' => 'N/A'],
            trans('storeSubscription.fields.created_at')  => ['name' => 'created_at', 'data' => 'created_at', 'visible' => false],
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
