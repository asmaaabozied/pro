<?php
/**
 * Cart English Language Messages.
 *
 * @author Amk El-Kabbany at 31 May 2020
 * @contact alaa@upbeatdigital.teamm
 */
$array = [

    /*
    |--------------------------------------------------------------------------
    | Cart English Messages
    |--------------------------------------------------------------------------
    |
    | The following English lines are used in Cart module related actions. These messages
    | that needed to display to the user.
    |
    */
    'menu'  => 'Active Carts',
    'fields' => [
        'user_id' => 'Cart Owner',
        'user_id_help' => 'Please, choose the Cart owner here',
        'status' => 'Status',
        'status_help' => 'Please, choose the Cart status here',
        'discount' => 'Discount Type',
        'discount_help' => 'Please, choose the discount type here',
        'coupon' => 'Promo Coupons',
        'coupons' => 'Available Promo Coupons',
        'coupons_help' => 'Please, choose the available promo coupons here',
        'id' => 'Cart Total Items',
        'created_at' => 'Created At',
        'checked_out' => 'Checked Out At',
        'items' => [
            'header' => 'This Cart Items',
            'product_id' => 'Product',
            'product_id_help' => 'Please, choose the product here',
            'quantity' => 'Quantity',
            'quantity_help' => 'Please, enter the product quantity here',
            'price' => 'Product Price',
            'price_help' => 'Please, enter the product price here',
            'total' => 'Total Cart Items Price',
        ],

    ],
    'messages' => [
        'created'   => 'Cart has been created successfully.',
        'updated'   => 'Cart has been updated successfully.',
        'deleted'   => 'Requested cart has been deleted successfully.',
        'retrieved' => 'Requested cart/s has been retrieved successfully.',
        'not_found' => 'Requested cart is not found',
        'errors'    => [
            'created'           => 'Sorry cart can not be created, Please try Again!.',
            'delete'            => 'Sorry selected record can not be deleted, Please try Again!.',
            'quantity'          => 'Sorry selected product does not have required quantity in the stock, Please try again later!.',
            'empty'             => 'Sorry user\'s cart is empty!.',
            'not_super_admin'   => 'Sorry you don\'t have this permission.',
        ],
        'items'     => [
            'created'   => 'Cart Item has been added successfully.',
            'not_found' => 'Requested cart item is not found',
            'deleted'   => 'Requested cart item has been deleted successfully.',
        ],
    ],
    'cart_status' => [
        'green'     => 'checked out',
        'orange'    => 'open',
    ]
];

return alterLangFiles('carts', $array, $key = 'fields', 'en');
