<?php
/**
 * Order actions reason data-table class which handling module data-table actions
 *
 * @author Amk El-Kabbany at 15 July 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\DataTables;

use App\Models\OrderAction;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class OrderActionDataTable extends DataTable
{
    /**
     * Columns array length
     *
     * @var integer
     *
     * @author Amk El-Kabbany at 9 July 2020
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

        return $dataTable->addColumn('action', 'order_actions.datatables_actions')
                        ->editColumn('status', 'order_actions.grid.status')
                        ->editColumn('responded', 'order_actions.grid.responded')
                        ->rawColumns(['status', 'responded', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\OrderAction $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(OrderAction $model)
    {
        return $model->where('deleted_at', null)->where('type', 'product')->with('order', 'reason');
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
        $reason = 'reason_'.Config::get('languages')[Request::ip()]['admin'];
        $columns = [
            trans('orderAction.fields.status')  => ['name' => 'status', 'data' => 'status', 'defaultContent' => 'N/A'],
            trans('orderAction.fields.product_id')  => ['name' => 'order.status', 'data' => 'order.status', 'defaultContent' => 'N/A'],
            trans('orderAction.fields.reason_id')  => ['name' => 'reason_id', 'data' => "reason.$reason", 'defaultContent' => 'N/A'],
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
