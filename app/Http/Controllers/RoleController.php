<?php
/**
 * Roles controller class which handel more of business actions
 *
 * @author Amk El-Kabbany at 2 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Controllers;

use App\Core\Controllers\CustomizedAppBaseController;
use App\DataTables\RoleDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Repositories\RoleRepository;
use App\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Response;
use Laracasts\Flash\Flash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends CustomizedAppBaseController
{
    /** @var  RoleRepository */
    private $roleRepository;

    public function __construct(RoleRepository $roleRepo)
    {
        parent::__construct();
        $this->roleRepository = $roleRepo;
    }

    /**
     * Display a listing of the Role.
     *
     * @param RoleDataTable $roleDataTable
     * @return Response
     */
    public function index(RoleDataTable $roleDataTable)
    {
        return $roleDataTable->render('roles.index');
    }

    /**
     * Show the form for creating a new Role.
     *
     * @return Response
     */
    public function create()
    {
        return view('roles.create');
    }

    /**
     * Store a newly created Role in storage.
     *
     * @param CreateRoleRequest $request
     *
     * @return Response
     */
    public function store(CreateRoleRequest $request)
    {
        $input = $request->all();

        $role = $this->roleRepository->create($input);

        Flash::success(trans('role.messages.role.created'));

        return redirect(route('roles.index'));
    }

    /**
     * Display the specified Role.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $role = $this->roleRepository->find($id);

        if (empty($role)) {
            Flash::error(trans('role.messages.role.not_found'));

            return redirect(route('roles.index'));
        }

        return view('roles.show')->with('role', $role);
    }

    /**
     * Show the form for editing the specified Role.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $role = $this->roleRepository->find($id);

        if (empty($role)) {
            Flash::error(trans('role.messages.role.not_found'));

            return redirect(route('roles.index'));
        }

        if ($id == 1 && (! Cache::get('currentUser')->hasRole('super-admin'))) {
            Flash::error(trans('common.messages.no_access'));

            return redirect(route('roles.index'));
        }

        return view('roles.edit')->with('role', $role);
    }

    /**
     * Update the specified Role in storage.
     *
     * @param  int              $id
     * @param UpdateRoleRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRoleRequest $request)
    {
        $role = $this->roleRepository->find($id);

        if (empty($role)) {
            Flash::error(trans('role.messages.role.not_found'));

            return redirect(route('roles.index'));
        }

        $role = $this->roleRepository->update($request->all(), $id);

        Flash::success(trans('role.messages.role.updated'));

        return redirect(route('roles.index'));
    }

    /**
     * Remove the specified Role from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $role = $this->roleRepository->find($id);

        if (empty($role)) {
            Flash::error(trans('role.messages.role.not_found'));

            return redirect(route('roles.index'));
        }

        $flag = $this->roleRepository->delete($id);

        if($flag){
            Flash::success(trans('role.messages.role.deleted'));
        }

        return redirect(route('roles.index'));
    }

    /**
     * Remove permission from specific user.
     *
     * @param  int $user_id
     * @param  int $permission_id
     *
     * @return Response
     *
     * @author Amk El-Kabbany at 6 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function revokePermission($user_id, $permission_id)
    {
        $user = User::find($user_id);
        $permission = Permission::find($permission_id);
        $user->revokePermissionTo($permission);
        Flash::success(trans('user.messages.permission_revoked'));
        return redirect()->back();
    }

    /**
     * Remove role from specific user.
     *
     * @param  int $user_id
     * @param  int $role_id
     *
     * @return Response
     *
     * @author Amk El-Kabbany at 6 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function revokeRole($user_id, $role_id)
    {
        $user = User::find($user_id);
        $role = Role::find($role_id);
        $user->removeRole($role);
        Flash::success(trans('user.messages.role_revoked'));
        return redirect()->back();
    }
}
