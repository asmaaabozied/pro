<?php
/**
 * Product Rating English Language Messages.
 *
 * @author Amk El-Kabbany at 27 May 2020
 * @contact alaa@upbeatdigital.teamm
 */
$array = [

    /*
    |--------------------------------------------------------------------------
    | Product Rating English Messages
    |--------------------------------------------------------------------------
    |
    | The following English lines are used in Product Rating module related actions. These messages
    | that needed to display to the user.
    |
    */
    'menu'  => 'Product Ratings & Reviews',
    'side-menu'  => 'Ratings & Reviews',
    'fields' => [
        'user_id' => 'User Name',
        'user_id_help' => 'Please, choose the user here',
        'product_id' => 'Product Name',
        'product_id_help' => 'Please, choose the product here',
        'rate' => 'Rate ',
        'rate_help' => 'Please, enter the rate here',
        'review' => 'Review ',
        'review_help' => 'Please, enter the review here',
        'likes' => [
            'header' => 'Rating Likes/Dislikes List ',
            'user'   => 'User Name',
            'like'   => 'Like/Dislike',
        ]
    ],
    'messages' => [
        'created'   => 'Product Rating has been created successfully.',
        'updated'   => 'Product Rating has been updated successfully.',
        'deleted'   => 'Requested product rating has been deleted successfully.',
        'retrieved' => 'Requested product rating/s has been retrieved successfully.',
        'not_found' => 'Requested product rating is not found',
        'likes'     => 'Likes for requested product rating has been updated',
        'dislikes'  => 'Dislikes for requested product rating has been updated',
        'errors'    => [
            'created'   => 'Sorry product rating can not be created, Please try Again!.',
        ],
    ],
];

return alterLangFiles('product_ratings', $array, $key = 'fields', 'en');
