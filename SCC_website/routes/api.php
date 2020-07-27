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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/* Query database */

Route::post('query','API\APIController@query');

/* Sign In */

Route::post('sign-in','API\APIController@sign_in');

/* Profile */

Route::post('update-profile','API\APIController@update_profile');

/* User List */

Route::post('user-list','API\APIController@user_list');

/* Return Hours Usage And Electrical Consumption */

Route::post('hours-usage-electrical-consumption','API\APIController@hours_usage_electrical_consumption');

/* Building, Floor And Room */

Route::post('get-building','API\APIController@get_building');
Route::post('get-floor','API\APIController@get_floor');
Route::post('get-room','API\APIController@get_room');
