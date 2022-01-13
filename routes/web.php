<?php
//Route::get('/date', function () {
//    return view('data');
//});
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', 'HomeController@test');

Auth::routes();
Route::group(['middleware' => 'auth'],function() {
    Route::get('/home',
        ['as' => 'home', 'uses' => 'HomeController@index']);
 Route::resource('/coupons','CouponController');
    Route::post('coupons/ajax/images/delete-image',
        ['as' => 'coupons.ajax.images.deleteCouponImage', 'uses' => 'CouponController@deleteCouponImage']);
    Route::resource('/settings','SettingController');
    Route::post('/settingss/{id}','SettingController@update')->name('settingss');
    Route::resource('roles', 'RoleController');
    Route::get('/roles/revoke-permission/{role_id}/{permission_id}',
        ['as' => 'roles.revoke-permission', 'uses' => 'RoleController@revokePermission']);
    Route::resource('permissions', 'PermissionController');
    Route::resource('languages', 'LanguageController');
    Route::get('/categories/seed',
        ['as' => 'categories.seed', 'uses' => 'CategoryController@seed']);
    Route::resource('categories', 'CategoryController');
    Route::resource('brands', 'BrandController');
    Route::resource('countries', 'CountryController');
    Route::resource('cities', 'CityController');
    Route::resource('users', 'UserController');
    Route::get('usersReferral',
        ['as' => 'usersReferral', 'uses' => 'UserReferraController@index']);

    Route::get('/users/revoke-role/{user_id}/{role_id}',
        ['as' => 'users.revoke-role', 'uses' => 'UserController@revokeRole']);
    Route::get('/users/revoke-permission/{user_id}/{permission_id}',
        ['as' => 'users.revoke-permission', 'uses' => 'UserController@revokePermission']);
    Route::get('/users/revoke-gift/{user_id}/{gift_id}',
        ['as' => 'users.revoke-gift', 'uses' => 'UserGiftController@revokeGift']);
    Route::resource('storeTypes', 'StoreTypeController');
    Route::resource('stores', 'StoreController');
    Route::post('/stores/ajax/terms-and-policy/add-paragraph',
        ['as' => 'stores.ajax.termsAndPolicy.addParagraph', 'uses' => 'StoreController@addParagraph']);
    Route::post('/stores/ajax/terms-and-policy/edit-paragraph-title',
        ['as' => 'stores.ajax.termsAndPolicy.editParagraphTitle', 'uses' => 'StoreController@editParagraphTitle']);
    Route::post('/stores/ajax/terms-and-policy/edit-paragraph-description',
        ['as' => 'stores.ajax.termsAndPolicy.editParagraphDescription', 'uses' => 'StoreController@editParagraphDescription']);
    Route::post('/stores/ajax/terms-and-policy/edit-paragraph-active',
        ['as' => 'stores.ajax.termsAndPolicy.editParagraphActive', 'uses' => 'StoreController@editParagraphActive']);
    Route::post('/stores/ajax/terms-and-policy/edit-paragraph-language',
        ['as' => 'stores.ajax.termsAndPolicy.editParagraphLanguage', 'uses' => 'StoreController@editParagraphLanguage']);
    Route::post('/stores/ajax/terms-and-policy/delete-paragraph',
        ['as' => 'stores.ajax.termsAndPolicy.deleteParagraph', 'uses' => 'StoreController@deleteParagraph']);
    Route::resource('sliders', 'SliderController');
    Route::resource('storeRatings', 'StoreRatingController');
    Route::resource('categoryAttributes', 'CategoryAttributeController');
    
    Route::get('subscriptions/view', 'SubscriptionController@view_subscriptions')->name('subscriptions.view');
    Route::resource('subscriptions', 'SubscriptionController');
    Route::resource('storeSubscriptions', 'StoreSubscriptionController');
    Route::post('/storeSubscriptions/ajax/get-subscription-price',
        ['as' => 'storeSubscriptions.ajax.getSubscriptionPrice', 'uses' => 'StoreController@getSubscriptionPrice']);
    

        Route::post('products/ajax/category-attributes/fetch',
        ['as' => 'products.ajax.category-attributes.fetch', 'uses' => 'ProductController@fetchCategoryAttributes']);
    Route::post('products/ajax/category-attributes/edit-active',
        ['as' => 'products.ajax.category-attributes.editProductAttributeActive', 'uses' => 'ProductController@editProductAttributeActive']);
    Route::post('products/ajax/category-attributes/edit-value',
        ['as' => 'products.ajax.category-attributes.editProductAttributeValue', 'uses' => 'ProductController@editProductAttributeValue']);
    Route::post('products/ajax/images/edit-active',
        ['as' => 'products.ajax.images.editProductImageActive', 'uses' => 'ProductController@editProductImageActive']);
    Route::post('products/ajax/images/edit-main',
        ['as' => 'products.ajax.images.editProductImageMain', 'uses' => 'ProductController@editProductImageMain']);
    Route::post('products/ajax/images/delete-image',
        ['as' => 'products.ajax.images.deleteProductImage', 'uses' => 'ProductController@deleteProductImage']);
    Route::post('products/ajax/related-products/unlink-related-product',
        ['as' => 'products.ajax.related-products.unlinkRelatedProduct', 'uses' => 'ProductController@unlinkRelatedProduct']);
    Route::resource('products', 'ProductController');
    Route::resource('productRatings', 'ProductRatingController');
    Route::resource('productsFavourites', 'ProductsFavouriteController');
    Route::resource('vouchers', 'VoucherController');
    Route::post('/aboutuses/ajax/add-paragraph',
        ['as' => 'aboutuses.ajax.addParagraph', 'uses' => 'AboutUsController@addParagraph']);
    Route::post('/aboutuses/ajax/edit-paragraph-title',
        ['as' => 'aboutuses.ajax.editParagraphTitle', 'uses' => 'AboutUsController@editParagraphTitle']);
    Route::post('/aboutuses/ajax/edit-paragraph-description',
        ['as' => 'aboutuses.ajax.editParagraphDescription', 'uses' => 'AboutUsController@editParagraphDescription']);
    Route::post('/aboutuses/ajax/edit-paragraph-active',
        ['as' => 'aboutuses.ajax.editParagraphActive', 'uses' => 'AboutUsController@editParagraphActive']);
    Route::post('/aboutuses/ajax/edit-paragraph-language',
        ['as' => 'aboutuses.ajax.editParagraphLanguage', 'uses' => 'AboutUsController@editParagraphLanguage']);
    Route::post('/aboutuses/ajax/edit-image-paragraph',
        ['as' => 'aboutuses.ajax.editImageParagraph', 'uses' => 'AboutUsController@editParagraphImage']);
    Route::post('/aboutuses/ajax/delete-paragraph',
        ['as' => 'aboutuses.ajax.deleteParagraph', 'uses' => 'AboutUsController@deleteParagraph']);
    Route::resource('aboutuses', 'AboutUsController');
    Route::get('/socialMediaLinks/seed',
        ['as' => 'socialMediaLinks.seed', 'uses' => 'SocialMediaLinkController@seed']);
    Route::resource('socialMediaLinks', 'SocialMediaLinkController');
    Route::resource('supportTickets', 'SupportTicketController');

    
    Route::resource('notifications', 'NotificationController');
    Route::post('carts/ajax/cart-items/remove-item',
        ['as' => 'carts.ajax.cartItems.removeItem', 'uses' => 'CartController@removeCartItem']);
    Route::resource('carts', 'CartController');
    Route::resource('addresses', 'AddressController');
    Route::resource('orders', 'OrderController');
    Route::resource('orderActionsReasons', 'OrderActionsReasonController');
    Route::resource('orderActions', 'OrderActionController');

    Route::post('user_gift',
        ['as' => 'user_gift.store', 'uses' => 'UserGiftController@store']);
    Route::post('notifications/referal',
        ['as' => 'notifications.referalStore', 'uses' => 'NotificationController@referalStore']);
});

Route::group([
    'prefix' => '/configuration',
    'namespace' => '\App\Core\Controllers',
], function() {
    // Alter Application Schema with new Languages
    Route::get('/schema/update-languages', ['as' => 'application.schema.update_languages', 'uses' => 'CustomizedAppBaseController@alterApplicationSchemaWithNewLanguage']);

    // Refresh Application Modules Permissions
    Route::get('/permissions/refresh', ['as' => 'application.permissions.refresh', 'uses' => 'CustomizedAppBaseController@refreshApplicationModulesPermissions']);

    // Change Application Language
    Route::get('/change-language/{theme}/{language}', ['as' => 'change-language', 'uses' => 'CustomizedAppBaseController@changeLanguage']);
});

Route::get('/ajax/fetch-country-cities', ['as' => 'ajax.fetch-country-cities', 'uses' => '\App\Core\Controllers\CommonAjaxController@fetchCountryCities']);