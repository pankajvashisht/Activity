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

$router->group(['prefix' => 'v1', 'namespace' => 'v1'], function($router) {
    $router->post('/login', [
        'as'   => 'user_login',
        'uses' => 'UserController@userLogin',
    ]);
    $router->get('/games','GamesController@get');
    $router->get('/slot/{game_id}/{date?}','SlotsController@view');
    $router->post('/create_booking','BookingsController@create');
    $router->post('/slot','SlotsController@fakeAddData');
    $router->post('/games','GamesController@addFakeData');
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
