<?php
/**
 * Store data-table class which handling module data-table actions
 *
 * @author Amk El-Kabbany at 7 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\DataTables;

use App\Models\Language;
use App\Models\Store;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class StoreDataTable extends DataTable
{
    /**
     * Columns array length
     *
     * @var integer
     *
     * @author Amk El-Kabbany at 7 May 2020
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

        return $dataTable->addColumn('action', 'stores.datatables_actions')
                        ->editColumn('owner_id', 'stores.grid.owner')
                        ->editColumn('phone', 'stores.grid.phone')
                        ->editColumn('image', 'stores.grid.image')
                        ->editColumn('activated', 'stores.grid.activated')
                        ->rawColumns(['phone', 'image', 'activated', 'owner_id', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Store $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Store $model)
    {
        return $model->where('deleted_at', null)->limited()->with('type', 'owner');
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
            trans('store.fields.image')  => ['name' => 'image', 'data' => 'image'],
            trans('store.fields.store_type')  => ['name' => 'store_type', 'data' => "type.type_$language", 'defaultContent' => 'N/A'],
            trans('store.fields.name_en')  => ['name' => 'name_en', 'data' => 'name_en', 'defaultContent' => 'N/A'],
        ];
        $system_languages = Language::where('prefix', '!=', 'en')->pluck('prefix');
        foreach ($system_languages as $system_language) {
            $title = 'name_'.$system_language;
            $columns[trans("store.fields.$title")] = ['name' => $title, 'data' => "$title", 'defaultContent' => 'N/A'];
        }
        $columns[trans('store.fields.phone')] = ['name' => 'phone', 'data' => 'phone'];
        $columns[trans('store.fields.owner_id')] = ['name' => 'owner_id', 'data' => 'owner_id'];
        $columns[trans('store.fields.status')] = ['name' => 'status', 'data' => 'status'];
        $columns[trans('store.fields.activated')] = ['name' => 'activated', 'data' => 'activated'];
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
