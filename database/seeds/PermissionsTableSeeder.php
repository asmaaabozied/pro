<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsTableSeeder extends Seeder {

    /**
     * Insert modules permissions in permission table, and give super admin grant access
     * @return void
     *
     * @author Amk El-Kabbany at 2 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function run() {
        if(DB::table('roles')->where('name', 'super-admin')->exists()) {
            $superAdminRole = Role::find(1);
        } else {
            $superAdminRole = Role::create(['id' => 1, 'name' => 'super-admin', 'guard_name' => 'api']);
        }

        foreach (Permission::all() as $permission) {
            $permission->assignRole($superAdminRole);
        }

        foreach (trans('modules.name') as $module) {
            if(! DB::table('roles')->where('name', $module)->exists()) {
                $role = Role::create(['name' => $module, 'guard_name' => 'api']);
            } else {
                $role = Role::where('name', $module)->first();
            }

            if(! DB::table('permissions')->where('name', $module)->exists()) {
                foreach(trans('modules.permissions') as $modulePermission) {
                    if(! DB::table('permissions')->where('name', $module . '.' . $modulePermission)->exists()) {
                        $permission = Permission::create(['name' => $module . '.' . $modulePermission, 'guard_name' => 'api']);

                    } else {
                        $permission = Permission::where('name', $module . '.' . $modulePermission)->first();
                    }
                    $permission->assignRole($superAdminRole);
                    $permission->assignRole($role);
                }
            }
        }
    }

}
