<?php
/**
 * Support Ticket data-table class which handling module data-table actions
 *
 * @author Amk El-Kabbany at 8 June 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\DataTables;

use App\Models\SupportTicket;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class SupportTicketDataTable extends DataTable
{
    /**
     * Columns array length
     *
     * @var integer
     *
     * @author Amk El-Kabbany at 8 June 2020
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

        return $dataTable->addColumn('action', 'support_tickets.datatables_actions')
                        ->editColumn('type', 'support_tickets.grid.type')
                        ->editColumn('email', 'support_tickets.grid.email')
                        ->editColumn('phone', 'support_tickets.grid.phone')
                        ->editColumn('responded', 'support_tickets.grid.responded')
                        ->rawColumns(['type', 'responded', 'email', 'phone', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\SupportTicket $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(SupportTicket $model)
    {
        return $model->where('deleted_at', null);
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
        $columns =  [
            trans('supportTicket.fields.type')  => ['name' => 'type', 'data' => 'type', 'defaultContent' => 'N/A'],
            trans('supportTicket.fields.name')  => ['name' => 'name', 'data' => 'name', 'defaultContent' => 'N/A'],
            trans('supportTicket.fields.email')  => ['name' => 'email', 'data' => 'email', 'defaultContent' => 'N/A'],
            trans('supportTicket.fields.phone')  => ['name' => 'phone', 'data' => 'phone', 'defaultContent' => 'N/A'],
            trans('supportTicket.fields.address')  => ['name' => 'address', 'data' => 'address', 'defaultContent' => 'N/A'],
            trans('supportTicket.fields.responded')  => ['name' => 'responded', 'data' => 'responded', 'defaultContent' => 'N/A'],
            trans('supportTicket.fields.created_at')  => ['name' => 'created_at', 'data' => 'created_at', 'visible' => false],
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
