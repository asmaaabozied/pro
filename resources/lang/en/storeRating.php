<?php
/**
 * Store Rating English Language Messages.
 *
 * @author Amk El-Kabbany at 7 May 2020
 * @contact alaa@upbeatdigital.teamm
 */
$array = [

    /*
    |--------------------------------------------------------------------------
    | Store Rating English Messages
    |--------------------------------------------------------------------------
    |
    | The following English lines are used in Store Rating module related actions. These messages
    | that needed to display to the user.
    |
    */
    'menu'  => 'Store Ratings & Reviews',
    'side-menu'  => 'Ratings & Reviews',
    'fields' => [
        'user_id' => 'User Name',
        'user_id_help' => 'Please, choose the user here',
        'store_id' => 'Store Name',
        'store_id_help' => 'Please, choose the store here',
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
        'created'   => 'Store Rating has been created successfully.',
        'updated'   => 'Store Rating has been updated successfully.',
        'deleted'   => 'Requested store rating has been deleted successfully.',
        'retrieved' => 'Requested store rating/s has been retrieved successfully.',
        'not_found' => 'Requested store rating is not found',
        'likes'     => 'Likes for requested product rating has been updated',
        'dislikes'  => 'Dislikes for requested product rating has been updated',
        'errors'    => [
            'created'   => 'Sorry store rating can not be created, Please try Again!.',
        ],
    ],
];

return alterLangFiles('store_ratings', $array, $key = 'fields', 'en');
