<?php
/**
 * Category Attribute English Language Messages.
 *
 * @author Amk El-Kabbany at 12 May 2020
 * @contact alaa@upbeatdigital.team
 */
$array = [

    /*
    |--------------------------------------------------------------------------
    | Category Attribute English Messages
    |--------------------------------------------------------------------------
    |
    | The following English lines are used in Category Attribute module related actions. These messages
    | that needed to display to the user.
    |
    */

    'menu'  => 'Category Attributes',
    'fields' => [
        'name_en' => 'Attribute Name',
        'name_en_help' => 'Please, enter the category attribute name in provided language here',
        'unit_en' => 'Attribute Unit',
        'unit_en_help' => 'Please, enter the category attribute unit in provided language here',
        'category_id' => 'Category',
        'category_id_help' => 'Please, choose wither this attribute category from here',
        'description_en' => 'Category Attribute Description',
        'description_en_help' => 'Please, enter the category attribute description in provided language here',
        'active' => 'Is It Active?',
        'active_help' => 'Please, choose wither category attribute is active or not here',
    ],
    'messages' => [
        'created'   => 'Category Attribute has been created successfully.',
        'updated'   => 'Category Attribute has been updated successfully.',
        'deleted'   => 'Requested category attribute has been deleted successfully.',
        'retrieved' => 'Requested category attribute/s has been retrieved successfully.',
        'not_found' => 'Requested category attribute is not found',
        'errors'    => [
            'created'   => 'Sorry category can not be created, Please try Again!.',
        ],
    ],
];

return alterLangFiles('category_attributes', $array, $key = 'fields', 'en');
