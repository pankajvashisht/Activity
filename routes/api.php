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

$router->group(['prefix' => 'v1', 'namespace' => 'v1','middleware'=>'cors'], function($router) {
    $router->get('/',function(){
        return "Hello world apis is working";
    });
    $router->post('/login', [
        'as'   => 'user_login',
        'uses' => 'UserController@userLogin',
    ]);

    Route::match(['OPTIONS', 'post'],'/auth/github','UserController@gitHub');
     
    $router->group(['middleware' => ['CheckAuthKey']], function ($router) {
        $router->get('/games',[
            'as'   => 'games',
            'uses' => 'GamesController@get'
        ]);
        $router->get('/slot/{game_id}/{date?}', [
            'as' => 'slot',
            'uses' => 'SlotsController@view'
        ]);
        $router->post('/create_booking', [
            'as' => 'create_booking',
            'uses' => 'BookingsController@create'
        ]);
        $router->get('/bookings/{user_id}', [
            'as' => 'bookings',
            'uses' => 'BookingsController@UsersBookings'
        ]);
        $router->get('/all_bookings', [
            'as' => 'all_bookings',
            'uses' => 'BookingsController@AllBookings'
        ]);
        $router->get('/get_users/{user_id}', [
            'as' => 'users',
            'uses' => 'UserController@getUsers'
        ]);
    });
    $router->post('/slot','SlotsController@fakeAddData');
    $router->post('/games','GamesController@addFakeData');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
