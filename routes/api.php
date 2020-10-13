<?php

use Illuminate\Http\Request;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

$router->group([
    'as' => 'api_',
    'middleware' => []], function () use ($router) {

    $router->post('/upload-image', 'ImageController@upload')->name('upload_image');

    $router->get('/cities/state/{state_id}', 'Admin\CityController@getCitiesByState')->name('state_by_country');
    $router->get('/state/country/{country_id}', 'Admin\StatesController@getStatesByCountry')->name('state_by_country');
    $router->put('/state/status', 'Admin\StatesController@updateStatus')->name('state_update_status');
    $router->put('/country/status', 'Admin\CountryController@updateStatus')->name('country_update_status');

    $router->get('/cities', 'Frontend\CityController@search')->name('city_search');
    $router->put('/city/status', 'Admin\CityController@updateStatus')->name('city_update_status');
    $router->get('/cities/{country_id}', 'Admin\CityController@getListByCountry')->name('city_get_list');

    $router->get('/categories', 'Frontend\CategoryController@search')->name('category_search');
    $router->put('/category/status', 'Admin\CategoryController@updateStatus')->name('category_update_status');
    $router->put('/category/is-feature', 'Admin\CategoryController@updateIsFeature')->name('category_update_is_feature');

    $router->put('/places/status', 'Admin\PlaceController@updateStatus')->name('place_update_status');
    //$router->get('/places/map', 'Frontend\PlaceController@getListMap')->name('place_get_list_map');

    $router->put('/reviews/status', 'Admin\ReviewController@updateStatus')->name('review_update_status');

    //$router->get('/search', 'Frontend\HomeController@ajaxSearch')->name('search');

    $router->put('/posts/status', 'Admin\PostController@updateStatus')->name('post_update_status');

    $router->put('/users/status', 'Admin\UserController@updateStatus')->name('user_update_status');
    $router->put('/users/role', 'Admin\UserController@updateRole')->name('user_update_role');

    $router->put('/languages/default', 'Admin\LanguageController@setDefault')->name('language_set_default');

    $router->post('/user/reset-password', 'Frontend\ResetPasswordController@sendMail')->name('user_forgot_password');
});


$router->group([
    'namespace' => 'API',
    'prefix' => 'chat',
    'middleware' => 'auth:api'
], function () use ($router) {
    $router->get('/place/{id}/channels', 'ChatController@getChannels');
    $router->post('/channel/{id}', 'ChatController@sendMessage');
    $router->get('/channel/{id}/messages', 'ChatController@getMessages');
    $router->post('/channel/{id}/archive', 'ChatController@archiveChannel');
});

$router->group([
    'prefix' => 'app',
    'namespace' => 'API',
    'as' => 'api_app_',
    'middleware' => []], function () use ($router) {

    $router->get('/cities', 'CityController@list');
    $router->get('/cities/{id}', 'CityController@detail')->where('id', '[0-9]+');
    $router->get('/cities/popular', 'CityController@popularCity');

    $router->get('/posts/inspiration', 'PostController@postInspiration');

    $router->get('/places/{id}', 'PlaceController@detail')->where('id', '[0-9]+');

    $router->get('/places/search', 'PlaceController@search');

    /**
     * Users
     */
    $router->get('/users', 'UserController@getUserInfo')->middleware('auth:api');
    $router->get('/users/{user_id}/place', 'UserController@getPlaceByUser');
    $router->get('/users/{user_id}/place/wishlist', 'UserController@getPlaceByUser');
    $router->post('/users/reset-password', 'Frontend\ResetPasswordController@sendMail')->name('user_forgot_password');
    $router->post('/users/login', 'UserController@login');

    $router->get('/user/payment-info', 'PaymentInfoController@index')->name('payment_info')->middleware('auth');
    $router->post('/user/payment-info/card/new', 'PaymentInfoController@addCard')->name('add_new_card')->middleware('auth');
    $router->post('/user/payment-info/card/default', 'PaymentInfoController@setDefaultPayment')->name('set_default_card')->middleware('auth');
    $router->post('/user/payment-info/card/remove', 'PaymentInfoController@removeCard')->name('remove_card')->middleware('auth');
    $router->post('/user/payment-info/subscription/subscribe', 'PaymentInfoController@subscribe')->name('subscribe')->middleware('auth');
    $router->post('/user/payment-info/subscription/cancel', 'PaymentInfoController@cancelSubscription')->name('unsubscribe')->middleware('auth');
    $router->post('/user/payment-info/subscription/resume', 'PaymentInfoController@resumeSubscription')->name('resume')->middleware('auth');

    /**
     * Places
     */
    $router->post('/places/wishlist', 'PlaceController@addPlaceToWishlist')->middleware('auth:api');
    $router->delete('/places/wishlist', 'PlaceController@removePlaceFromWishlist')->middleware('auth:api');
});
