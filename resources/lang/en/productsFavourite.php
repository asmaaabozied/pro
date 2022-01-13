<?php
/**
 * Product Favourite English Language Messages.
 *
 * @author Amk El-Kabbany at 27 May 2020
 * @contact alaa@upbeatdigital.teamm
 */
$array = [

    /*
    |--------------------------------------------------------------------------
    | Product Favourite English Messages
    |--------------------------------------------------------------------------
    |
    | The following English lines are used in Product Favourite module related actions. These messages
    | that needed to display to the user.
    |
    */
    'menu'  => 'Favourites List',
    'side-menu'  => 'Favourites List',
    'fields' => [
        'user_id' => 'User Name',
        'user_id_help' => 'Please, choose the user here',
        'product_id' => 'Product Name',
        'product_id_help' => 'Please, choose the product here',
        'rate_help' => 'Please, enter the user IP here',
    ],
    'messages' => [
        'created'   => 'Product Favourite has been created successfully.',
        'updated'   => 'Product Favourite has been updated successfully.',
        'deleted'   => 'Requested product favourite has been deleted successfully.',
        'retrieved' => 'Requested product favourite/s has been retrieved successfully.',
        'favourite' => 'Requested product has been added to favourites successfully.',
        'not_found' => 'Requested product favourite is not found',
        'un-favourite' => 'Requested product has been removed from favourites successfully.',
        'errors'    => [
            'created'   => 'Sorry product favourite can not be created, Please try Again!.',
        ],
    ],
];

return alterLangFiles('product_favourites', $array, $key = 'fields', 'en');
