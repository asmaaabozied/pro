<?php
/**
 * Role & Permissions English Language Messages.
 *
 * @author Amk El-Kabbany at 2 May 2020
 * @contact alaa@upbeatdigital.team
 */
$array = [

    /*
    |--------------------------------------------------------------------------
    | Role & Permissions English Messages
    |--------------------------------------------------------------------------
    |
    | The following English lines are used in Role & Permissions module related actions. These messages
    | that needed to display to the user.
    |
    */

    'menu'   => [
        'name'       => 'Roles & Permissions',
        'role'       => 'Roles',
        'permission' => 'Permissions',
    ],
    'fields' => [
        'role' => [
            'name'      => 'Role Slug Name',
            'name_help' => 'Please, enter a unique role slug name here',
            'assigned_permissions' => 'This Role Assigned Permissions',
        ],
        'permission' => [
            'name'      => 'Permission Slug Name',
            'name_help' => 'Please, enter a unique permission slug name here',
            'role'      => 'Assign To Roles',
            'role_help' => 'Please, choose which roles assigned to this permission here',
            'assigned_roles' => 'This Permission Assigned Roles',
        ],
    ],
    'refresh_permissions' => 'Refresh Permissions',
    'messages' => [
        'role' =>   [
            'created'       => 'Role has been created successfully.',
            'updated'       => 'Role has been updated successfully.',
            'deleted'       => 'Requested role has been deleted successfully.',
            'not_found'     => 'Requested role is not found',
            'can_not_delete'=> 'Sorry, This role can not be removed',
            'role_user_assigned'        => 'This role is already assigned to some user, please remove this link first',
            'permission_revoked'        => 'The requested permission has been revoked from requested role successfully',
            'role_permission_assigned'  => 'This role is already have some permissions, please remove them first',
        ],
        'permission' =>   [
            'created'       => 'Permission has been created successfully.',
            'updated'       => 'Permission has been updated successfully.',
            'deleted'       => 'Requested permission has been deleted successfully.',
            'not_found'     => 'Requested permission is not found',
            'can_not_delete'=> 'Sorry, This permission can not be removed',
            'refreshed'     => 'Application permission has been refreshed, and grant access for super admin successfully',
            'permission_user_assigned'  => 'This permission is already assigned to some user, please remove this link first',
        ],
    ],
];

return $array;
