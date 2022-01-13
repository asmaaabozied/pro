<?php
/**
 * Category Attribute data-table class which handling module data-table actions
 *
 * @author Amk El-Kabbany at 12 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\DataTables;

use App\Models\CategoryAttribute;
use App\Models\Language;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class CategoryAttributeDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'category_attributes.datatables_actions')
                          ->editColumn('active', 'category_attributes.grid.active')
                          ->rawColumns(['active', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\CategoryAttribute $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(CategoryAttribute $model)
    {
        return $model->where('deleted_at', null)->with('category');
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
        $title = 'title_'.Config::get('languages')[Request::ip()]['admin'];
        $columns =  [
            trans('categoryAttribute.fields.category_id')  => ['name' => 'category_id', 'data' => "category.$title"],
            trans('categoryAttribute.fields.name_en')  => ['name' => 'name_en', 'data' => 'name_en', 'defaultContent' => 'N/A'],
        ];
        $system_languages = Language::where('prefix', '!=', 'en')->pluck('prefix');
        foreach ($system_languages as $system_language) {
            $name = 'name_'.$system_language;
            $columns[trans("categoryAttribute.fields.$name")] = ['name' => $name, 'data' => "$name", 'defaultContent' => 'N/A'];
        }
        $columns[trans('categoryAttribute.fields.unit_en')] = ['name' => 'unit_en', 'data' => 'unit_en', 'defaultContent' => 'N/A'];
        foreach ($system_languages as $system_language) {
            $unit = 'unit_'.$system_language;
            $columns[trans("categoryAttribute.fields.$unit")] = ['unit' => $unit, 'data' => "$unit", 'defaultContent' => 'N/A'];
        }
        $columns[trans('categoryAttribute.fields.active')] = ['name' => 'active', 'data' => 'active'];
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
