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

Route::get('/', function () {
    return view('welcome');
});
Route::namespace('Admin')->name('admin.')->prefix('administracja')->group(function () {

    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', 'DashboardController@index')->name('index');
    });


    Route::get('/', 'ChatController@chat')->name('index');
    Route::post('/send', 'ChatController@send');
    Route::post('/getOldMessages', 'ChatController@getOldMessages');
    Route::get('/getOldMessagesTest', 'ChatController@getOldMessagesTest');
    Route::post('/saveToSession', 'ChatController@saveToSession');


    Route::get('login', 'LoginController@index')->name('login');

});
Auth::routes();

