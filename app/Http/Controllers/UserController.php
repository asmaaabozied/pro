<?php
/**
 * User controller class which handel more of business actions
 *
 * @author Amk El-Kabbany at 5 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Controllers;

use App\Core\Controllers\CustomizedAppBaseController;
use App\DataTables\UserDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\AccountsType;
use App\Models\Country;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Laracasts\Flash\Flash;
use Spatie\Permission\Contracts\Permission;
use Spatie\Permission\Models\Role;

class UserController extends CustomizedAppBaseController
{
    /** @var  UserRepository */
    private $userRepository;

    /**
     * Current Logged User Selected Language Prefix
     *
     * @var string
     *
     * @author Amk El-Kabbany at 5 May 2020
     * @contact alaa@upbeatdigital.team
     */
    protected $language;

    public function __construct(UserRepository $userRepo)
    {
        parent::__construct();
        $this->userRepository = $userRepo;
        $this->language = Config::get('languages')[Request::ip()]['admin'];
        $account_type = request()->input('account_type');
        Config::set('account_type_query', $account_type);
        ($account_type != null)
            ? Config::set('AccountType', trans("user.menu.$account_type"))
            : Config::set('AccountType', trans('user.menu.users'));

    }

    /**
     * Display a listing of the User.
     *
     * @param UserDataTable $userDataTable
     * @return Response
     */
    public function index(UserDataTable $userDataTable)
    {
        return $userDataTable->render('users.index');
    }

    /**
     * Show the form for creating a new User.
     *
     * @return Response
     */
    public function create()
    {
        $name = 'name_'.$this->language;
        $account_types = AccountsType::orderBy('type')->pluck('type', 'id');
        $countries = Country::where('deleted_at', null)->orderBy($name)->pluck($name, 'id');
        $roles = Role::where('name', '!=', 'super-admin')->orderBy('name')->pluck('name');
        $permissions = DB::table('permissions')->where('name', '!=', '')->orderBy('name')->pluck('name');

        return view('users.create', compact('account_types', 'countries', 'roles', 'permissions'));
    }

    /**
     * Store a newly created User in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        $input = $request->all();

        $user = $this->userRepository->create($input);

        if ($user != false) {
            Flash::success(trans('user.messages.created'));
        }

        return redirect(route('users.index'));
    }

    /**
     * Display the specified User.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error(trans('user.messages.not_found'));

            return redirect(route('users.index'));
        }

        return view('users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error(trans('user.messages.not_found'));

            return redirect(route('users.index'));
        }
        $name = 'name_'.$this->language;
        $account_types = AccountsType::orderBy('type')->pluck('type', 'id');
        $countries = Country::where('deleted_at', null)->orderBy($name)->pluck($name, 'id');
        $roles = DB::table('roles')->select('name')
            ->whereNotIn('name', $user->roles->pluck('name'))
            ->pluck('name')->toArray();
        $permissions = DB::table('permissions')->select('name')
            ->whereNotIn('name', $user->getPermissionsViaRoles()->pluck('name')->toArray())
            ->pluck('name')->toArray();

        return view('users.edit', compact('user', 'account_types', 'countries', 'roles', 'permissions'));
    }

    /**
     * Update the specified User in storage.
     *
     * @param  int              $id
     * @param CreateUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserRequest $request)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error(trans('user.messages.not_found'));

            return redirect(route('users.index'));
        }

        $user = $this->userRepository->update($request->all(), $id);

        if($user != false) {
            Flash::success(trans('user.messages.updated'));
        }

        return redirect(route('users.index'));
    }

    /**
     * Remove the specified User from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error(trans('user.messages.not_found'));

            return redirect(route('users.index'));
        }

        $flag = $this->userRepository->delete($id);

        if($flag){
            Flash::success(trans('user.messages.deleted'));
        }

        return redirect(route('users.index'));
    }

    /**
     * Remove permission from specific user.
     *
     * @param  int $role_id
     * @param  int $permission_id
     *
     * @return Response
     *
     * @author Amk El-Kabbany at 2 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function revokePermission($role_id, $permission_id)
    {
        $role = Role::find($role_id);
        $permission = Permission::find($permission_id);
        $role->revokePermissionTo($permission);
        Flash::success(trans('role.messages.role.permission_revoked'));
        return redirect()->back();
    }
}
