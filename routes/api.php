<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
    Route::post('login', ['as' => 'login', 'uses' => 'UserAPIController@login']);
    Route::post('social_login', ['as' => 'social_login', 'uses' => 'UserAPIController@social_login']);
    Route::group(['middleware' => 'auth:api', 'prefix' => '/'],function() {
        Route::get('logout', ['as' => 'logout', 'uses' => 'UserAPIController@logout']);
    });

    Route::group(['middleware' => 'auth:api', 'prefix' => 'users'],function() {
        Route::get('token', ['as' => 'users.show-by-token', 'uses' => 'UserAPIController@showByToken']);
        Route::post('update', ['as' => 'users.update', 'uses' => 'UserAPIController@update']);
        Route::post('change-password', ['as' => 'change-password', 'uses' => 'UserAPIController@changePassword']);
        Route::get('validate-token', ['as' => 'users.validate-token', 'uses' => 'UserAPIController@validateToken']);
    });
    Route::group(['prefix' => 'users'],function() {
        Route::post('/', ['as' => 'users.register', 'uses' => 'UserAPIController@clientRegistration']);
        Route::post('/store-owner', ['as' => 'users.register-store-owner', 'uses' => 'UserAPIController@storeOwnerRegistration']);
        Route::get('{id}', ['as' => 'users.show', 'uses' => 'UserAPIController@show']);
        Route::post('forget-password', ['as' => 'forget-password', 'uses' => 'UserAPIController@forgetPassword']);
    });

    Route::get('brands/{category_id}', ['as' => 'brands.list', 'uses' => 'BrandAPIController@showByCategory']);
    Route::get('categories/{id}', ['as' => 'categories.show.sub-categories', 'uses' => 'CategoryAPIController@subCategories']);
    Route::get('categories/menu/lists', ['as' => 'categories.menu', 'uses' => 'CategoryAPIController@menu']);
    Route::get('categories', ['as' => 'categories.list', 'uses' => 'CategoryAPIController@index']);
    Route::get('category_attributes/{category_id}', ['as' => 'category_attributes.list', 'uses' => 'CategoryAttributeAPIController@lists']);
    Route::get('countries', ['as' => 'countries.list', 'uses' => 'CountryAPIController@index']);
    Route::get('cities/{country_id?}', ['as' => 'cities.list', 'uses' => 'CityAPIController@showByCountry']);
    Route::get('sliders', ['as' => 'sliders.list', 'uses' => 'SliderAPIController@index']);
    Route::get('stores/{id}', ['as' => 'stores.show', 'uses' => 'StoreAPIController@show']);
    Route::get('store_ratings/{store_id}', ['as' => 'store_ratings.list', 'uses' => 'StoreRatingAPIController@lists']);
    Route::put('products', ['as' => 'products.list', 'uses' => 'ProductAPIController@index']);
    Route::get('products/slider/{category_id}', ['as' => 'products.slider', 'uses' => 'ProductAPIController@in_slider']);
    Route::get('products/featured', ['as' => 'products.featured', 'uses' => 'ProductAPIController@featured']);
    
    Route::get('products/discounts/lists', ['as' => 'products.discounts', 'uses' => 'ProductAPIController@discounts']);
    Route::get('products/related-products/lists/{id}', ['as' => 'products.relatedProducts', 'uses' => 'ProductAPIController@relatedProducts']);
    Route::get('products/latest/lists/{store_id?}', ['as' => 'products.latest', 'uses' => 'ProductAPIController@latest']);
    Route::post('products/filter', ['as' => 'products.filter', 'uses' => 'ProductAPIController@filter']);
    Route::post('products/fetch-by-ids', ['as' => 'products.fetch-by-ids', 'uses' => 'ProductAPIController@fetchByIds']);
    Route::get('products/{id}', ['as' => 'products.show', 'uses' => 'ProductAPIController@show']);
    Route::get('social_media_links', ['as' => 'social_media_links.lists', 'uses' => 'SocialMediaLinkAPIController@index']);
    Route::any('common/search', ['as' => 'common.search', 'uses' => 'CommonAPIController@search']);
    Route::post('common/shippingAPI', ['as' => 'common.shippingAPI', 'uses' => 'CommonAPIController@shippingAPI']);
    Route::get('product_ratings/{product_id}', ['as' => 'product_ratings.lists', 'uses' => 'ProductRatingAPIController@lists']);
    Route::get('products_favourites/lists', ['as' => 'products_favourites.lists', 'uses' => 'ProductsFavouriteAPIController@lists']);
    Route::post('support_tickets', ['as' => 'support_tickets.store', 'uses' => 'SupportTicketAPIController@store']);
    Route::get('about-us', ['as' => 'aboutus.show', 'uses' => 'AboutUsAPIController@show']);
    Route::get('terms-and-conditions', ['as' => 'termsAndConditions.show', 'uses' => 'TermsAndConditionsAPIController@show']);
    Route::get('privacy-and-policy', ['as' => 'privacyAndPolicy.show', 'uses' => 'PrivacyAndPolicyAPIController@show']);
    Route::get('order-action-reasons/{type}', ['as' => 'order_actions_reasons.lists', 'uses' => 'OrderActionsReasonAPIController@lists']);

    Route::get('coupons',['as' => 'coupons.lists', 'uses' => 'CouponAPIController@index']);
    Route::get('coupons/home',['as' => 'coupons.home', 'uses' => 'CouponAPIController@index_home']);
    Route::get('coupons/cats_stores',['as' => 'coupons.cats_stores', 'uses' => 'CouponAPIController@get_coupon_cats_stores']);
    Route::get('coupon/{id}',['as' => 'coupon.show', 'uses' => 'CouponAPIController@get_coupon']);


    Route::group(['middleware' => 'auth:api', 'prefix' => '/'],function() {
        Route::post('store_ratings', ['as' => 'store_ratings.store', 'uses' => 'StoreRatingAPIController@store']);
        Route::get('store_ratings/likes/add/{id}', ['as' => 'store_ratings.add-like', 'uses' => 'StoreRatingAPIController@addLike']);
        Route::get('store_ratings/likes/remove/{id}', ['as' => 'store_ratings.remove-like', 'uses' => 'StoreRatingAPIController@removeLike']);
        Route::get('store_ratings/dislikes/add/{id}', ['as' => 'store_ratings.add-dislike', 'uses' => 'StoreRatingAPIController@addDislike']);
        Route::get('store_ratings/dislikes/remove/{id}', ['as' => 'store_ratings.remove-dislike', 'uses' => 'StoreRatingAPIController@removeDislike']);
        Route::post('product_ratings', ['as' => 'product_ratings.store', 'uses' => 'ProductRatingAPIController@store']);
        Route::get('product_ratings/likes/add/{id}', ['as' => 'product_ratings.add-like', 'uses' => 'ProductRatingAPIController@addLike']);
        Route::get('product_ratings/likes/remove/{id}', ['as' => 'product_ratings.remove-like', 'uses' => 'ProductRatingAPIController@removeLike']);
        Route::get('product_ratings/dislikes/add/{id}', ['as' => 'product_ratings.add-dislike', 'uses' => 'ProductRatingAPIController@addDislike']);
        Route::get('product_ratings/dislikes/remove/{id}', ['as' => 'product_ratings.remove-dislike', 'uses' => 'ProductRatingAPIController@removeDislike']);
        Route::get('products_favourites/favourite/{id}', ['as' => 'products_favourites.favourite', 'uses' => 'ProductsFavouriteAPIController@favourite']);
        Route::get('products_favourites/un-favourite/{id}', ['as' => 'products_favourites.unFavourite', 'uses' => 'ProductsFavouriteAPIController@unFavourite']);
        Route::get('notifications', ['as' => 'notifications.lists', 'uses' => 'NotificationAPIController@lists']);
        Route::get('notifications/mark-seen/{id}', ['as' => 'notifications.mark-seen', 'uses' => 'NotificationAPIController@markSeen']);
        Route::get('cart', ['as' => 'carts.lists', 'uses' => 'CartAPIController@lists']);
        Route::post('cart/checkout', ['as' => 'carts.checkout', 'uses' => 'OrderAPIController@store']);
        Route::post('cart/add-item', ['as' => 'carts.add-item', 'uses' => 'CartAPIController@addCartItem']);
        Route::post('cart/update-quantity', ['as' => 'carts.update-quantity', 'uses' => 'CartAPIController@updateCartItemQuantity']);
        Route::get('cart/remove-item/{item_id}', ['as' => 'carts.remove-item', 'uses' => 'CartAPIController@removeCartItem']);
        Route::post('voucher/validate', ['as' => 'carts.validate', 'uses' => 'VoucherAPIController@validateVoucher']);
        Route::get('addresses', ['as' => 'addresses.lists', 'uses' => 'AddressAPIController@lists']);
        Route::post('addresses', ['as' => 'addresses.store', 'uses' => 'AddressAPIController@store']);
        Route::get('addresses/{id}', ['as' => 'addresses.show', 'uses' => 'AddressAPIController@show']);
        Route::post('addresses/{id}', ['as' => 'addresses.update', 'uses' => 'AddressAPIController@update']);
        Route::delete('addresses/{id}', ['as' => 'addresses.delete', 'uses' => 'AddressAPIController@destroy']);
        Route::post('orders', ['as' => 'orders.lists', 'uses' => 'OrderAPIController@lists']);
        Route::get('orders/{id}', ['as' => 'orders.show', 'uses' => 'OrderAPIController@show']);
        Route::post('order_actions/cancel', ['as' => 'orders.cancel', 'uses' => 'OrderActionAPIController@cancelOrder']);
        Route::post('order_actions/return', ['as' => 'orders.return', 'uses' => 'OrderActionAPIController@returnOrder']);
        Route::post('product_actions/report', ['as' => 'products.report', 'uses' => 'OrderActionAPIController@reportProduct']);


        Route::post('voucher-coupon/validate', ['as' => 'voucher-coupon.validate', 'uses' => 'CouponAPIController@validateVoucherCoupon']);

        //Dapricated Becuse of new requirement /////////////////////////////////////////////
        Route::post('like-coupon',['as' => 'coupon.like', 'uses' => 'CouponAPIController@like_coupon']);
        Route::post('fav-coupon',['as' => 'coupon.fav', 'uses' => 'CouponAPIController@fav_coupon']);
        Route::post('order-coupon',['as' => 'coupon.order', 'uses' => 'CouponAPIController@order_coupon']);
        Route::get('user-coupon',['as' => 'user.coupon', 'uses' => 'CouponAPIController@user_coupon']);
        Route::get('user-favs',['as' => 'user.favs', 'uses' => 'CouponAPIController@user_favs']);

        Route::get('coupon_ratings/{coupon_id}', ['as' => 'coupon_ratings.lists', 'uses' => 'CouponRatingAPIController@lists']);
        Route::post('coupon_ratings', ['as' => 'coupon_ratings.store', 'uses' => 'CouponRatingAPIController@store']);
        Route::get('coupon_ratings/likes/add/{id}', ['as' => 'coupon_ratings.add-like', 'uses' => 'CouponRatingAPIController@addLike']);
        Route::get('coupon_ratings/likes/remove/{id}', ['as' => 'coupon_ratings.remove-like', 'uses' => 'CouponRatingAPIController@removeLike']);
        Route::get('coupon_ratings/dislikes/add/{id}', ['as' => 'coupon_ratings.add-dislike', 'uses' => 'CouponRatingAPIController@addDislike']);
        Route::get('coupon_ratings/dislikes/remove/{id}', ['as' => 'coupon_ratings.remove-dislike', 'uses' => 'CouponRatingAPIController@removeDislike']);
        ///////////////////////////////////////////////////////////////

        // Route::post('favourite_vouchers',['as' => 'favourite_vouchers', 'uses' => 'CouponController@favourite_vouchers']);

        // Route::post('list_favourite_vouchers',['as' => 'list_favourite_vouchers', 'uses' => 'CouponController@list_favourite_vouchers']);

        // Route::post('like_comment_voucher', 'CouponController@like_comment_voucher');

    });