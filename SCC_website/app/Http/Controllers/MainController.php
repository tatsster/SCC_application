<?php
namespace App\Http\Controllers;

use App\BuildingInfo;
use App\DeviceInfo;
use App\DeviceLogInfo;
use App\FloorInfo;
use App\LanguageInfo;
use App\PermissionInfo;
use App\RoomInfo;
use App\SensorInfo;
use App\SensorLogInfo;
use App\SettingsInfo;
use App\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class MainController extends Controller {

    protected $search = '';

    /* Generate Features */

    private function crypto_rand_secure($min, $max)
    {
        $range = $max - $min;
        if ($range < 1) return $min; // not so random...
        $log = ceil(log($range, 2));
        $bytes = (int) ($log / 8) + 1; // length in bytes
        $bits = (int) $log + 1; // length in bits
        $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // discard irrelevant bits
        } while ($rnd > $range);
        return $min + $rnd;
    }

    protected function get_token($length)
    {
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet.= "0123456789";
        $max = strlen($codeAlphabet); // edited

        for ($i=0; $i < $length; $i++) {
            $token .= $codeAlphabet[$this->crypto_rand_secure(0, $max-1)];
        }

        return $token;
    }

    protected function send_response($result, $message){
        $response = [
            'success' => true,
            'data' => $result,
            'message' => $message,
        ];
        return response()->json($response, 200);
    }

    protected function send_error($error, $message, $code = 404) {
        $response = [
            'success' => false,
            'data' => $error,
            'message' => $message,
        ];
        return response()->json($response, $code);
    }

    /* Check user session expiration or remember me token */

    protected function prepare_user_session(Request $request){

        if ($request->session()->get("1752051_user_timeout") != null){
            return $this->lockscreen($request);
        }

        if($request->session()->get('1752051_user') != null && $request->session()->get('1752051_user')["user_active"] == true) {

            $user_db = UserInfo::where('user_id', $request->session()->get('1752051_user')["user_id"])->get();

            if (!(count($user_db) > 0)) {
                return $this->sign_in($request);
            }

        }
        else {

            $user_db = UserInfo::where('user_remember_token', $request->cookie('1752051_user_remember'))->get();

            if (!(count($user_db) > 0)) {
                return $this->sign_in($request);
            }

        }

        /* Set the language user choose */

        $user_db = $user_db->first();

        $user_role = PermissionInfo::where("permission_role", $user_db['user_role'])->first();

        $request->session()->put("1752051_user",$user_db);

        $request->session()->put("1752051_user_role",$user_role);

        Lang::setLocale($request->session()->get('1752051_user')["user_lang"]);

    }

    /* Redirect to view */

    public function lockscreen(Request $request){

        Lang::setLocale($request->cookie('1752051_user_lang'));

        /* Prepare user session */

        if ($request->session()->get("1752051_user_timeout") == null){
            return $this->sign_in($request);
        }

        /* Get language options */

        $lang_db = LanguageInfo::all();

        return view('lockscreen', compact("lang_db"));
    }

    public function dashboard(Request $request){

        /* Prepare user session */

        if ($this->prepare_user_session($request) != null) {
            return $this->prepare_user_session($request);
        }

        /* Get language options */

        $lang_db = LanguageInfo::all();

        /* Calculate hours usage and electrical usage */

        $device_log_db = DB::table('device')
            ->join('device_log', 'device.device_id', '=', 'device_log.device_id')
            ->where('device_log.device_status', '=', false)
            ->get();

        $hours_usage = 0;
        $electrical_consumption = 0;

        foreach($device_log_db as $device_log_each){
            $device_log_each = (array) $device_log_each;
            $hours_usage += $device_log_each["device_hours_usage"];
            $electrical_consumption += $device_log_each["device_electrical_consumption"];
        }

        $hours_usage = round($hours_usage,2);
        $electrical_consumption = round($electrical_consumption,2);

        $current_page = "dashboard";

        return view("dashboard",compact("current_page","hours_usage","electrical_consumption","lang_db"));
    }

    public function room(Request $request){

        /* Prepare user session */

        if ($this->prepare_user_session($request) != null) {
            return $this->prepare_user_session($request);
        }

        /* Get language options */

        $lang_db = LanguageInfo::all();

        /* Get other options */

        $device_db = DeviceInfo::where("device_building_name",$request->session()->get("1752051_room_building"))->where("device_floor_name",$request->session()->get("1752051_room_floor"))->where("device_room_name",$request->session()->get("1752051_room_name"))->get();

        $sensor_db = SensorInfo::where("sensor_building_name",$request->session()->get("1752051_room_building"))->where("sensor_floor_name",$request->session()->get("1752051_room_floor"))->where("sensor_room_name",$request->session()->get("1752051_room_name"))->get();

        if ($request->session()->get("1752051_room_building") != $request->session()->get("1752051_current_sensor")["sensor_building_name"] || $request->session()->get("1752051_room_floor") != $request->session()->get("1752051_current_sensor")["sensor_floor_name"] || $request->session()->get("1752051_room_name") != $request->session()->get("1752051_current_sensor")["sensor_room_name"]){

            $request->session()->forget("1752051_current_sensor");

            $request->session()->forget("1752051_current_sensor_log");

        }
        else{

            $sensor = SensorInfo::where("sensor_id", $request->session()->get("1752051_current_sensor")["sensor_id"])->first();

            $sensor_log = SensorLogInfo::where("sensor_id", $request->session()->get("1752051_current_sensor")["sensor_id"])->orderBy('sensor_timestamp', 'DESC')->get();

            $request->session()->put("1752051_current_sensor",$sensor);

            $request->session()->put("1752051_current_sensor_log",$sensor_log);

        }

        if ($request->session()->get("1752051_room_building") != $request->session()->get("1752051_current_device")["device_building_name"] || $request->session()->get("1752051_room_floor") != $request->session()->get("1752051_current_device")["device_floor_name"] || $request->session()->get("1752051_room_name") != $request->session()->get("1752051_current_device")["device_room_name"]){

            $request->session()->forget("1752051_current_device");

            $request->session()->forget("1752051_current_device_log");

        }
        else{

            $device_log = DeviceLogInfo::where("device_id", $request->session()->get("1752051_current_device")["device_id"])->orderBy('device_timestamp', 'DESC')->get();

            $device = DeviceInfo::where("device_id", $request->session()->get("1752051_current_device")["device_id"])->first();

            $request->session()->put("1752051_current_device",$device);

            $request->session()->put("1752051_current_device_log",$device_log);

        }

        $current_page = "report";
        return view("room",compact("current_page", "lang_db", "sensor_db" , "device_db"));
    }

    public function set_current_room_tab(Request $request){

        $request->session()->put("1752051_current_room_tab",$request["tab_id"]);

        echo "Success";
    }

    public function settings(Request $request){

        /* Prepare user session */

        if ($this->prepare_user_session($request) != null) {
            return $this->prepare_user_session($request);
        }

        /* Get language options */

        $lang_db = LanguageInfo::all();

        /* Get other options */

        $settings_db = SettingsInfo::all();

        $settings_array = [];

        foreach ($settings_db as $settings_each){
            $settings_array[$settings_each->settings_name] = $settings_each->settings_value;
        }

        $current_page = "settings";
        return view("settings",compact("current_page","lang_db","settings_array"));
    }

    public function profile(Request $request){

        /* Prepare user session */

        if ($this->prepare_user_session($request) != null) {
            return $this->prepare_user_session($request);
        }

        /* Get language options */

        $lang_db = LanguageInfo::all();

        $current_page = "profile";
        return view('profile', compact("current_page", "lang_db"));
    }

    public function add_profile(Request $request){

        /* Prepare user session */

        if ($this->prepare_user_session($request) != null) {
            return $this->prepare_user_session($request);
        }

        /* Get language options */

        $lang_db = LanguageInfo::all();

        $permission_db = PermissionInfo::all();

        $current_page = "user-list";
        return view('add-profile', compact("current_page", "lang_db", "permission_db"));
    }

    public function edit_other_profile_get(Request $request) {

        /* Prepare user session */

        if ($this->prepare_user_session($request) != null) {
            return $this->prepare_user_session($request);
        }

        if ($request["current_user_email_delete"] != null){

            $current_user = UserInfo::where("user_email",$request["current_user_email_delete"]);

            $user = $current_user->first();

            $current_path = str_replace("../","",$user["user_avatar"]);

            if(File::exists($current_path)) {
                File::delete($current_path);
            }

            $current_user->delete();

            return redirect()->back()->with('msg_user_list', Lang::get('Delete ').$request["current_user_email_delete"].Lang::get(' successfully !!!'))->with('msg_type_user_list', 'danger');
        }

        if ($request["current_user_activate"] != null){

            $current_user = UserInfo::where("user_email",$request["current_user_activate"]);

            $user = $current_user->first();

            $user["user_active"] = true;

            $user->save();

            return redirect()->back()->with('msg_user_list', Lang::get('Activated ').$request["current_user_activate"].Lang::get(' successfully !!!'))->with('msg_type_user_list', 'success');
        }
        elseif ($request["current_user_deactivate"] != null){

            $current_user = UserInfo::where("user_email",$request["current_user_deactivate"]);

            $user = $current_user->first();

            $user["user_active"] = false;

            $user->save();

            return redirect()->back()->with('msg_user_list', Lang::get('Deactivated ').$request["current_user_deactivate"].Lang::get(' successfully !!!'))->with('msg_type_user_list', 'danger');
        }

        $current_user = UserInfo::where("user_email",$request["current_user_email"])->first();

        $request->session()->put("current_user",$current_user);

        return redirect('edit-other-profile');

    }

    public function edit_other_profile(Request $request) {

        /* Get language options */

        Lang::setLocale($request->session()->get('1752051_user')["user_lang"]);

        $lang_db = LanguageInfo::all();

        $permission_db = PermissionInfo::all();

        $current_page = "user-list";
        return view('edit-other-profile', compact("current_page", "lang_db", "permission_db"));

    }

    public function permission(Request $request){

        /* Prepare user session */

        if ($this->prepare_user_session($request) != null) {
            return $this->prepare_user_session($request);
        }

        /* Get language options */

        $lang_db = LanguageInfo::all();

        /* Get other options */

        $permission_db = PermissionInfo::where("permission_role", "!=", "Super Admin")->where("permission_role", "!=", "Newcomer")->get();

        $current_page = "permission";
        return view('permission', compact("current_page", "lang_db", "permission_db"));
    }

    public function user_list(Request $request){

        /* Prepare user session */

        if ($this->prepare_user_session($request) != null) {
            return $this->prepare_user_session($request);
        }

        /* Get language options */

        $lang_db = LanguageInfo::all();

        /* Get other options */

        $user_list = UserInfo::paginate(6);

        $current_page = "user-list";

        return view('user-list', compact("current_page", "lang_db", "user_list"));
    }

    public function find_profile(Request $request){

        /* Prepare user session */

        if ($this->prepare_user_session($request) != null) {
            return $this->prepare_user_session($request);
        }

        /* Get language options */

        $lang_db = LanguageInfo::all();

        /* Get other options */

        $request->session()->put("search-button-type", $request["type"]);

        $this->search = $request["search"];

        if ($request["type"] == 1) {
            $user_list = UserInfo::where("user_active", true)
                                ->where(function($q) {
                                    $q->where("user_role", 'like', '%'.$this->search.'%' )
                                        ->orWhere("user_fullname", 'like', '%'.$this->search.'%' )
                                        ->orWhere("user_address", 'like', '%'.$this->search.'%' )
                                        ->orWhere("user_email", 'like', '%'.$this->search.'%' )
                                        ->orWhere("user_mobile", 'like', '%'.$this->search.'%' )
                                        ->orWhere("user_about", 'like', '%'.$this->search.'%' );
                                })
                                ->paginate(6);
        }
        else if ($request["type"] == 2) {
            $user_list = UserInfo::where("user_active", false)
                                    ->where(function($q) {
                                        $q->where("user_role", 'like', '%'.$this->search.'%' )
                                            ->orWhere("user_fullname", 'like', '%'.$this->search.'%' )
                                            ->orWhere("user_address", 'like', '%'.$this->search.'%' )
                                            ->orWhere("user_email", 'like', '%'.$this->search.'%' )
                                            ->orWhere("user_mobile", 'like', '%'.$this->search.'%' )
                                            ->orWhere("user_about", 'like', '%'.$this->search.'%' );
                                    })
                                    ->paginate(6);
        }
        else{

            $user_list = UserInfo::orWhere("user_role", 'like', '%'.$this->search.'%' )
                                ->orWhere("user_fullname", 'like', '%'.$this->search.'%' )
                                ->orWhere("user_address", 'like', '%'.$this->search.'%' )
                                ->orWhere("user_email", 'like', '%'.$this->search.'%' )
                                ->orWhere("user_mobile", 'like', '%'.$this->search.'%' )
                                ->orWhere("user_about", 'like', '%'.$this->search.'%' )
                                ->paginate(6);
        }

        $current_page = "user-list";
        $search = $this->search;

        return view('user-list', compact("current_page", "lang_db", "user_list", "search"));
    }

    public function sign_in(Request $request){

        Lang::setLocale($request->cookie('1752051_user_lang'));

        /* Get language options */

        $lang_db = LanguageInfo::all();

        return view("sign-in", compact('lang_db'));
    }

    public function forgot_password(Request $request){
//        echo $request->cookie('1752051_user_remember');

        Lang::setLocale($request->cookie('1752051_user_lang'));

        /* Get language options */

        $lang_db = LanguageInfo::all();

        return view("forgot-password", compact('lang_db'));
    }

    public function sign_out(Request $request){
//        echo $request->cookie('1752051_user_remember');

        $cookie = cookie()->forget('1752051_user_remember');

        $user_db = UserInfo::where('user_id', $request->session()->get('1752051_user')["user_id"])->first();

        $user_db["user_remember_token"] = $request->session()->get('1752051_user')["user_id"];

        $user_db->save();

        $request->session()->flush();

        return response()->redirectTo("sign-in")->withCookie($cookie);
    }

    public function sign_up(Request $request){

        Lang::setLocale($request->cookie('1752051_user_lang'));

        /* Get language options */

        $lang_db = LanguageInfo::all();

        return view("sign-up", compact('lang_db'));
    }

    /* Set Lock Screen */

    public function set_lockscreen(Request $request){

        $request->session()->put("1752051_user_timeout",true);

        echo "Success";

    }

    /* ChatBot */

    public function chatbot(Request $request){

        echo $request["user_fullname"]." --- ".$request["user_message"]." --- ".$request["user_datetime"]." --- ".$request["user_timestamp"];

    }

    /* Get Full Report */

    public function full_report(Request $request){

        /* Prepare user session */

        if ($this->prepare_user_session($request) != null) {
            return $this->prepare_user_session($request);
        }

        /* Get language options */

        $lang_db = LanguageInfo::all();

        if ($request["building"] != null && $request["floor"] != null && $request["room"] != null){

            return $this->send_response([RoomInfo::where("room_building",$request["building"])->where("room_floor",$request["floor"])->where("room_name",$request["room"])->first()], Lang::get('Successfully sent !!!'));

        }
        else if ($request["building"] != null && $request["floor"] != null){

            return $this->send_response(RoomInfo::where("room_building",$request["building"])->where("room_floor",$request["floor"])->get(), Lang::get('Successfully sent !!!'));

        }
        else if ($request["building"] != null){

            return $this->send_response(RoomInfo::where("room_building",$request["building"])->get(), Lang::get('Successfully sent !!!'));

        }
        else{

            $sensor_db = SensorInfo::get();

            $device_db = DeviceInfo::get();

            return view("full-report", compact('lang_db', 'sensor_db', 'device_db'));

        }

    }

    /* Secret View */

    /* Confirm Information */

    public function confirm_information(Request $request){

        Lang::setLocale($request->cookie('1752051_user_lang'));

        $validator = Validator::make($request->all(), [
            'user_confirmation_code' => 'exists:user'
        ],
            [
                'user_confirmation_code.exists' => Lang::get('Link Is Expired !!! Please Contact Us For More Information: 0888315899')
            ]);

        if ($validator->fails()) {
            return redirect('sign-in')
                ->withErrors($validator)
                ->withInput();
        }

        $current_user = UserInfo::where("user_confirmation_code",$request["user_confirmation_code"])->get();
        if (count($current_user) > 0){
            $current_user = $current_user->first();
            $current_user["user_email"] = $request["user_email"];
            $current_user["user_confirmation_code"] = null;
            $current_user["user_active"] = true;
            $current_user->save();

            return redirect('sign-in')
                ->withErrors([Lang::get("Now you can sign in with your new email !!!")])
                ->withInput();
        }
        else{
            return redirect('sign-in')
                ->withErrors($validator)
                ->withInput();
        }
    }

}
