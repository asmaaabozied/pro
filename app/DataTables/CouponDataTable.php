<?php

namespace App\DataTables;

use App\Models\Coupon;
use App\Models\Language;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class CouponDataTable extends DataTable
{
    /**
     * Columns array length
     *
     * @var integer
     *
     * @author Amk El-Kabbany at 22 July 2020
     * @contact asmaa@upbeatdigital.team
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

        return $dataTable->addColumn('action', 'coupons.datatables_actions')
                        ->editColumn('active', 'coupons.grid.active')
                        ->editColumn('featured', 'coupons.grid.featured')
                        ->editColumn('inslider', 'coupons.grid.inslider')
                        ->rawColumns(['active', 'featured', 'inslider', 'action']);

            // ->editColumn('image_path', 'coupons.grid.image_path');
            // ->rawColumns(['image_path', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Coupon $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Coupon $model)
    {
        return $model->where('deleted_at', null)->limited()->with('category', 'city');
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
                'order'     => [[0, 'desc']],
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
        $name = 'name_'.$language;
        $title = 'title_'.$language;
        $columns = [
            // trans('coupons.image_path')  => ['name' => 'image', 'data' => "image", 'defaultContent' => 'N/A'],
            trans('coupons.title_en')  => ['name' => 'title_en', 'data' => "title_en", 'defaultContent' => 'N/A'],
        ];
        $system_languages = Language::where('prefix', '!=', 'en')->pluck('prefix');
        foreach ($system_languages as $system_language) {
            $title = 'title_'.$system_language;
            $columns[trans("coupons.$title")] = ['name' => $title, 'data' => "$title", 'defaultContent' => 'N/A'];
        }
        $columns[trans("coupons.category_id")] = ['name' => 'category_id', 'data' => "category.$title", 'defaultContent' => 'N/A'];
        $columns[trans("coupons.city_id")] = ['name' => 'city_id', 'data' => "city.$name", 'defaultContent' => 'N/A'];
        $columns[trans('coupons.fields.active')] = ['name' => 'active', 'data' => 'active'];
        $columns[trans('coupons.fields.featured')] = ['name' => 'featured', 'data' => 'featured'];
        $columns[trans('coupons.fields.inslider')] = ['name' => 'inslider', 'data' => 'inslider'];


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
