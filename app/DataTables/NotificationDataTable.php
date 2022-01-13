<?php
/**
 * Notification data-table class which handling module data-table actions
 *
 * @author Amk El-Kabbany at 9 June 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\DataTables;

use App\Models\Language;
use App\Models\Notification;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class NotificationDataTable extends DataTable
{
    /**
     * Columns array length
     *
     * @var integer
     *
     * @author Amk El-Kabbany at 9 June 2020
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

        return $dataTable->addColumn('action', 'notifications.datatables_actions')
                        ->editColumn('active', 'notifications.grid.active')
                        ->editColumn('type', 'notifications.grid.type')
                        ->editColumn('general', 'notifications.grid.general')
                        ->editColumn('module_id', 'notifications.grid.link')
                        ->rawColumns(['active', 'type', 'general', 'module_id', 'action']);

    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Notification $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Notification $model)
    {
        return $model->newQuery()->with('users');
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
            trans('notification.fields.type')  => ['name' => 'type', 'data' => 'type', 'defaultContent' => 'N/A'],
            trans('notification.fields.notification_en')  => ['name' => 'notification_en', 'data' => 'notification_en', 'defaultContent' => 'N/A'],
        ];
        $system_languages = Language::where('prefix', '!=', 'en')->pluck('prefix');
        foreach ($system_languages as $system_language) {
            $notification = 'notification_'.$system_language;
            $columns[trans("notification.fields.$notification")] = ['name' => $notification, 'data' => "$notification", 'defaultContent' => 'N/A'];
        }
        $columns[trans('notification.fields.link')] = ['name' => 'module_id', 'data' => 'module_id', 'defaultContent' => 'N/A'];
        $columns[trans('notification.fields.general')] = ['name' => 'general', 'data' => 'general'];
        $columns[trans('notification.fields.active')] = ['name' => 'active', 'data' => 'active'];
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
