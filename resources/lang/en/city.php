<?php
/**
 * City English Language Messages.
 *
 * @author Amk El-Kabbany at 4 May 2020
 * @contact alaa@upbeatdigital.team
 */
$array = [

    /*
    |--------------------------------------------------------------------------
    | City English Messages
    |--------------------------------------------------------------------------
    |
    | The following English lines are used in City module related actions. These messages
    | that needed to display to the user.
    |
    */

    'menu'  => 'Cities',
    'all'   => 'All Cities',
    'fields' => [
        'name_en' => 'City Name',
        'name_en_help' => 'Please, enter the city name in provided language here',
        'country_id' => 'Country Name',
        'country_id_help' => 'Please, choose which country this city belongs to from here',
        'postal_code' => 'City Postal Code',
        'postal_code_help' => 'Please, enter the city postal code here',
        'active' => 'Is It Active?',
        'active_help' => 'Please, choose wither city is active or not here',
    ],
    'messages' => [
        'created'   => 'City has been created successfully.',
        'updated'   => 'City has been updated successfully.',
        'deleted'   => 'city has been deleted successfully.',
        'retrieved' => 'Requested city/ies has been retrieved successfully.',
        'not_found' => 'Requested city is not found',
        'errors'    => [
            'created'   => 'Sorry city can not be created, Please try Again!.',
        ],
    ],
];

return alterLangFiles('cities', $array, $key = 'fields', 'en');
