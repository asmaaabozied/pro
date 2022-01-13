<?php
/**
 * Store Types English Language Messages.
 *
 * @author Amk El-Kabbany at 7 May 2020
 * @contact alaa@upbeatdigital.teamm
 */
$array = [

    /*
    |--------------------------------------------------------------------------
    | Store Types English Messages
    |--------------------------------------------------------------------------
    |
    | The following English lines are used in Store Types module related actions. These messages
    | that needed to display to the user.
    |
    */
    'menu'  => 'Store Types',
    'fields' => [
        'type_en' => 'Store Type Name',
        'type_en_help' => 'Please, enter the store type name here',
        'active' => 'Is It Active?',
        'active_help' => 'Please, choose wither this store type is active or not here',
        'stores'=>'Stores'

    ],
    'messages' => [
        'created'   => 'Store Type has been created successfully.',
        'updated'   => 'Store Type has been updated successfully.',
        'deleted'   => 'Requested store type has been deleted successfully.',
        'retrieved' => 'Requested store type/s has been retrieved successfully.',
        'not_found' => 'Requested store type is not found',
        'errors'    => [
            'created'   => 'Sorry store type can not be created, Please try Again!.',
        ],
    ],
    'store_status' => [
        'green'     => 'activated',
        'gray'      => 'deleted',
        'red'       => 'suspended',
        'orange'    => 'pending',
    ]
];

return alterLangFiles('store_types', $array, $key = 'fields', 'en');
