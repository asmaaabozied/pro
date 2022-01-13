<?php
/**
 * Voucher data-table class which handling module data-table actions
 *
 * @author Amk El-Kabbany at 31 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\DataTables;

use App\Models\Voucher;
use App\Models\Language;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class VoucherDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'vouchers.datatables_actions')
                        ->editColumn('start_date', 'vouchers.grid.start_date')
                        ->editColumn('end_date', 'vouchers.grid.end_date')
                        ->editColumn('active', 'vouchers.grid.active')
                        ->rawColumns(['active', 'start_date', 'end_date', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Voucher $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Voucher $model)
    {
        return $model->where('deleted_at', null)->limited();
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
            trans('voucher.fields.title_en')  => ['name' => 'title_en', 'data' => 'title_en', 'defaultContent' => 'N/A'],
        ];
        $system_languages = Language::where('prefix', '!=', 'en')->pluck('prefix');
        foreach ($system_languages as $system_language) {
            $title = 'title_'.$system_language;
            $columns[trans("voucher.fields.$title")] = ['name' => $title, 'data' => "$title", 'defaultContent' => 'N/A'];
        }
        $columns[trans('voucher.fields.code')] = ['name' => 'code', 'data' => 'code'];
        $columns[trans('voucher.fields.rate')] = ['name' => 'rate', 'data' => 'rate'];
        $columns[trans('voucher.fields.count')] = ['name' => 'count', 'data' => 'count'];
        $columns[trans('voucher.fields.usage')] = ['name' => 'usage', 'data' => 'usage'];
        $columns[trans('voucher.fields.start_date')] = ['name' => 'start_date', 'data' => 'start_date'];
        $columns[trans('voucher.fields.end_date')] = ['name' => 'end_date', 'data' => 'end_date'];
        $columns[trans('voucher.fields.active')] = ['name' => 'end_date', 'data' => 'active'];
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
