<?php


namespace App\Http\Controllers;


use App\SettingsInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class SettingsController extends MainController {

    /* Change system settings */

    public function change_system_settings(Request $request){

        $validator = Validator::make($request->all(), [
            'backup_log_system' => 'required',
            'maintenance_system' => 'required'
        ],
            [
                'backup_log_system.required' => 'Invalid Action !!!',
                'maintenance_system.required' => 'Invalid Action !!!'
            ]);

        if ($validator->fails()) {
            echo $this->send_error("Đã có lỗi xảy ra !!!", $validator->errors());
        }
        else {

            $request_array = array_values($request->all());
            $request_key = array_keys($request->all());

            for ($i = 1; $i < count($request_array); $i++) {
                $settings_each = SettingsInfo::where("settings_name", $request_key[$i])->first();
                $settings_each->settings_value = $request_array[$i];
                $settings_each->save();
            }

            Lang::setLocale($request->session()->get('1752051_user')["user_lang"]);

            echo $this->sendResponse([], Lang::get('Update successfully !!!'));

        }

    }

    /* Change dashboard settings */

    public function change_dashboard_settings(Request $request){

        $validator = Validator::make($request->all(), [
            'time_update_temp' => 'required',
            'time_update_humid' => 'required',
            'time_update_heat_index' => 'required'
        ],
            [
                'time_update_temp.required' => 'Please Input The Update Temperature Time !!!',
                'time_update_humid.boolean' => 'Please Input The Update Humid Time !!!',
                'time_update_heat_index.required' => 'Please Input The Update Heat Index Time !!!'
            ]);

        if ($validator->fails()) {
            echo $this->send_error("Đã có lỗi xảy ra !!!", $validator->errors());
        }

        $request_array = array_values($request->all());
        $request_key = array_keys($request->all());

        for ($i = 1; $i < count($request_array); $i++){
            $settings_each = SettingsInfo::where("settings_name",$request_key[$i])->first();
            $settings_each->settings_value = $request_array[$i];
            $settings_each->save();
        }

        Lang::setLocale($request->session()->get('1752051_user')["user_lang"]);

        echo $this->sendResponse([], Lang::get('Update successfully !!!'));

    }

}
