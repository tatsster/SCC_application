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

/*
|--------------------------------------------------------------------------
| Users View
|--------------------------------------------------------------------------
|
| Generate view for users
|
*/

/* Dashboard */

Route::get('/','MainController@dashboard');
Route::get('dashboard','MainController@dashboard');

/* Sign In */

Route::get('sign-in','MainController@sign_in');

/* Sign Out */

Route::get('sign-out','MainController@sign_out');

/* Profile */

Route::get('profile','MainController@profile');

/* Add Profile */

Route::get('add-profile','MainController@add_profile');

/* Report */

Route::get('report','MainController@report');

/* Room Report */

Route::get('room','MainController@room');

Route::get('report-floor','MainController@report_floor');
Route::get('report-device','MainController@report_device');
Route::get('report-sensor','MainController@report_sensor');
Route::get('settings','MainController@settings');
Route::get('profile','MainController@profile');
Route::get('user-list','MainController@user_list');

/* Permission */

Route::get('permission','MainController@permission');

/*
|--------------------------------------------------------------------------
| Users Features
|--------------------------------------------------------------------------
|
| Provide features for users
|
*/

/* Sign In */

Route::post('send-sign-in','MainController@send_sign_in');

/* Change Language */

Route::post('change-language','MainController@change_language');

/* Change System Setting */

Route::post('change-system-settings','MainController@change_system_settings');

/* Change Dashboard Setting */

Route::post('change-dashboard-settings','MainController@change_dashboard_settings');

/* Get Real Time Temperature */

Route::post('get-real-time-temp','MainController@get_real_time_temp');

/* Choose role to edit */

Route::post('choose-role','MainController@choose_role');

/* Create role */

Route::post('create-role','MainController@create_role');

/* Update or delete role */

Route::post('update-or-delete-role','MainController@update_or_delete_role');

/* Update profile */

Route::post('update-profile','MainController@update_profile');

/* Update profile avatar */

Route::post('update-profile-avatar','MainController@update_profile_avatar');

/* Create building */

Route::post('create-building','MainController@create_building');

/* Choose building */

Route::post('choose-building','MainController@choose_building');

/* Choose room */

Route::post('choose-room','MainController@choose_room');

/* Create room */

Route::post('create-sensor','MainController@create_sensor');

/* Choose sensor */

Route::post('choose-sensor','MainController@choose_sensor');

/* Update sensor */

Route::post('update-sensor','MainController@update_sensor');

/* Run stop sensor */

Route::post('run-stop-sensor','MainController@run_stop_sensor');

/* Rrefresh sensor */

Route::post('refresh-sensor','MainController@refresh_sensor');
