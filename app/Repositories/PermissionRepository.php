<?php
/**
 * Permission repository class which handel more of logic actions
 *
 * @author Amk El-Kabbany at 2 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\User;
use Laracasts\Flash\Flash;
use Spatie\Permission\Models\Permission;

/**
 * Class PermissionRepository
 * @package App\Repositories
 * @version May 3, 2020, 9:10 am UTC
 *
 * @author Amk El-Kabbany at 2 May 2020
 * @contact alaa@upbeatdigital.team
*/

class PermissionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'guard_name'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Permission::class;
    }

    /**
     * Create model record
     *
     * @param array $input
     *
     * @return Permission
     *
     * @author Amk El-Kabbany at 2 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function create($input)
    {
        $permission = new Permission();
        $input['guard_name'] = 'api';

        $roles = [];
        if(isset($input['roles'])) {
            $roles = $input['roles'];
            unset($input['roles']);
        }

        $permission->fill($input)->save();
        foreach($roles as $role) {
            $permission->assignRole($role);
        }
        return $permission;
    }

    /**
     * Update model record for given id
     *
     * @param array $input
     * @param int $id
     *
     * @author Amk El-Kabbany at 2 May 2020
     * @contact alaa@upbeatdigital.team
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model
     */
    public function update($input, $id)
    {
        $query = $this->model->newQuery();
        $permission = $query->findOrFail($id);

        $roles = [];
        if(isset($input['roles'])) {
            $roles = $input['roles'];
            unset($input['roles']);
        }

        $permission->fill($input)->save();
        foreach($roles as $role) {
            $permission->assignRole($role);
        }

        return $permission;
    }

    /**
     * @param int $id
     *
     * @throws \Exception
     *
     * @return bool|mixed|null
     *
     * @author Amk El-Kabbany at 2 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function delete($id)
    {
        $query = $this->model->newQuery();
        $role = $query->findOrFail($id);

        if (User::permission((Permission::find($id)))->exists()) {
            Flash::error(trans('role.messages.permission.permission_user_assigned'));
            return false;
        }

        return $role->delete();
    }
}
