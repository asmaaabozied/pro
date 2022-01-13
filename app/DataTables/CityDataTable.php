<?php
/**
 * City data-table class which handling module data-table actions
 *
 * @author Amk El-Kabbany at 4 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\DataTables;

use App\Models\City;
use App\Models\Language;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class CityDataTable extends DataTable
{
    /**
     * Columns array length
     *
     * @var integer
     *
     * @author Amk El-Kabbany at 4 May 2020
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

        return $dataTable->addColumn('action', 'cities.datatables_actions')
                        ->editColumn('active', 'countries.grid.active')
                        ->rawColumns(['active', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\City $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(City $model)
    {
        return $model->where('deleted_at', null)->with('country');
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
            trans('city.fields.country_id')  => ['name' => 'country_id', 'data' => "country.name_$language", 'defaultContent' => 'N/A'],
            trans('city.fields.name_en')  => ['name' => 'name_en', 'data' => 'name_en', 'defaultContent' => 'N/A'],
        ];
        $system_languages = Language::where('prefix', '!=', 'en')->pluck('prefix');
        foreach ($system_languages as $system_language) {
            $title = 'name_'.$system_language;
            $columns[trans("city.fields.$title")] = ['name' => $title, 'data' => "$title", 'defaultContent' => 'N/A'];
        }
        $columns[trans('city.fields.postal_code')]     = ['name' => 'postal_code', 'data' => 'postal_code', 'defaultContent' => 'N/A'];
        $columns[trans('city.fields.active')] = ['name' => 'active', 'data' => 'active'];
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
