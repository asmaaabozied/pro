<?php
/**
 * Social Media Link data-table class which handling module data-table actions
 *
 * @author Amk El-Kabbany at 7 June 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\DataTables;

use App\Models\Language;
use App\Models\SocialMediaLink;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class SocialMediaLinkDataTable extends DataTable
{
    /**
     * Columns array length
     *
     * @var integer
     *
     * @author Amk El-Kabbany at 7 June 2020
     * @contact alaa@upbeatdigital.team
     */
    protected $columnsLength;
    
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     *
     * @author Amk El-Kabbany at 7 June 2020
     * @contact alaa@upbeatdigital.team
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable->addColumn('action', 'socialMediaLinks.datatables_actions')
                        ->editColumn('link', 'socialMediaLinks.grid.link')
                        ->editColumn('icon', 'socialMediaLinks.grid.icon')
                        ->editColumn('active', 'socialMediaLinks.grid.active')
                        ->rawColumns(['link', 'icon', 'class', 'active', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\SocialMediaLink $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(SocialMediaLink $model)
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
            trans('socialMediaLink.fields.icon')  => ['name' => 'icon', 'data' => 'icon', 'defaultContent' => 'N/A'],
            trans('socialMediaLink.fields.title_en')  => ['name' => 'title_en', 'data' => 'title_en', 'defaultContent' => 'N/A'],
        ];

        $system_languages = Language::where('prefix', '!=', 'en')->pluck('prefix');
        foreach ($system_languages as $system_language) {
            $title = 'title_'.$system_language;
            $columns[trans("socialMediaLink.fields.$title")] = ['name' => $title, 'data' => "$title", 'defaultContent' => 'N/A'];
        }
        $columns[trans('socialMediaLink.fields.link')] = ['name' => 'link', 'data' => 'link', 'defaultContent' => 'N/A'];
        $columns[trans('socialMediaLink.fields.active')] = ['name' => 'active', 'data' => 'active', 'defaultContent' => 'N/A'];
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
