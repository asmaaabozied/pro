<?php
/**
 * Notification English Language Messages.
 *
 * @author Amk El-Kabbany at 25 June 2020
 * @contact alaa@upbeatdigital.team
 */
$array = [

    /*
    |--------------------------------------------------------------------------
    | Notification English Messages
    |--------------------------------------------------------------------------
    |
    | The following English lines are used in Notification module related actions. These messages
    | that needed to display to the user.
    |
    */

    'menu'  => 'Notifications',
    'fields' => [
        'notification_en' => 'Notification Title',
        'notification_en_help' => 'Please, enter the notification title in provided language here',
        'type' => 'Notification Type',
        'type_help' => 'Please, enter the notification type here',
        'link' => 'Link',
        'module' => 'Module Type',
        'module_help' => 'Please, enter the module type here',
        'module_id' => 'Module Record Id',
        'module_id_help' => 'Please, enter the module record id here',
        'filter_type' => 'Filter Type',
        'filter_type_help' => 'Please, enter the filter type here',
        'active' => 'Is It Active?',
        'active_help' => 'Please, choose wither notification is active or not here',
        'subscription' => 'Subscriptions',
        'subscription_help' => 'Please, choose subscription from here',
        'country' => 'Country',
        'country_help' => 'Please, choose country from here',
        'users' => 'Users',
        'users_help' => 'Please, choose users from here',
        'cities' => 'Cities',
        'cities_help' => 'Please, choose cities from here',
        'general' => 'Is It General?',
        'general_help' => 'Please, choose wither notification is general or not here',
        'notified_users' => [
            'header'    => 'Notified Users',
            'title'     => 'User Name',
        ],
    ],
    'type' => [
        'red'    => 'sellers',
        'orange' => 'users',
        'brown'  => 'custom',
        'green'  => 'general',
        'teal'   => 'system',
    ],
    'types' => [
        'sellers'   => 'Store Owners',
        'users'     => 'Store Clients',
        'custom'    => 'Custom',
        'system'    => 'System'
    ],
    'filter_types' => [
        'users'         => 'Custom Users',
        'regions'       => 'Custom Region',
        'subscriptions' => 'Custom Subscriptions',
    ],
    'messages' => [
        'created'   => 'Notification has been created successfully.',
        'updated'   => 'Notification has been updated successfully.',
        'deleted'   => 'Requested notification has been deleted successfully.',
        'retrieved' => 'Requested notification/s has been retrieved successfully.',
        'not_found' => 'Requested notification is not found',
        'marked'    => 'Requested notification has been removed',
        'errors'    => [
            'created'   => 'Sorry notification can not be created, Please try Again!.',
        ]
    ],
];

return alterLangFiles('notifications', $array, $key = 'fields', 'en');
