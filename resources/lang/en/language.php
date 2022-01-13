<?php
/**
 * Language English Language Messages.
 *
 * @author Amk El-Kabbany at 30 Apr 2020
 * @contact alaa@upbeatdigital.team
 */
$array = [

    /*
    |--------------------------------------------------------------------------
    | Language English Messages
    |--------------------------------------------------------------------------
    |
    | The following English lines are used in Language module related actions. These messages
    | that needed to display to the user.
    |
    */

    'update_schema' => 'Refresh System',
    'menu'          => 'Languages',
    'fields'        => [
        'prefix'      => 'Language Prefix',
        'prefix_help' => 'Please, enter the language prefix here',
    ],
    'messages'        => [
        'created'       => 'Language has been created successfully.',
        'updated'       => 'Language has been updated successfully.',
        'deleted'       => 'Requested language has been deleted successfully.',
        'can_not_delete'=> 'Sorry, This language can not be removed',
        'not_found'     => 'Requested language is not found',
        'schema_altered'=> 'Applications modules has been refreshed with all system provided languages successfully',
    ],
];

return $array;
