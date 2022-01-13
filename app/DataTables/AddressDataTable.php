<?php
/**
 * Address data-table class which handling module data-table actions
 *
 * @author Amk El-Kabbany at 9 July 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\DataTables;

use App\Models\Address;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class AddressDataTable extends DataTable
{
    /**
     * Columns array length
     *
     * @var integer
     *
     * @author Amk El-Kabbany at 14 July 2020
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

        return $dataTable->addColumn('action', 'addresses.datatables_actions')
                        ->editColumn('main', 'addresses.grid.main')
                        ->rawColumns(['main', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Address $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Address $model)
    {
        return $model->where('deleted_at', null)->with('user', 'country', 'city');
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
        $name = 'name_'.Config::get('languages')[Request::ip()]['admin'];
        $columns = [
            trans('address.fields.user_id')  => ['name' => 'user_id', 'data' => "user.name", 'defaultContent' => 'N/A'],
            trans('address.fields.name')  => ['name' => 'name', 'data' => 'name', 'defaultContent' => 'N/A'],
            trans('address.fields.address')  => ['name' => 'address', 'data' => 'address', 'defaultContent' => 'N/A'],
            trans('address.fields.mobile')  => ['name' => 'mobile', 'data' => 'mobile', 'defaultContent' => 'N/A'],
            trans('address.fields.country_id')  => ['name' => 'country_id', 'data' => "country.$name", 'defaultContent' => 'N/A'],
            trans('address.fields.city_id')  => ['name' => 'city_id', 'data' => "city.$name", 'defaultContent' => 'N/A'],
            trans('address.fields.main')  => ['name' => 'main', 'data' => 'main'],
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
