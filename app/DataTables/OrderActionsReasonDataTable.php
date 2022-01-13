<?php
/**
 * Order actions reason data-table class which handling module data-table actions
 *
 * @author Amk El-Kabbany at 14 July 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\DataTables;

use App\Models\Language;
use App\Models\OrderActionsReason;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class OrderActionsReasonDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'order_actions_reasons.datatables_actions')
                        ->editColumn('type', 'order_actions_reasons.grid.type')
                        ->editColumn('active', 'order_actions_reasons.grid.active')
                        ->rawColumns(['type', 'active', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\OrderActionsReason $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(OrderActionsReason $model)
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
        $columns = [

            trans('orderActionsReason.fields.type')  => ['name' => 'type', 'data' => 'type', 'defaultContent' => 'N/A'],
            trans('orderActionsReason.fields.title_en')  => ['name' => 'title_en', 'data' => 'title_en', 'defaultContent' => 'N/A'],
        ];
        $system_languages = Language::where('prefix', '!=', 'en')->pluck('prefix');
        foreach ($system_languages as $system_language) {
            $title = 'title_'.$system_language;
            $columns[trans("orderActionsReason.fields.$title")] = ['name' => $title, 'data' => "$title", 'defaultContent' => 'N/A'];
        }
        $columns[trans('orderActionsReason.fields.active')] = ['name' => 'active', 'data' => 'active'];

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
