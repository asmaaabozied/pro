<?php
/**
 * Brand English Language Messages.
 *
 * @author Amk El-Kabbany at 30 Apr 2020
 * @contact alaa@upbeatdigital.team
 */
$array = [

    /*
    |--------------------------------------------------------------------------
    | Brand English Messages
    |--------------------------------------------------------------------------
    |
    | The following English lines are used in Brand module related actions. These messages
    | that needed to display to the user.
    |
    */

    'menu'  => 'Brands',
    'fields' => [
        'category_id' => 'Category',
        'category_id_help' => 'Please, choose which category this brand belongs to from here',
        'title_en' => 'Brand Title',
        'title_en_help' => 'Please, enter the brand title in provided language here',
        'description_en' => 'Brand Description',
        'description_en_help' => 'Please, enter the brand description in provided language here',
        'image' => 'Brand Image',
        'image_help' => 'Please, choose this brand valid image here',
        'active' => 'Is It Active?',
        'active_help' => 'Please, choose wither brand is active or not here',
    ],
    
    'messages' => [
        'created'   => 'Brand has been created successfully.',
        'updated'   => 'Brand has been updated successfully.',
        'deleted'   => 'Requested brand has been deleted successfully.',
        'retrieved' => 'Requested brand/s has been retrieved successfully.',
        'not_found' => 'Requested brand is not found',
        'errors'    => [
            'created'   => 'Sorry brand can not be created, Please try Again!.',
        ],
    ],
];

return alterLangFiles('brands', $array, $key = 'fields', 'en');
