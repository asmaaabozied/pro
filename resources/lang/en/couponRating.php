<?php
/**
 * Coupon Rating English Language Messages.
 *
 * @author Amk El-Kabbany at 27 May 2020
 * @contact alaa@upbeatdigital.teamm
 */
$array = [

    /*
    |--------------------------------------------------------------------------
    | Coupon Rating English Messages
    |--------------------------------------------------------------------------
    |
    | The following English lines are used in Coupon Rating module related actions. These messages
    | that needed to display to the user.
    |
    */
    'menu'  => 'Coupon Ratings & Reviews',
    'side-menu'  => 'Ratings & Reviews',
    'fields' => [
        'user_id' => 'User Name',
        'user_id_help' => 'Please, choose the user here',
        'coupon_id' => 'Coupon Name',
        'coupon_id_help' => 'Please, choose the coupon here',
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
        'liked_before'=> 'Coupon Rating has been Liked Before.',
        'disliked_before'=> 'Coupon Rating has been Disliked Before.',
        'rated_before'   => 'Coupon Rating has been Rated Before.',
        'created'   => 'Coupon Rating has been created successfully.',
        'updated'   => 'Coupon Rating has been updated successfully.',
        'deleted'   => 'Requested coupon rating has been deleted successfully.',
        'retrieved' => 'Requested coupon rating/s has been retrieved successfully.',
        'not_found' => 'Requested coupon rating is not found',
        'likes'     => 'Likes for requested coupon rating has been updated',
        'dislikes'  => 'Dislikes for requested coupon rating has been updated',
        'errors'    => [
            'created'   => 'Sorry coupon rating can not be created, Please try Again!.',
        ],
    ],
];

return alterLangFiles('coupon_ratings', $array, $key = 'fields', 'en');
