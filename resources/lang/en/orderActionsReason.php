<?php
/**
 * Order Actions Reason English Language Messages.
 *
 * @author Amk El-Kabbany at 14 July 2020
 * @contact alaa@upbeatdigital.team
 */
$array = [

    /*
    |--------------------------------------------------------------------------
    | Order Actions Reason English Messages
    |--------------------------------------------------------------------------
    |
    | The following English lines are used in Order Actions Reason module related actions. These messages
    | that needed to display to the user.
    |
    */

    'menu'  => 'Order Action Reasons',
    'fields' => [
        'type' => 'Order Action Types',
        'type_help' => 'Please, enter the order action types in provided language here',
        'title_en' => 'Order Actions Reason',
        'title_en_help' => 'Please, enter the order actions reason title in provided language here',
        'active' => 'Is It Active?',
        'active_help' => 'Please, choose wither order actions reason is active or not here',
    ],
    
    'messages' => [
        'created'   => 'Order Actions Reason has been created successfully.',
        'updated'   => 'Order Actions Reason has been updated successfully.',
        'deleted'   => 'Requested order actions reason has been deleted successfully.',
        'retrieved' => 'Requested order actions reason/s has been retrieved successfully.',
        'not_found' => 'Requested order actions reason is not found',
        'errors'    => [
            'created'   => 'Sorry order actions reason can not be created, Please try Again!.',
        ],
    ],

    'types' => [
        'orange'    => 'cancel',
        'teal'      => 'return',
        'red'       => 'reject',
        'brown'     => 'report',
    ]
];

return alterLangFiles('order_actions_reasons', $array, $key = 'fields', 'en');
