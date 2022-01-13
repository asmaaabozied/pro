<?php
/**
 * About Us English Language Messages.
 *
 * @author Amk El-Kabbany at 3 June 2020
 * @contact alaa@upbeatdigital.teamm
 */
$array = [

    /*
    |--------------------------------------------------------------------------
    | About Us English Messages
    |--------------------------------------------------------------------------
    |
    | The following English lines are used in About Us module related actions. These messages
    | that needed to display to the user.
    |
    */
    'about-us'  => 'About Us',
    'terms-and-conditions'  => 'Terms & Conditions',
    'privacy-and-policy'  => 'Privacy & Policy',
    'table'  => 'Registered Paragraphs',
    'fields' => [
        'title_en' => 'Paragraph Title',
        'title_en_help' => 'Please, enter the paragraph title here',
        'description_en' => 'Paragraph Description',
        'description_en_help' => 'Please, enter the paragraph description here',
        'image' => 'Image',
        'image_help' => 'Please, choose this valid image here',
        'active' => 'Is It Available?',
        'active_help' => 'Please, choose wither this paragraph is available or not here',
    ],
    'messages' => [
        'created'   => 'Record has been created successfully.',
        'updated'   => 'Record has been updated successfully.',
        'deleted'   => 'Requested record has been deleted successfully.',
        'retrieved' => 'Requested record/s has been retrieved successfully.',
        'not_found' => 'Requested record is not found',
        'errors'    => [
            'created'           => 'Sorry record can not be created, Please try Again!.',
            'can_not_deleted'   => 'Sorry this record can not be deleted.',
        ],
    ],
];

return alterLangFiles('aboutuses', $array, $key = 'fields', 'en');
