<?php
/**
 * Module Permissions array.
 *
 * @author Amk El-Kabbany at 2 May 2020
 * @contact alaa@upbeatdigital.team
 */
$array = [

    /*
    |--------------------------------------------------------------------------
    | Module Permissions Array
    |--------------------------------------------------------------------------
    |
    | The following lines are used seeding modules permissions in the DB.
    |
    */
    'name' => [
        'roles',
        'permissions',
        'languages',
        'countries',
        'cities',
        'categories',
        'categoryAttributes',
        'brands',
        'users',
        'storeTypes',
        'stores',
        'storeRatings',
        'sliders',
        'subscriptions',
        'storeSubscriptions',
        'products',
        'productRatings',
        'productsFavourites',
        'aboutuses',
        'supportTickets',
        'coupons',
        'socialMediaLinks',
        'notifications',
        'carts',
        'addresses',
        'orders',
        'orderActionsReasons',
        'orderActions',
        'coupons',
    ],
    'permissions' => [
        'list',
        'create',
        'edit',
        'delete',
    ],
];

return $array;
