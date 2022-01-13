<?php
/**
 * Category English Language Messages.
 *
 * @author Amk El-Kabbany at 28 Apr 2020
 * @contact alaa@upbeatdigital.team
 */
$array = [

    /*
    |--------------------------------------------------------------------------
    | Category English Messages
    |--------------------------------------------------------------------------
    |
    | The following English lines are used in Category module related actions. These messages
    | that needed to display to the user.
    |
    */

    'menu'  => 'Categories',
    'seed'  => 'Seed Database',
    'fields' => [
        'brands' => 'This Category\'s Brands',
        'brands_title' => 'Brand Title',
        'sub_categories' => 'This Category\'s Sub-Categories',
        'sub_categories_title' => 'Sub-Categories Title',
        'title_en' => 'Category Title',
        'title_en_help' => 'Please, enter the category title in provided language here',
        'parent' => 'Parent Category',
        'parent_help' => 'Please, choose wither this category is belongs to another one or not from here',
        'image' => 'Category Image',
        'image_help' => 'Please, choose this category valid image here',
        'icon' => 'Category Icon',
        'icon_help' => 'Please, choose this category valid icon here',
        'active' => 'Is It Active?',
        'active_help' => 'Please, choose wither category is active or not here',
        'menu' => 'Menu-Bar Item?',
        'menu_help' => 'Please, choose wither category is it menu bar item or not here',
        'order' => 'Menu Order?',
        'order_help' => 'Please, choose category menu bar item order here',
    ],
    'messages' => [
        'created'   => 'Category has been created successfully.',
        'updated'   => 'Category has been updated successfully.',
        'deleted'   => 'Requested category has been deleted successfully.',
        'retrieved' => 'Requested category/ies has been retrieved successfully.',
        'not_found' => 'Requested category is not found',
        'menu_item' => 'This category is a menu item, can not be deleted',
        'category_subcategory_assigned' => 'This category contains subcategory already. Please remove them first',
        'category_brands_assigned' => 'This category contains brands already. Please remove them first',
        'errors'    => [
            'created'   => 'Sorry category can not be created, Please try Again!.',
        ],
    ],
];

return alterLangFiles('categories', $array, $key = 'fields', 'en');
