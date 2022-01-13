<?php
/**
 * Social Media Link English Language Messages.
 *
 * @author Amk El-Kabbany at 8 June 2020
 * @contact alaa@upbeatdigital.teamm
 */
$array = [

    /*
    |--------------------------------------------------------------------------
    | Social Media Link English Messages
    |--------------------------------------------------------------------------
    |
    | The following English lines are used in Social Media Link module related actions. These messages
    | that needed to display to the user.
    |
    */
    'menu'  => 'Social Media Links',
    'seed'  => 'Seed Database',
    'fields' => [
        'more_icons' => 'For More Icons Click Here',
        'more_colors' => 'For More Colors Click Here',
        'title_en' => 'Social Media Link Title',
        'title_en_help' => 'Please, enter the social media link title here',
        'link' => 'Social Media Link',
        'link_help' => 'Please, enter the social media link here',
        'icon' => 'Social Media Link Icon',
        'icon_help' => 'Please, enter the social media link icon here',
        'background_color' => 'Icon Background Color',
        'background_color_help' => 'Please, enter the icon background color here',
        'class' => 'Social Media Link class',
        'class_help' => 'Please, enter the social media link class here',
        'description_en' => 'Social Media Link Description',
        'description_en_help' => 'Please, enter the social media link description here',
        'active' => 'Is It Available?',
        'active_help' => 'Please, choose wither this social media link is available or not here',
    ],
    'messages' => [
        'created'   => 'Social Media Link has been created successfully.',
        'updated'   => 'Social Media Link has been updated successfully.',
        'deleted'   => 'Requested social media link has been deleted successfully.',
        'retrieved' => 'Requested social media link/s has been retrieved successfully.',
        'not_found' => 'Requested social media link is not found',
        'errors'    => [
            'created'   => 'Sorry social media link can not be created, Please try Again!.',
        ],
    ],
];

return alterLangFiles('social_media_links', $array, $key = 'fields', 'en');
