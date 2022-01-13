<?php
/**
 * Cart data-table class which handling module data-table actions
 *
 * @author Amk El-Kabbany at 31 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\DataTables;

use App\Models\Cart;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class CartDataTable extends DataTable
{
    /**
     * Columns array length
     *
     * @var integer
     *
     * @author Amk El-Kabbany at 31 May 2020
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

        return $dataTable->addColumn('action', 'carts.datatables_actions')
            ->editColumn('user_id', 'carts.grid.user')
            ->editColumn('id', 'carts.grid.items')
            ->editColumn('status', 'carts.grid.status')
            ->editColumn('created_at', 'carts.grid.created_at')
            ->editColumn('checked_out', 'carts.grid.checked_out')
            ->rawColumns(['user_id', 'id', 'status', 'created_at', 'checked_out', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Cart $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Cart $model)
    {
        return $model->where('deleted_at', null)->with('user', 'items');
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
                'order'     => [[($this->columnsLength-2), 'desc']],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        $columns =  [
            trans('cart.fields.user_id')  => ['name' => 'user_id', 'data' => 'user_id', 'defaultContent' => 'N/A'],
            trans('cart.fields.id')  => ['name' => 'id', 'data' => 'id', 'defaultContent' => 'N/A'],
            trans('cart.fields.status')  => ['name' => 'status', 'data' => 'status', 'defaultContent' => 'N/A'],
            trans('cart.fields.created_at')  => ['name' => 'created_at', 'data' => 'created_at', 'defaultContent' => 'N/A'],
            trans('cart.fields.checked_out')  => ['name' => 'checked_out', 'data' => 'checked_out', 'defaultContent' => 'N/A'],
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