<?php
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

Route::get('/{any}', function () {
    return view('welcome');
});
Route::get('/', function () {
    return view('welcome');
});
$router->group([ 'namespace' => 'v1'], function(){
    Route::get('auth/{provider}', 'UserController@gitHub');
    Route::get('auth/{provider}/callback', 'UserController@gitHubUser');  
    Route::get('user/logout', 'UserController@logout');  
});


 Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
