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
| Users Secret View
|--------------------------------------------------------------------------
|
| Generate view for users
|
*/

/* Confirm Information */

Route::get('confirm-information','MainController@confirm_information');

/*
|--------------------------------------------------------------------------
| Users View
|--------------------------------------------------------------------------
|
| Generate view for users
|
*/

/* Lock Screen */

Route::get('lockscreen','MainController@lockscreen');

/* Dashboard */

Route::get('/','MainController@dashboard');
Route::get('dashboard','MainController@dashboard');

/* Sign In */

Route::get('sign-in','MainController@sign_in');

/* Forgot Password */

Route::get('forgot-password','MainController@forgot_password');

/* Sign Out */

Route::get('sign-out','MainController@sign_out');

/* Profile */

Route::get('profile','MainController@profile');

/* Edit Profile */

Route::post('edit-other-profile-get','MainController@edit_other_profile_get');
Route::get('edit-other-profile','MainController@edit_other_profile');

/* Add Profile */

Route::get('add-profile','MainController@add_profile');

/* Sign Up */

Route::get('sign-up','MainController@sign_up');

/* Report */

Route::get('report','MainController@report');

/* User List */

Route::get('user-list','MainController@user_list');
Route::get('find-profile','MainController@find_profile');

/* Room Report */

Route::get('room','MainController@room');

/* Settings */

Route::get('settings','MainController@settings');

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

Route::post('send-sign-in','SignInController@send_sign_in');
Route::post('send-recover-password','SignInController@send_recover_password');

/* Change Language */

Route::post('change-language','ChangeLanguageController@change_language');

Route::post('change-language-cookie','ChangeLanguageController@change_language_cookie');

/* Change System Setting */

Route::post('change-system-settings','SettingsController@change_system_settings');

Route::post('change-dashboard-settings','SettingsController@change_dashboard_settings');

/* Get Real Time Temperature */

//Route::post('get-real-time-temp','MainController@get_real_time_temp');

/* Role */

Route::post('choose-role','PermissionController@choose_role');
Route::post('create-role','PermissionController@create_role');
Route::post('update-or-delete-role','PermissionController@update_or_delete_role');

/* Profile */

Route::post('new-profile','ProfileController@new_profile');
Route::post('register','ProfileController@register');
Route::post('update-profile','ProfileController@update_profile');
Route::post('update-profile-avatar','ProfileController@update_profile_avatar');
Route::post('update-other-profile','ProfileController@update_other_profile');
Route::post('update-other-profile-avatar','ProfileController@update_other_profile_avatar');

/* Building */

Route::post('create-building','ReportController@create_building');
Route::post('rename-building','ReportController@rename_building');
Route::post('delete-building','ReportController@delete_building');
Route::post('choose-building','ReportController@choose_building');
Route::post('activate-deactivate-building','ReportController@activate_deactivate_building');

/* Floor */

Route::post('create-floor','ReportController@create_floor');
Route::post('rename-floor','ReportController@rename_floor');
Route::post('delete-floor','ReportController@delete_floor');
Route::post('activate-deactivate-floor','ReportController@activate_deactivate_floor');

/* Room */

Route::post('create-room','ReportController@create_room');
Route::post('rename-room','ReportController@rename_room');
Route::post('delete-room','ReportController@delete_room');
Route::post('choose-room','ReportController@choose_room');
Route::post('activate-deactivate-room','ReportController@activate_deactivate_room');

/* Set room tab */

Route::post('set-current-room-tab','MainController@set_current_room_tab');

/* Sensor */

Route::post('create-sensor','ReportController@create_sensor');
Route::post('choose-sensor','ReportController@choose_sensor');
Route::post('update-sensor','ReportController@update_sensor');
Route::post('run-stop-sensor','ReportController@run_stop_sensor');
Route::post('refresh-sensor','ReportController@refresh_sensor');
Route::post('sensor-search-time-range','ReportController@sensor_search_time_range');

/* Device */

Route::post('create-device','ReportController@create_device');
Route::post('choose-device','ReportController@choose_device');
Route::post('update-device','ReportController@update_device');
Route::post('run-stop-device','ReportController@run_stop_device');
Route::post('refresh-device','ReportController@refresh_device');
Route::post('device-search-time-range','ReportController@device_search_time_range');

/* Set lock screen */

Route::post('set-lockscreen','MainController@set_lockscreen');

/* ChatBot */

Route::post('chatbot','MainController@chatbot');
