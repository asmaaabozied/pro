<?php
/**
 * Address English Language Messages.
 *
 * @author Amk El-Kabbany at 9 July 2020
 * @contact alaa@upbeatdigital.team
 */
$array = [

    /*
    |--------------------------------------------------------------------------
    | Address English Messages
    |--------------------------------------------------------------------------
    |
    | The following English lines are used in Address module related actions. These messages
    | that needed to display to the user.
    |
    */

    'menu'  => 'Addresses',
    'fields' => [
        'name' => 'Address Name',
        'name_help' => 'Please, enter the address name here',
        'mobile' => 'Mobile (Without Country Key)',
        'mobile_help' => 'Please, enter the user mobile here',
        'user_id' => 'User Name',
        'user_id_help' => 'Please, choose which user this address belongs to from here',
        'country_id' => 'Country Name',
        'country_id_help' => 'Please, choose which country this address belongs to from here',
        'city_id' => 'City Name',
        'city_id_help' => 'Please, choose which city this address belongs to from here',
        'address' => 'Address',
        'address_help' => 'Please, enter the address here',
        'main' => 'Is It Main?',
        'main_help' => 'Please, choose wither address is main or not here',
    ],
    'messages' => [
        'created'   => 'Address has been created successfully.',
        'updated'   => 'Address has been updated successfully.',
        'deleted'   => 'Requested address has been deleted successfully.',
        'retrieved' => 'Requested address/ies has been retrieved successfully.',
        'not_found' => 'Requested address is not found',
        'errors'    => [
            'created'   => 'Sorry address can not be created, Please try Again!.',
            'main'      => 'Sorry address can not be deleted, cause it\'s main address!.',
        ],
    ],
];

return alterLangFiles('addresses', $array, $key = 'fields', 'en');
