<?php

namespace App\DataTables;

use App\OrderDatatable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class OrderDatatables extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
//        return datatables()
//            ->eloquent($query)
//            ->addColumn('action', 'orderdatatables.action');

        $dataTable = new EloquentDataTable($query);
        return $dataTable->addColumn('action', 'categories.datatables_actions')
                         ->editColumn('icon', 'categories.grid.icon')
                         ->editColumn('image', 'categories.grid.image')
                         ->editColumn('active', 'categories.grid.active')
                         ->editColumn('menu', 'categories.grid.menu')
                         ->rawColumns(['icon', 'image', 'active', 'menu', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\OrderDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(OrderDatatable $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('orderdatatables-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            Column::make('id'),
            Column::make('add your columns'),
            Column::make('created_at'),
            Column::make('updated_at'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'OrderDatatables_' . date('YmdHis');
    }
}
