<?php
/**
 * Role repository class which handel more of logic actions
 *
 * @author Amk El-Kabbany at 2 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\User;
use Laracasts\Flash\Flash;
use Spatie\Permission\Models\Role;

/**
 * Class RoleRepository
 * @package App\Repositories
 * @version May 3, 2020, 9:02 am UTC
 *
 * @author Amk El-Kabbany at 2 May 2020
 * @contact alaa@upbeatdigital.team
*/

class RoleRepository extends BaseRepository
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
     * Class constructor
     *
     * @author Amk El-Kabbany at 4 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function __construct()
    {
        parent::__construct(app());
        $this->fieldSearchable = array_keys(alterLangArrayElements('roles', ['fields' => array_combine($this->fieldSearchable,$this->fieldSearchable)], $key = 'fields')['fields']);
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Role::class;
    }

    /**
     * Create model record
     *
     * @param array $input
     *
     * @return Role
     *
     * @author Amk El-Kabbany at 2 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function create($input)
    {
        $role = new Role();
        $input['guard_name'] = 'api';
        $role->fill($input)->save();

        return $role;
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

        if ($id == 1) {
            Flash::error(trans('role.messages.role.can_not_delete'));
            return false;
        }

        if (User::role((Role::find($id)))->exists()) {
            Flash::error(trans('role.messages.role.role_user_assigned'));
            return false;
        }

        if (empty((Role::find($id))->permissions->toArray())) {
            Flash::error(trans('role.messages.role.role_permission_assigned'));
            return false;
        }

        return $role->delete();
    }
}
