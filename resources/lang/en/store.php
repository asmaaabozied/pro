<?php
/**
 * Store English Language Messages.
 *
 * @author Amk El-Kabbany at 7 May 2020
 * @contact alaa@upbeatdigital.teamm
 */
$array = [

    /*
    |--------------------------------------------------------------------------
    | Store English Messages
    |--------------------------------------------------------------------------
    |
    | The following English lines are used in Store module related actions. These messages
    | that needed to display to the user.
    |
    */
    'menu'  => 'Stores',
    'fields' => [
        'name_en' => 'Store Name',
        'name_en_help' => 'Please, enter the store name here',
        'description_en' => 'Store Description',
        'description_en_help' => 'Please, enter the store description here',
        'phone' => 'Store Contact Phone',
        'lat' => 'Store latitude',
        'long' => 'Store longitude',

        'phone_help' => 'Please, enter the store contact phone here',
        'lat_help' => 'Please, enter the store latitude here',
        'long_help' => 'Please, enter the store longitude here',
        'store_type' => 'Store Type',
        'store_type_help' => 'Please, choose the store type here',
        'owner_id' => 'Store Owner',
        'owner_id_help' => 'Please, choose the store owner here',
        'status' => 'Store Status',
        'status_help' => 'Please, choose the store status here',
        'image' => 'Store Image',
        'image_help' => 'Please, choose store valid image here',
        'activated' => 'Is It Activated?',
        'activated_help' => 'Please, choose wither this store is activated or not here',
        'terms_and_policy'  => [
            'header' => 'Store Terms And Policy Paragraphs',
            'title_en' => 'Paragraph Title',
            'title_en_help' => 'Please, enter the paragraph title here',
            'description_en' => 'Paragraph Description',
            'description_en_help' => 'Please, enter the paragraph description here',
            'active' => 'Is It Active?',
            'activated_help' => 'Please, choose wither this paragraph is active or not here',
        ]
    ],
    'messages' => [
        'created'   => 'Store has been created successfully.',
        'updated'   => 'Store has been updated successfully.',
        'deleted'   => 'Requested store has been deleted successfully.',
        'retrieved' => 'Requested store/s has been retrieved successfully.',
        'not_found' => 'Requested store is not found',
        'errors'    => [
            'created'   => 'Sorry store can not be created, Please try Again!.',
        ],
    ],
    'store_status' => [
        'green'     => 'activated',
        'gray'      => 'deleted',
        'red'       => 'suspended',
        'orange'    => 'pending',
    ]
];

$array = alterLangFiles('stores', $array, $key = 'fields', 'en');
$array['fields'] = alterLangFiles('store_terms_policy', $array['fields'], $key = 'terms_and_policy', 'en');
return $array;
