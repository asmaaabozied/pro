<?php
/**
 * User English Language Messages.
 *
 * @author Amk El-Kabbany at 27 Apr 2020
 * @contact alaa@upbeatdigital.teamm
 */
return [

    /*
    |--------------------------------------------------------------------------
    | User English Messages
    |--------------------------------------------------------------------------
    |
    | The following English lines are used in User module related actions. These messages
    | that needed to display to the user.
    |
    */
    'menu'  => [
        'main' => 'Users',
        'users' => 'All Users',
        'admin' => 'Admin Users',
        'store_owner' => 'Stores Owner\'s Users',
        'client' => 'Stores Client\'s Users',
        'usersReferral' => 'Users Referral',
    ],
    'fields' => [
        'roles_and_permissions' => 'Assign New Roles And Permissions For This User',
        'assigned_permissions' => 'Assigned Permissions For This User',
        'assigned_roles' => 'Assigned Roles For This User',
        'permission' => 'Permissions Name',
        'gifts' => 'Gifts',
        'gift' => 'Gift',
        'role' => 'Role Name',
        'name' => 'User Full Name',
        'name_help' => 'Please, enter the user full name here',
        'account_type' => 'Account Type',
        'account_type_help' => 'Please, choose the user account type here',
        'email' => 'Account Email',
        'email_help' => 'Please, enter the account email here',
        'mobile' => 'Mobile (Without Country Key)',
        'mobile_help' => 'Please, enter the user mobile here',
        'address' => 'Detailed Address',
        'address_help' => 'Please, enter the user detailed address here',
        'country_id' => 'Country',
        'country_id_help' => 'Please, choose the user country here',
        'city_id' => 'City',
        'city_id_help' => 'Please, choose the user city here',
        'status' => 'Account Status',
        'status_help' => 'Please, choose the account status here',
        'store_account_type' => 'Store Account Type',
        'store_account_type_help' => 'Please, choose the store account type here',
        'password' => 'Account Password',
        'password_help' => 'Please, enter the account password here',
        'password_confirmation' => 'Account Password Confirmation',
        'password_confirmation_help' => 'Please, enter the account password confirmation here',
        'image' => 'Profile Image',
        'image_help' => 'Please, choose user profile valid image here',
        'activated' => 'Is It Activated?',
        'activated_help' => 'Please, choose wither user is activated or not here',
        'mobile_verified' => 'Is Mobile Verified?',
        'mobile_verified_help' => 'Please, choose wither user mobile is verified or not here',
        'email_verified' => 'Is Email Verified?',
        'email_verified_help' => 'Please, choose wither user email is verified or not here',
        'referrals_count' => 'Referrals Count',
        'gifts_count' => 'Gifts Count',

    ],
    'messages' => [
        'created'   => 'User has been created successfully.',
        'updated'   => 'User has been updated successfully.',
        'deleted'   => 'Requested user has been deleted successfully.',
        'retrieved' => 'Requested user has been retrieved successfully.',
        'not_found' => 'Requested user is not found',
        'exist_user'=> 'This email/mobile is already registered. Please try another',
        'logged_in' => 'You have been logged in successfully',
        'logged_out'=> 'You have been logged out successfully',
        'password_changed' => 'Password has been changed successfully',
        'new_password_subject' => 'Account New Password',
        'new_password_message' => 'Your new account password is:',
        'forget_password' => 'Your new password has been sent to your email.',
        'errors'    => [
            'password_changed'  => 'Sorry password has not been changed, Please check your password and try Again!.',
            'forget_password'   => 'Sorry new password has not been reset, Please check provided email and try Again!.',
            'created'           => 'Sorry user can not be created, Please try Again!.',
            'logged_in'         => 'Sorry user log in has been failed, Please check your credentials and try Again!.',
            'login'             => 'Sorry you are logged out, Please please log in  and try Again!.',
            'referral_code'     => 'Sorry your Referral Code Not Found please check or remove it to containue!.'
        ],
    ],
    'account_status' => [
        'green'     => 'activated',
        'gray'      => 'deleted',
        'red'       => 'suspended',
        'orange'    => 'pending',
    ],
    'store_account_type' => [
        'teal'     => 'individual',
        'brown'    => 'institutions',
    ]
];