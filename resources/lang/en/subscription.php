<?php
/**
 * Subscription English Language Messages.
 *
 * @author Amk El-Kabbany at 12 May 2020
 * @contact alaa@upbeatdigital.team
 */
$array = [

    /*
    |--------------------------------------------------------------------------
    | Subscription English Messages
    |--------------------------------------------------------------------------
    |
    | The following English lines are used in Subscription module related actions. These messages
    | that needed to display to the user.
    |
    */
    'menu'  => 'Subscriptions',
    'manage'  => 'Manage Subscriptions',
    'menuView'  => 'Subscriptions View',
    'fields' => [
        'title_en' => 'Subscription Title',
        'title_en_help' => 'Please, enter the subscription title in provided language here',
        'description_en' => 'Subscription Description',
        'description_en_help' => 'Please, enter the subscription description in provided language here',
        'price' => 'Subscription Price',
        'price_help' => 'Please, enter the subscription price here',
        'duration' => 'Duration (in month)',
        'duration_help' => 'Please, enter the subscription Duration here',
        'max_product' => 'Max Product Number',
        'max_product_help' => 'Please, enter the Max Product Number user can Add here',

        'active' => 'Is It Active?',
        'active_help' => 'Please, choose wither subscription is active or not here',
    ],
    'messages' => [
        'created'   => 'Subscription has been created successfully.',
        'updated'   => 'Subscription has been updated successfully.',
        'deleted'   => 'Requested subscription has been deleted successfully.',
        'retrieved' => 'Requested subscription/s has been retrieved successfully.',
        'not_found' => 'Requested subscription is not found',
        'errors'    => [
            'created'   => 'Sorry subscription can not be created, Please try Again!.',
        ],
    ],
];

return alterLangFiles('subscriptions', $array, $key = 'fields', 'en');
