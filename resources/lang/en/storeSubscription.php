<?php
/**
 * Store Subscription English Language Messages.
 *
 * @author Amk El-Kabbany at 12 May 2020
 * @contact alaa@upbeatdigital.team
 */
$array = [

    /*
    |--------------------------------------------------------------------------
    | Store Subscription English Messages
    |--------------------------------------------------------------------------
    |
    | The following English lines are used in Store Subscription module related actions. These messages
    | that needed to display to the user.
    |
    */

    'menu'  => 'Stores Subscription',
    'fields' => [
        'store_id' => 'Stores',
        'store_id_help' => 'Please, choose the store here',
        'subscription_id' => 'Subscriptions',
        'subscription_id_help' => 'Please, choose the subscription here',
        'actual_price' => 'Subscription Actual Price',
        'actual_price_help' => 'Please, enter the store subscription actual price here',
        'price' => 'Store Subscription Price',
        'price_help' => 'Please, enter the store subscription price here',
        'duration' => 'Duration (in month)',
        'duration_help' => 'Please, enter the store subscription duration here',
        'subscribe_date' => 'Subscribe Date',
        'expire_date' => 'Expire Date',
        'expire_date_help' => 'Please, enter the subscription expire date here',
        'active' => 'Is It Active?',
        'active_help' => 'Please, choose wither store subscription is active or not here',
    ],
    'messages' => [
        'created'   => 'Store Subscription has been created successfully.',
        'updated'   => 'Store Subscription has been updated successfully.',
        'deleted'   => 'Requested store subscription has been deleted successfully.',
        'retrieved' => 'Requested store subscription/s has been retrieved successfully.',
        'not_found' => 'Requested store subscription is not found',
        'errors'    => [
            'created'   => 'Sorry store subscription can not be created, Please try Again!.',
        ],
    ],
];

return alterLangFiles('store_subscriptions', $array, $key = 'fields', 'en');
