<?php
/**
 * Order English Language Messages.
 *
 * @author Amk El-Kabbany at 12 July 2020
 * @contact alaa@upbeatdigital.teamm
 */
$array = [

    /*
    |--------------------------------------------------------------------------
    | Order English Messages
    |--------------------------------------------------------------------------
    |
    | The following English lines are used in Order module related actions. These messages
    | that needed to display to the user.
    |
    */
    'menu'  => 'Reports',
    'fields' => [
        'user_id' => 'Order Owner',
        'status' => 'Order Status',
        'cart_total' => 'Cart Total',
        'total' => 'Order Total',
        'payment_type' => 'Payment Type',
        'status_help' => 'Please, choose the Order status here',
        'address' => 'Shipped Address Information',
        'payment' => 'Payment Information',
        'discount' => 'Discount Value',
        'shipping_cost' => 'Shipping Cost',
        'coupon' => 'Promo Coupon',
        'id' => 'Order Number',
        'created_at' => 'Created At',
        'checked_out' => 'Checked Out At',
        'order_id'    => 'Order number',
        'reason_id'   => 'Reason Type',
        'items' => [
            'header' => 'This Order Items',
            'product_id' => 'Product',
            'product_id_help' => 'Please, choose the product here',
            'quantity' => 'Quantity',
            'quantity_help' => 'Please, enter the product quantity here',
            'price' => 'Product Price',
            'price_help' => 'Please, enter the product price here',
            'total' => 'Total Order Items Price',
        ],

    ],
    'messages' => [
        'created'   => 'Order has been created successfully.',
        'updated'   => 'Order has been updated successfully.',
        'deleted'   => 'Requested order has been deleted successfully.',
        'retrieved' => 'Requested order/s has been retrieved successfully.',
        'not_found' => 'Requested order is not found',
        'canceled'  => 'Requested order canceled successfully',
        'returned'  => 'Requested order return request has been sent successfully, Waiting for store admin to approve',
        'report'    => 'Requested product has been reported successfully',
        'errors'    => [
            'created'           => 'Sorry order can not be created, Please try Again!.',
            'delete'            => 'Sorry selected record can not be deleted, Please try Again!.',
            'quantity'          => 'Sorry selected product does not have required quantity in the stock, Please try again later!.',
            'canceled'          => 'Sorry selected order can not be cancelled!.',
            'report'            => 'Sorry selected order can not be cancelled!.',
            'not_super_admin'   => 'Sorry you don\'t have this permission.',
        ],
    ],
    'order_status' => [
        'brown'     => 'preparing',
        'orange'    => 'prepared',
        'teal'      => 'on way',
        'green'     => 'delivered',
        'red'       => 'rejected',
        'grey'      => 'cancelled',
        'maroon'    => 'returned',
    ],
    'order_status_group' => [
        'current'   => [
            'brown'     => 'preparing',
            'orange'    => 'prepared',
            'teal'      => 'on way',
        ],
        'previous'  => [
            'green'     => 'delivered',
            'red'       => 'rejected',
            'grey'      => 'cancelled',
            'maroon'    => 'returned',
        ],
        'cancel'  => [
            'brown'     => 'preparing',
            'orange'    => 'prepared',
        ]
    ]
];

return alterLangFiles('orders', $array, $key = 'fields', 'en');
