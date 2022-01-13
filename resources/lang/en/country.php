<?php
/**
 * Country English Language Messages.
 *
 * @author Amk El-Kabbany at 4 May 2020
 * @contact alaa@upbeatdigital.team
 */
$array = [

    /*
    |--------------------------------------------------------------------------
    | Country English Messages
    |--------------------------------------------------------------------------
    |
    | The following English lines are used in Country module related actions. These messages
    | that needed to display to the user.
    |
    */

    'main_menu'  => 'Geography',
    'menu'  => 'Countries',
    'fields' => [
        'name_en' => 'Country Name',
        'name_en_help' => 'Please, enter the country name in provided language here',
        'key' => 'Country Key',
        'key_help' => 'Please, enter the country phone key here',
        'code' => 'Country Code',
        'code_help' => 'Please, enter the country code here',
        'shipping_cost' => 'Country Shipping Cost',
        'shipping_cost_help' => 'Please, enter the country shipping cost here',
        'active' => 'Is It Active?',
        'active_help' => 'Please, choose wither country is active or not here',
        'assigned_cities' => 'Cities Belong To This Country',
        'delivery_for_5k' => 'Delivery Amount for first 5 Kilos',
        'delivery_for_5k_help' => 'Please, enter delivery amount for first 5 Kilos',
        'additional_k' => 'Delivery Amount for additional Kilos',
        'additional_k_help' => 'Please, enter delivery amount for additional Kilos'
    ],
    'messages' => [
        'created'   => 'Country has been created successfully.',
        'updated'   => 'Country has been updated successfully.',
        'deleted'   => 'Requested country has been deleted successfully.',
        'retrieved' => 'Requested country/ies has been retrieved successfully.',
        'not_found' => 'Requested country is not found',
        'country_city_assigned' => 'This country assigned to cities already. Please remove them first',
        'errors'    => [
            'created'   => 'Sorry country can not be created, Please try Again!.',
        ],
    ],
];

return alterLangFiles('countries', $array, $key = 'fields', 'en');
