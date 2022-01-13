<?php
/**
 * Category data-table class which handling module data-table actions
 *
 * @author Amk El-Kabbany at 29 Apr 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\DataTables;

use App\Models\Category;
use App\Models\Language;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class CategoryDataTable extends DataTable
{
    /**
     * Columns array length
     *
     * @var integer
     *
     * @author Amk El-Kabbany at 29 Apr 2020
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
     * @param \App\Models\Category $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Category $model)
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
        $language = Config::get('languages')[Request::ip()]['admin'];
        $columns =  [
            trans('category.fields.icon')  => ['name' => 'icon', 'data' => 'icon'],
            trans('category.fields.image')  => ['name' => 'image', 'data' => 'image'],
            trans('category.fields.title_en')  => ['name' => 'title_en', 'data' => 'title_en', 'defaultContent' => 'N/A'],
        ];
        $system_languages = Language::where('prefix', '!=', 'en')->pluck('prefix');
        foreach ($system_languages as $system_language) {
            $title = 'title_'.$system_language;
            $columns[trans("category.fields.$title")] = ['name' => $title, 'data' => "$title", 'defaultContent' => 'N/A'];
        }
        $columns[trans('category.fields.parent')]     = ['name' => 'parent', 'data' => "category.title_$language", 'defaultContent' => ' '];
        $columns[trans('category.fields.menu')] = ['name' => 'menu', 'data' => 'menu'];
        $columns[trans('category.fields.active')] = ['name' => 'active', 'data' => 'active'];
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
