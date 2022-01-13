<?php
/**
 * Support Ticket English Language Messages.
 *
 * @author Amk El-Kabbany at 8 June 2020
 * @contact alaa@upbeatdigital.teamm
 */
return [

    /*
    |--------------------------------------------------------------------------
    | Support Ticket English Messages
    |--------------------------------------------------------------------------
    |
    | The following English lines are used in Support Ticket module related actions. These messages
    | that needed to display to the user.
    |
    */
    'menu'  => 'Contact Us Messages',
    'fields' => [
        'name' => 'Full Name',
        'name_help' => 'Please, enter the user full name here',
        'type' => 'Message Type',
        'type_help' => 'Please, choose the message type here',
        'message' => 'Message',
        'message_help' => 'Please, choose the message here',
        'email' => 'Email',
        'email_help' => 'Please, enter the email here',
        'phone' => 'Phone',
        'phone_help' => 'Please, enter the user phone here',
        'address' => 'Address',
        'address_help' => 'Please, enter the user address here',
        'country_id' => 'Country',
        'country_id_help' => 'Please, choose the user country here',
        'city_id' => 'City',
        'city_id_help' => 'Please, choose the user city here',
        'responded' => 'Has Been Responded?',
        'responded_help' => 'Please, choose wither user is responded or not here',
    ],
    'messages' => [
        'created'   => 'Support Ticket has been created successfully.',
        'updated'   => 'Support Ticket has been updated successfully.',
        'deleted'   => 'Requested support ticket has been deleted successfully.',
        'retrieved' => 'Requested support ticket/s has been retrieved successfully.',
        'not_found' => 'Requested support ticket is not found',
        'errors'    => [
            'created'   => 'Sorry support ticket can not be created, Please try Again!.',
            'type'      => 'Sorry requested support ticket is not valid, Please try Again!.',
        ],
    ],
    'types' => [
        'green'     => 'message',
        'orange'    => 'suggestion',
        'red'       => 'complain',
    ],
    'types_api' => [
        2 => 'message',
        1 => 'suggestion',
        0 => 'complain',
    ]
];