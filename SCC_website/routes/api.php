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
Route::post('get-floor-table','API\APIController@get_floor_table');
Route::post('get-room-table','API\APIController@get_room_table');
Route::post('get-sensor-device-table','API\APIController@get_sensor_device_table');
Route::post('get-room','API\APIController@get_room');
Route::post('activate-deactivate-room','API\APIController@activate_deactivate_room');
Route::post('activate-deactivate-floor','API\APIController@activate_deactivate_floor');
Route::post('activate-deactivate-building','API\APIController@activate_deactivate_building');

/* Sensor */

Route::post('run-stop-sensor','API\APIController@run_stop_sensor');
Route::post('get-sensor-full-log','API\APIController@get_sensor_full_log');

/* Device */

Route::post('run-stop-device','API\APIController@run_stop_device');
Route::post('auto-run-stop-device','API\APIController@auto_run_stop_device');
Route::post('get-device-full-log','API\APIController@get_device_full_log');

/* Weather */

Route::post('get-current-weather','API\APIController@get_current_weather');


