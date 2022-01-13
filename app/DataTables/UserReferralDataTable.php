<?php
/**
 * User data-table class which handling module data-table actions
 *
 * @author Amk El-Kabbany at 5 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\DataTables;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class UserReferralDataTable extends DataTable
{
    /**
     * Columns array length
     *
     * @var integer
     *
     * @author Amk El-Kabbany at 5 May 2020
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

        return $dataTable->addColumn('action', 'users_referral.datatables_actions')
            ->editColumn('image', 'users_referral.grid.image')
            ->editColumn('email', 'users_referral.grid.email')
            ->editColumn('mobile', 'users_referral.grid.mobile')
            ->editColumn('status', 'users_referral.grid.status')
            ->editColumn('activated', 'users_referral.grid.activated')
            ->editColumn('mobile_verified', 'users_referral.grid.mobile_verified')
            ->editColumn('email_verified', 'users_referral.grid.email_verified')
            ->rawColumns(['image', 'email', 'mobile', 'status', 'activated', 'mobile_verified', 'email_verified', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->where('deleted_at', null)->with( 'country', 'city')->withCount('referrals' ,'gifts');
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
                'order'     => [[5, 'desc']],
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
            trans('user.fields.image')  => ['name' => 'image', 'data' => 'image', 'defaultContent' => ''],
            // trans('user.fields.account_type')  => ['name' => 'account_type', 'data' => 'account_type.type', 'defaultContent' => 'N/A'],
            trans('user.fields.status')  => ['name' => 'status', 'data' => 'status', 'defaultContent' => 'N/A'],
            trans('user.fields.name')  => ['name' => 'name', 'data' => 'name', 'defaultContent' => 'N/A'],
            trans('user.fields.email')  => ['name' => 'email', 'data' => 'email', 'defaultContent' => 'N/A'],
            trans('user.fields.mobile')  => ['name' => 'mobile', 'data' => 'mobile', 'defaultContent' => 'N/A'],
            // trans('user.fields.country_id')  => ['name' => 'country_id', 'data' => "country.name_$language", 'defaultContent' => 'N/A'],
            // trans('user.fields.city_id')  => ['name' => 'city_id', 'data' => "city.name_$language", 'defaultContent' => 'N/A'],
            // trans('user.fields.address')  => ['name' => 'address', 'data' => 'address', 'defaultContent' => 'N/A'],
            // trans('user.fields.activated')  => ['name' => 'activated', 'data' => 'activated', 'defaultContent' => 'N/A'],
            // trans('user.fields.mobile_verified')  => ['name' => 'mobile_verified', 'data' => 'mobile_verified', 'defaultContent' => 'N/A'],
            // trans('user.fields.email_verified')  => ['name' => 'email_verified', 'data' => 'email_verified', 'defaultContent' => 'N/A'],
            trans('user.fields.referrals_count')  => ['name' => 'referral_code', 'data' => 'referrals_count', 'defaultContent' => 0],
            trans('user.fields.gifts_count')  => ['name' => 'user_code', 'data' => 'gifts_count', 'defaultContent' => 0],
            trans('user.fields.created_at')  => ['name' => 'created_at', 'data' => 'created_at', 'visible' => false],
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
