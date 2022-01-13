<?php
/**
 * Voucher English Language Messages.
 *
 * @author Amk El-Kabbany at 28 May 2020
 * @contact alaa@upbeatdigital.teamm
 */
$array = [

    /*
    |--------------------------------------------------------------------------
    | Voucher English Messages
    |--------------------------------------------------------------------------
    |
    | The following English lines are used in Voucher module related actions. These messages
    | that needed to display to the user.
    |
    */
    'menu'  => 'Vouchers',
    'fields' => [
        'title_en' => 'Voucher Title',
        'title_en_help' => 'Please, enter the voucher title here',
        'description_en' => 'Voucher Description',
        'description_en_help' => 'Please, enter the voucher description here',
        'type' => 'Voucher Type',
        'type_help' => 'Please, choose the voucher type here',
        'code' => 'Voucher Code',
        'code_help' => 'Please, enter the voucher code here',
        'count' => 'Valid Count Of Use',
        'count_help' => 'Please, enter the voucher valid count of use here',
        'usage' => 'Usage Count',
        'usage_help' => 'Please, enter the voucher already usage count here',
        'rate' => 'Discount Rate (%)',
        'rate_help' => 'Please, enter the voucher rate here',
        'start_date' => 'Voucher Start Date',
        'start_date_help' => 'Please, enter voucher start date here',
        'end_date' => 'Voucher End Date',
        'end_date_help' => 'Please, enter voucher end date here',
        'active' => 'Is It Available?',
        'active_help' => 'Please, choose wither this product is available or not here',
    ],
    'type' => [
        'orange' => 'Orders',
        'teal'   => 'Vouchers',
    ],
    'messages' => [
        'created'   => 'Voucher has been created successfully.',
        'updated'   => 'Voucher has been updated successfully.',
        'deleted'   => 'Requested voucher has been deleted successfully.',
        'retrieved' => 'Requested voucher/s has been retrieved successfully.',
        'not_found' => 'Requested voucher is not found',
        'not_valid' => 'Requested voucher is not valid, or you may been used it before',
        'valid'     => 'Requested voucher is valid to use, enjoy!',
        'errors'    => [
            'created'   => 'Sorry voucher can not be created, Please try Again!.',
        ],
    ],
];

return alterLangFiles('vouchers', $array, $key = 'fields', 'en');
