<?php
/**
 * Slider English Language Messages.
 *
 * @author Amk El-Kabbany at 28 Apr 2020
 * @contact alaa@upbeatdigital.team
 */
$array = [

    /*
    |--------------------------------------------------------------------------
    | Slider English Messages
    |--------------------------------------------------------------------------
    |
    | The following English lines are used in Slider module related actions. These messages
    | that needed to display to the user.
    |
    */

    'menu'  => 'Slider',
    'fields' => [
        'title_en' => 'Slider Title',
        'title_en_help' => 'Please, enter the slider title in provided language here',
        'description_en' => 'Slider Description',
        'description_en_help' => 'Please, enter the slider description in provided language here',
        'link' => 'Slider Full URL',
        'link_help' => 'Please, enter the slider full URL here',
        'product_id' => 'Slider Product',
        'product_id_help' => 'Please, enter the slider Product',
        'image' => 'Slider Image',
        'image_help' => 'Please, choose this slider valid image here',
        'active' => 'Is It Active?',
        'active_help' => 'Please, choose wither slider is active or not here',
    ],
    'messages' => [
        'created'   => 'Slider has been created successfully.',
        'updated'   => 'Slider has been updated successfully.',
        'deleted'   => 'Requested slider has been deleted successfully.',
        'retrieved' => 'Requested slider/s has been retrieved successfully.',
        'not_found' => 'Requested slider is not found',
        'errors'    => [
            'created'   => 'Sorry slider can not be created, Please try Again!.',
            ]
    ],
];

return alterLangFiles('sliders', $array, $key = 'fields', 'en');
