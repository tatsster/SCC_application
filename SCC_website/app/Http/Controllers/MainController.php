<?php


namespace App\Http\Controllers;

use App\InstructionInfo;
use App\FormInfo;
use App\ContactInfo;
use App\Mail\EmailSendEmailSuccess;
use App\Mail\EmailResetPassword;
use App\NewsInfo;
use App\BrandInfo;
use App\AttributeInfo;
use App\LanguageInfo;
use App\UserInfo;
use App\SettingsInfo;
use App\PermissionInfo;
use App\BuildingInfo;
use App\FloorInfo;
use App\RoomInfo;
use App\DeviceInfo;
use App\SensorInfo;
use App\SensorLogInfo;
Use Illuminate\Http\Request;
Use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Cookie\CookieJar;
use Illuminate\Validation\Rule;
use Ixudra\Curl\Facades\Curl;
use Carbon\Carbon;
use Symfony\Component\Process\Process;

class MainController extends Controller {

    /* Redirect to view */

    public function dashboard(Request $request){

        /* Set the language user choose */

        $user_db = UserInfo::where('user_id', $request->session()->get('1752051_user')["user_id"])->get();

        if (!(count($user_db) > 0)) {
            return view('sign-in');
        }

        $user_db = $user_db->first();

        $user_role = PermissionInfo::where("permission_role", $user_db['user_role'])->first();

        $request->session()->put("1752051_user",$user_db);

        $request->session()->put("1752051_user_role",$user_role);

        Lang::setLocale($request->session()->get('1752051_user')["user_lang"]);

        /* Get language options */

        $lang_db = LanguageInfo::all();

        /* Calculate hours usage and electrical usage */

        $enum = array(
            "device_kwh" => 4,
        );

        $device_log_db = DB::table('device')
                            ->join('device_log', 'device.device_id', '=', 'device_log.device_id')
                            ->get();

        $hours_usage = 0;
        $electrical_consumption = 0;
        $current_timestamp = 0;

        foreach($device_log_db as $device_log_each){
            if ($device_log_each->device_status == true){
                $current_timestamp = $device_log_each->device_timestamp;
            }
            else{
                $past_hours = ($device_log_each->device_timestamp - $current_timestamp) / 3600;
                $hours_usage += $past_hours;

                $device_kwh = floatval(explode(",",str_replace("[","",str_replace("[","",$device_log_each->device_additional)))[$enum["device_kwh"]]);
                $electrical_consumption +=  $past_hours * $device_kwh;
                $current_timestamp = 0;
            }
        }

        $hours_usage = round($hours_usage);
        $electrical_consumption = round($electrical_consumption,2);

        $current_page = "dashboard";

        return view("dashboard",compact("current_page","hours_usage","electrical_consumption","lang_db"));
    }

    public function report(Request $request){

        $user_db = UserInfo::where('user_id', $request->session()->get('1752051_user')["user_id"])->get();

        if (!(count($user_db) > 0)) {
            return view('sign-in');
        }

        $user_db = $user_db->first();

        $user_role = PermissionInfo::where("permission_role", $user_db['user_role'])->first();

        $request->session()->put("1752051_user",$user_db);

        $request->session()->put("1752051_user_role",$user_role);

        Lang::setLocale($request->session()->get('1752051_user')["user_lang"]);

        /* Get language options */

        $lang_db = LanguageInfo::all();

        $building_db = BuildingInfo::all();

        $floor_db = FloorInfo::all();

        $current_page = "report";
        return view("report",compact("current_page", "lang_db", "building_db", "floor_db"));
    }

//    public function report_floor(Request $request){
//        $current_page = "report";
//        return view("report-floor",compact("current_page"));
//    }
//
    public function room(Request $request){

        /* Set the language user choose */

        $user_db = UserInfo::where('user_id', $request->session()->get('1752051_user')["user_id"])->get();

        if (!(count($user_db) > 0)) {
            return view('sign-in');
        }

        $user_db = $user_db->first();

        $user_role = PermissionInfo::where("permission_role", $user_db['user_role'])->first();

        $request->session()->put("1752051_user",$user_db);

        $request->session()->put("1752051_user_role",$user_role);

        Lang::setLocale($request->session()->get('1752051_user')["user_lang"]);

        /* Get language options */

        $lang_db = LanguageInfo::all();

        $device_db = DeviceInfo::where("device_building_name",$request->session()->get("1752051_room_building"))->where("device_floor_name",$request->session()->get("1752051_room_floor"))->where("device_room_name",$request->session()->get("1752051_room_name"))->get();

        $sensor_db = SensorInfo::where("sensor_building_name",$request->session()->get("1752051_room_building"))->where("sensor_floor_name",$request->session()->get("1752051_room_floor"))->where("sensor_room_name",$request->session()->get("1752051_room_name"))->get();

        $current_page = "report";
        return view("room",compact("current_page", "lang_db", "sensor_db" , "device_db"));
    }
//
//    public function report_device(Request $request){
//        $current_page = "report";
//        return view("report-device",compact("current_page"));
//    }
//
//    public function report_sensor(Request $request){
//        $current_page = "report";
//        return view("report-sensor",compact("current_page"));
//    }

    public function settings(Request $request){

        /* Set the language user choose */

        $user_db = UserInfo::where('user_id', $request->session()->get('1752051_user')["user_id"])->get();

        if (!(count($user_db) > 0)) {
            return view('sign-in');
        }

        $user_db = $user_db->first();

        $user_role = PermissionInfo::where("permission_role", $user_db['user_role'])->first();

        $request->session()->put("1752051_user",$user_db);

        $request->session()->put("1752051_user_role",$user_role);

        Lang::setLocale($request->session()->get('1752051_user')["user_lang"]);

        /* Get language options */

        $lang_db = LanguageInfo::all();

        $settings_db = SettingsInfo::all();

        $settings_array = [];

        foreach ($settings_db as $settings_each){
            $settings_array[$settings_each->settings_name] = $settings_each->settings_value;
        }

        $current_page = "settings";
        return view("settings",compact("current_page","lang_db","settings_array"));
    }

    public function add_profile(Request $request){

        /* Set the language user choose */

        $user_db = UserInfo::where('user_id', $request->session()->get('1752051_user')["user_id"])->get();

        if (!(count($user_db) > 0)) {
            return view('sign-in');
        }

        $user_db = $user_db->first();

        $user_role = PermissionInfo::where("permission_role", $user_db['user_role'])->first();

        $request->session()->put("1752051_user",$user_db);

        $request->session()->put("1752051_user_role",$user_role);

        Lang::setLocale($request->session()->get('1752051_user')["user_lang"]);

        /* Get language options */

        $lang_db = LanguageInfo::all();

        $current_page = "profile";
        return view('profile', compact("current_page", "lang_db"));
    }

    public function profile(Request $request){

        /* Set the language user choose */

        $user_db = UserInfo::where('user_id', $request->session()->get('1752051_user')["user_id"])->get();

        if (!(count($user_db) > 0)) {
            return view('sign-in');
        }

        $user_db = $user_db->first();

        $user_role = PermissionInfo::where("permission_role", $user_db['user_role'])->first();

        $request->session()->put("1752051_user",$user_db);

        $request->session()->put("1752051_user_role",$user_role);

        Lang::setLocale($request->session()->get('1752051_user')["user_lang"]);

        /* Get language options */

        $lang_db = LanguageInfo::all();

        $current_page = "profile";
        return view('profile', compact("current_page", "lang_db"));
    }

    public function permission(Request $request){

        /* Set the language user choose */

        $user_db = UserInfo::where('user_id', $request->session()->get('1752051_user')["user_id"])->get();

        if (!(count($user_db) > 0)) {
            return view('sign-in');
        }

        $user_db = $user_db->first();

        $user_role = PermissionInfo::where("permission_role", $user_db['user_role'])->first();

        $request->session()->put("1752051_user",$user_db);

        $request->session()->put("1752051_user_role",$user_role);

        Lang::setLocale($request->session()->get('1752051_user')["user_lang"]);

        /* Get language options */

        $lang_db = LanguageInfo::all();

        $permission_db = PermissionInfo::where("permission_role", "!=", "Super Admin")->get();

        $current_page = "permission";
        return view('permission', compact("current_page", "lang_db", "permission_db"));
    }

    public function user_list(Request $request){

        /* Set the language user choose */

        $user_db = UserInfo::where('user_id', $request->session()->get('1752051_user')["user_id"])->get();

        if (!(count($user_db) > 0)) {
            return view('sign-in');
        }

        $user_db = $user_db->first();

        $user_list = UserInfo::paginate(6);

        $user_role = PermissionInfo::where("permission_role", $user_db['user_role'])->first();

        $request->session()->put("1752051_user",$user_db);

        $request->session()->put("1752051_user_role",$user_role);

        Lang::setLocale($request->session()->get('1752051_user')["user_lang"]);

        /* Get language options */

        $lang_db = LanguageInfo::all();

        $current_page = "user-list";

        return view('user-list', compact("current_page", "lang_db", "user_list"));
    }

    public function sign_in(Request $request){
        if ($request["locale"] == "vn"){
            Lang::setLocale("vn");
        }
        return view("sign-in");
    }

    public function sign_out(Request $request){
        $request->session()->put("1752051_user","");

        return view("sign-in");
    }

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

    private function getToken($length)
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

    public function sendResponse($result, $message){
        $response = [
            'success' => true,
            'data' => $result,
            'message' => $message,
        ];
        return response()->json($response, 200);
    }

    public function sendError($error, $errorMessages = [], $code = 404) {
        $response = [
            'success' => false,
            'data' => '',
            'message' => $error,
        ];
        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $code);
    }

    /* Sign in the system */

    public function send_sign_in(Request $request, Response $response){

        $this->pwd = md5($request["user_password"]);

        $validator = Validator::make($request->all(), [
            'user_password' => 'required',
            'user_email' => 'required',
            'user_email' => [
                Rule::exists('user')->where(function ($query) {
                    $query->where('user_password', $this->pwd);
                })]
        ],
            [
                'user_password.required' => 'Vui Lòng Nhập Mật Khẩu',
                'user_email.required' => 'Vui Lòng Nhập Địa Chỉ Email',
                'user_email.exists' => 'Địa Chỉ Email Không Chính Xác / Chưa Xác Nhận Tài Khoản / Mật Khẩu Không Chính Xác'
            ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user_db = UserInfo::where("user_password", md5($request["user_password"]))->where("user_email", $request["user_email"])->first();

        if ($request["user_remember"] == 1){
            $remember_token = $this->getToken(21);
            $user_db["user_remember_token"] = $remember_token;
            $user_db->save();

            $response->withCookie(Cookie::make('1752051_user_remember', $remember_token, 45000));
        }

        $user_role = PermissionInfo::where("permission_role", $user_db['user_role'])->first();

        unset($user_db['user_password']);
        unset($user_db['user_login_attempt']);
        unset($user_db['user_remember_token']);

        $request->session()->put("1752051_user",$user_db);

        $request->session()->put("1752051_user_role",$user_role);

        return $this->dashboard($request);

    }

    /* Change language */

    public function change_language(Request $request){

        $user_db = UserInfo::where("user_id", $request->session()->get("1752051_user")["user_id"])->where("user_email", $request->session()->get("1752051_user")["user_email"])->first();

        $user_db["user_lang"] = $request["user_lang"];
        $user_db->save();

        $request->session()->put("1752051_user",$user_db);

        echo "Success";

    }

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
            echo $this->sendError("Đã có lỗi xảy ra !!!", $validator->errors());
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
            echo $this->sendError("Đã có lỗi xảy ra !!!", $validator->errors());
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

    /* Get real time temperature */

    public function get_real_time_temp(Request $request){

    }

    /* Choose role to edit */

    public function choose_role(Request $request){

        $permission_db = PermissionInfo::where("permission_role",$request["permission_role"])->first();

        $request->session()->put("1752051_current_role",$permission_db);

        echo "Success";

    }

    /* Create role */

    public function create_role(Request $request){

        $validator = Validator::make($request->all(), [
            'permission_role' => 'unique:permission'
        ],
            [
                'permission_role.unique' => Lang::get('This role had already existed !!!')
            ]);

        if ($validator->fails()) {
//            echo $this->sendError("Đã có lỗi xảy ra !!!", $validator->errors());
            abort(400);
        }
        else {
            $permission_db = new PermissionInfo();
            $permission_db["permission_role"] = $request["permission_role"];

            $permission_db->save();

            $permission_db = PermissionInfo::where("permission_role",$request["permission_role"])->first();

            $request->session()->put("1752051_current_role",$permission_db);

            echo "Success";
        }

    }

    /* Update or delete role */

    public function update_or_delete_role(Request $request){

        Lang::setLocale($request->session()->get('1752051_user')["user_lang"]);

        if ($request["btn-delete"] == "1"){

            PermissionInfo::where("permission_role",$request->session()->get("1752051_current_role")["permission_role"])->delete();

            $request->session()->forget("1752051_current_role");

            return redirect()->back()->with('msg_permission', Lang::get('Delete successfully !!!'))->with('msg_type_permission', 'danger');

        }
        else {
            $permission_db = PermissionInfo::where("permission_role",$request->session()->get("1752051_current_role")["permission_role"])->first();

            if ($request["permission_role"] != $request->session()->get("1752051_current_role")["permission_role"]) {

                $validator = Validator::make($request->all(), [
                    'permission_role' => 'unique:permission'
                ],
                    [
                        'permission_role.unique' => Lang::get('This role had already existed !!!')
                    ]);

                if ($validator->fails()) {

                    return redirect()->back()->with('msg_permission', Lang::get('This role name had already existed !!!'))->with('msg_type_permission', 'danger');

                }

                $permission_db["permission_role"] = $request["permission_role"];

            }

            $permission_array = $permission_db->toArray();

            unset($permission_array["permission_id"]);
            unset($permission_array["permission_role"]);

            $permission_values = array_values($permission_array);
            $permission_keys = array_keys($permission_array);

            for($i = 0; $i < count($permission_values); $i++){

                if ($request[$permission_keys[$i]] != null){
                    $permission_db[$permission_keys[$i]] = true;
                }
                else{
                    $permission_db[$permission_keys[$i]] = false;
                }

            }

            $permission_db->save();

            $permission_db = PermissionInfo::where("permission_role",$request["permission_role"])->first();

            $request->session()->put("1752051_current_role",$permission_db);

            return redirect()->back()->with('msg_permission', Lang::get('Successfully updated !!!'))->with('msg_type_permission', 'success');
        }

    }

    /* Update profile information */

    public function update_profile(Request $request){

        Lang::setLocale($request->session()->get('1752051_user')["user_lang"]);

        $user = $request->session()->get("1752051_user");

        $user_db = UserInfo::where('user_id', $user["user_id"])->get();

        if (count($user_db) > 0){
            $currentUser = $user_db->first();
            $email = $request["user_email"];
            $password = md5($request["user_password"]);
            $check_empty = true;

            if ($currentUser["user_fullname"] != $request["user_fullname"] && $request["user_fullname"] != ""){

                $validator = Validator::make($request->all(), [
                    'user_fullname' => 'min:5|max:255'
                ],
                    [
                        'user_fullname.max' => Lang::get('Full Name Only Allows Maximum 255 Characters'),
                        'user_fullname.min' => Lang::get('Full Name Needs At least 5 Characters'),
                    ]);

                if ($validator->fails()) {
                    return redirect()->back()->with('msg_profile', Lang::get('Full Name Only Allows minimum 5 and maximum 255 Characters'))->with('msg_type_profile', 'danger');
                }

                $currentUser["user_fullname"] = $request["user_fullname"];
                $check_empty = false;
            }

            if ($currentUser["user_email"] != $request["user_email"] && $request["user_email"] != ""){

                $validator = Validator::make($request->all(), [
                    'user_email' => 'unique:user'
                ],
                [
                    'user_email.unique' => Lang::get('Email Address Already Exists, Please Choose Another Address')
                ]);

                if ($validator->fails()) {
                    return redirect()->back()->with('msg_profile', Lang::get('Email Address Already Exists, Please Choose Another Address'))->with('msg_type_profile', 'danger');
                }

                try {
                    Mail::to($request["user_email"])->send(new EmailSendEmailSuccess(Lang::get("Email For Checking Personal Information"),$user["user_fullname"]));
                } catch ( \Exception $e ) {
                    return redirect()->back()->with('msg_profile', strval($e))->with('msg_type_profile', 'danger');
//                    return redirect()->back()->with('msg_profile', Lang::get('Email Address Cannot Be Sent, Please Choose Another Address'))->with('msg_type_profile', 'danger');
                }

                $currentUser["user_email"] = $request["user_email"];
                $check_empty = false;
            }
            else
                $email = $currentUser["admin_email"];

            if ($currentUser["user_password"] != md5($request["user_password"]) && $request["user_password"] != ""){

                $validator = Validator::make($request->all(), [
                    'user_password' => 'min:3|max:255|confirmed'
                ],
                [
                    'user_password.max' => Lang::get('Password Only Allows Maximum 255 Characters'),
                    'user_password.min' => Lang::get('Password Need At least 3 Characters'),
                    'user_password.confirmed' => Lang::get('Confirmed Password Wrong')
                ]);

                if ($validator->fails()) {
                    return redirect()->back()->with('msg_profile', Lang::get('Password Need At least 3 Characters / Password Only Allows Maximum 255 Characters / Confirmed Password Wrong'))->with('msg_type_profile', 'danger');
                }

                $currentUser["user_password"] = md5($request["user_password"]);
                $check_empty = false;
            }
            else
                $password = $currentUser["user_password"];

            if ($currentUser["user_address"] != $request["user_address"] && $request["user_address"] != ""){

                $validator = Validator::make($request->all(), [
                    'user_address' => 'max:255'
                ],
                    [
                        'user_address.max' => Lang::get('Address Only Allows Maximum 255 Characters')
                    ]);

                if ($validator->fails()) {
                    return redirect()->back()->with('msg_profile', Lang::get('Address Only Allows Maximum 255 Characters'))->with('msg_type_profile', 'danger');
                }

                $currentUser["user_address"] = $request["user_address"];
                $check_empty = false;
            }

            if ($currentUser["user_about"] != $request["user_about"] && $request["user_about"] != ""){

                $validator = Validator::make($request->all(), [
                    'user_about' => 'max:255'
                ],
                    [
                        'user_about.max' => Lang::get('About Only Allows Maximum 255 Characters')
                    ]);

                if ($validator->fails()) {
                    return redirect()->back()->with('msg_profile', Lang::get('About Only Allows Maximum 255 Characters'))->with('msg_type_profile', 'danger');
                }

                $currentUser["user_about"] = $request["user_about"];
                $check_empty = false;
            }

            if ($currentUser["user_mobile"] != $request["user_mobile"] && $request["user_mobile"] != ""){

                $validator = Validator::make($request->all(), [
                    'user_mobile' => 'max:20'
                ],
                    [
                        'user_mobile.max' => Lang::get('Mobile Only Allows Maximum 20 Characters'),
                    ]);

                if ($validator->fails()) {
                    return redirect()->back()->with('msg_profile', Lang::get('Mobile Only Allows Maximum 20 Characters'))->with('msg_type_profile', 'danger');
                }

                $currentUser["user_mobile"] = $request["user_mobile"];
                $check_empty = false;
            }

            if ($check_empty)
                return redirect()->back()->with('msg_profile', 'Không có gì thay đổi !!!')->with('msg_type_profile', 'success');
            else {

                if ($request["user_password"] != ""){
                    $currentUser->save();

                    $user_db = UserInfo::where('user_id', $user["user_id"])->get();
                    $currentUser = $user_db->first();

                    $request->session()->forget('1752051_user');

                    return redirect("sign-in")
                        ->withErrors([Lang::get('Please sign in with new password !!!')])
                        ->withInput();
                }
                else{
                    $currentUser->save();

                    $user_db = UserInfo::where('user_id', $user["user_id"])->get();
                    $currentUser = $user_db->first();

                    $request->session()->put('1752051_user',$currentUser);
                }

                return redirect()->back()->with('msg_profile', Lang::get('Successfully updated !!!'))->with('msg_type_profile', 'success');
            }
        } else {
            return redirect()->back()->with('msg_profile', Lang::get('Fail to update !!!'))->with('msg_type_profile', 'danger');
        }
    }

    /* Update profile avatar */

    public function update_profile_avatar(Request $request){

        Lang::setLocale($request->session()->get('1752051_user')["user_lang"]);

        $user= $request->session()->get("1752051_user");

        $user_db = UserInfo::where('user_id', $user["user_id"])->get();

        if (count($user_db) > 0 && $request->file('user_avatar') != ""){
            $currentUser = $user_db->first();
            $error = "";
            $current_path = str_replace("../","",$currentUser["admin_avatar"]);

            if(File::exists($current_path)) {
                File::delete($current_path);
            }

            if($request->file('user_avatar')) {
                $allowedMimeTypes = ['image/jpeg', 'image/gif', 'image/png', 'image/bmp', 'image/svg+xml'];
                $contentType = $request->file('user_avatar')->getClientMimeType();

                if (in_array($contentType, $allowedMimeTypes)) {

                    $realType = explode("/",$request->file('user_avatar')->getClientMimeType());
                    $realType = explode("+",$realType[1])[0];

                    $path = '../assets/users/avatar/'.$user["user_id"].'.'.$realType;
                    $request->file('user_avatar')->storeAs('assets/users/avatar/', $user["user_id"].'.'.$realType, ['disk' => 'public_element']);
                    $currentUser["user_avatar"] = $path;
                }
                else
                    $error = Lang::get('Không Đúng Định Dạng File Ảnh !!!');
            }

            if ($error != ""){
                return redirect()->back()->with('msg_profile', $error)->with('msg_type_profile', 'danger');
            }
            else {
                $currentUser->save();

                $user_db = UserInfo::where('user_email', $currentUser["user_email"])->where('user_password', $currentUser["user_password"])->get();
                $currentUser = $user_db->first();
                $request->session()->put('1752051_user',$currentUser);
                return redirect()->back()->with('msg_profile', Lang::get('Successfully updated !!!'))->with('msg_type_profile', 'success');
            }
        } else {
            return redirect()->back()->with('msg_profile', Lang::get('Fail to update !!!'))->with('msg_type_profile', 'danger');
        }
    }

    /* Create building */

    public function create_building(Request $request){

        $building = BuildingInfo::where("building_name",$request["building"])->get();

        $floor = FloorInfo::where("floor_building",$request["building"])->where("floor_name",$request["floor"])->get();

        $room = RoomInfo::where("room_building",$request["building"])->where("room_floor",$request["floor"])->where("room_name",$request["room"])->get();

        if (count($building) > 0 && count($floor) > 0 && count($room) > 0) {
//            echo $this->sendError("Đã có lỗi xảy ra !!!", $validator->errors());
            abort(400);
        }
        else {

            $building = new BuildingInfo();

            $building["building_name"] = $request["building"];
            $building->save();

            $request->session()->put("1752051_current_building",$request["building"]);

            $floor = new FloorInfo();

            $floor["floor_building"] = $request["building"];
            $floor["floor_name"] = $request["floor"];
            $floor->save();

            $room= new RoomInfo();

            $room["room_building"] = $request["building"];
            $room["room_floor"] = $request["floor"];
            $room["room_name"] = $request["room"];
            $room->save();

            $current_building = array(
                "building" => $request["building"]
            );

            $floor = FloorInfo::where("floor_building",$request["building"])->get();

            foreach($floor as $each_floor){

                $room_array = [];

                $room = RoomInfo::where("room_building",$request["building"])->where("room_floor",$each_floor["floor_name"])->get();

                foreach($room as $each_room){

                    array_push($room_array,$each_room["room_name"]);

                }

                $current_building[$each_floor["floor_name"]] = $room_array;

            }

            $request->session()->put("1752051_current_building",$current_building);

            echo "Success";

        }

    }

    /* Choose building to edit */

    public function choose_building(Request $request){

        $current_building = array(
            "building" => $request["building"]
        );

        $floor = FloorInfo::where("floor_building",$request["building"])->get();

        foreach($floor as $each_floor){

            $room_array = [];

            $room = RoomInfo::where("room_building",$request["building"])->where("room_floor",$each_floor["floor_name"])->get();

            foreach($room as $each_room){

                array_push($room_array,$each_room["room_name"]);

            }

            $current_building[$each_floor["floor_name"]] = $room_array;

        }

        $request->session()->put("1752051_current_building",$current_building);

        echo $request["building"];

    }

    /* Choose room to edit */

    public function choose_room(Request $request){

        $request->session()->put("1752051_room_building",$request["building"]);

        $request->session()->put("1752051_room_floor",$request["floor"]);

        $request->session()->put("1752051_room_name",$request["room"]);

        echo "Success";

    }

    /* Create sensor */

    public function create_sensor(Request $request){

        $validator = Validator::make($request->all(), [
            'sensor_id' => 'required|unique:sensor|max:255',
            'sensor_name' => 'required|max:255',
            'sensor_ip' => 'required|max:255',
            'sensor_port' => 'required|max:255',
            'sensor_topic' => 'required|max:255',
            'sensor_username' => 'max:255',
            'sensor_password' => 'max:255',
        ],
            [
                'sensor_id.required' => Lang::get('You need to input sensor ID'),
                'sensor_id.unique' => Lang::get('This sensor ID had already existed'),
                'sensor_id.max' => Lang::get('Sensor ID has maximum 255 characters'),
                'sensor_name.required' => Lang::get('You need to input sensor name'),
                'sensor_name.max' => Lang::get('Sensor name has maximum 255 characters'),
                'sensor_ip.required' => Lang::get('You need to input MQTT IP'),
                'sensor_ip.max' => Lang::get('MQTT IP has maximum 255 characters'),
                'sensor_port.required' => Lang::get('You need to input MQTT port'),
                'sensor_port.max' => Lang::get('MQTT port has maximum 255 characters'),
                'sensor_topic.required' => Lang::get('You need to input MQTT topic'),
                'sensor_topic.max' => Lang::get('MQTT topic has maximum 255 characters'),
                'sensor_name.max' => Lang::get('MQTT username has maximum 255 characters'),
                'sensor_password.max' => Lang::get('MQTT password has maximum 255 characters'),
            ]);

        if ($validator->fails()) {

            $errors_array = $validator->errors()->toArray();

            $errors = "";
            $errors_values = array_values($errors_array);

            for($i = 0; $i < count($errors_values); $i++){

                $errors = $errors.$i."/ ".$errors_values[$i][0]."<br>";

            }

            return redirect()->back()->with('msg_room', $errors)->with('msg_type_room', 'danger');

        }

        $sensor = new SensorInfo();
        $sensor["sensor_floor_name"] = $request->session()->get("1752051_room_floor");
        $sensor["sensor_room_name"] = $request->session()->get("1752051_room_name");
        $sensor["sensor_building_name"] = $request->session()->get("1752051_room_building");
        $sensor["sensor_id"] = $request["sensor_id"];
        $sensor["sensor_name"] = $request["sensor_name"];
        $sensor["sensor_ip"] = $request["sensor_ip"];
        $sensor["sensor_port"] = $request["sensor_port"];
        $sensor["sensor_topic"] = $request["sensor_topic"];
        $sensor["sensor_username"] = $request["sensor_username"];
        $sensor["sensor_password"] = $request["sensor_password"];
        $sensor->save();

        $sensor = SensorInfo::where("sensor_id", $request["sensor_id"])->first();

        $sensor_log = SensorLogInfo::where("sensor_id", $request["sensor_id"])->orderBy('sensor_timestamp', 'DESC')->get();

        $request->session()->put("1752051_current_sensor",$sensor);

        $request->session()->put("1752051_current_sensor_log",$sensor_log);

        return redirect()->back()->with('msg_room', Lang::get("Successfully created !!!"))->with('msg_type_room', 'success');

    }

    /* Update sensor */

    public function update_sensor(Request $request){

        $validator = Validator::make($request->all(), [
            'sensor_id' => 'required|max:255',
            'sensor_name' => 'required|max:255',
            'sensor_ip' => 'required|max:255',
            'sensor_port' => 'required|max:255',
            'sensor_topic' => 'required|max:255',
            'sensor_username' => 'max:255',
            'sensor_password' => 'max:255',
        ],
            [
                'sensor_id.required' => Lang::get('You need to input sensor ID'),
                'sensor_id.max' => Lang::get('Sensor ID has maximum 255 characters'),
                'sensor_name.required' => Lang::get('You need to input sensor name'),
                'sensor_name.max' => Lang::get('Sensor name has maximum 255 characters'),
                'sensor_ip.required' => Lang::get('You need to input MQTT IP'),
                'sensor_ip.max' => Lang::get('MQTT IP has maximum 255 characters'),
                'sensor_port.required' => Lang::get('You need to input MQTT port'),
                'sensor_port.max' => Lang::get('MQTT port has maximum 255 characters'),
                'sensor_topic.required' => Lang::get('You need to input MQTT topic'),
                'sensor_topic.max' => Lang::get('MQTT topic has maximum 255 characters'),
                'sensor_name.max' => Lang::get('MQTT username has maximum 255 characters'),
                'sensor_password.max' => Lang::get('MQTT password has maximum 255 characters'),
            ]);

        if ($validator->fails()) {

            $errors_array = $validator->errors()->toArray();

            $errors = "";
            $errors_values = array_values($errors_array);

            for($i = 0; $i < count($errors_values); $i++){

                $errors = $errors.$i."/ ".$errors_values[$i][0]."<br>";

            }

            return redirect()->back()->with('msg_room', $errors)->with('msg_type_room', 'danger');

        }

        $sensor = SensorInfo::where("sensor_id", $request->session()->get("1752051_current_sensor")["sensor_id"])->first();
        $sensor["sensor_floor_name"] = $request->session()->get("1752051_room_floor");
        $sensor["sensor_room_name"] = $request->session()->get("1752051_room_name");
        $sensor["sensor_building_name"] = $request->session()->get("1752051_room_building");
        $sensor["sensor_id"] = $request["sensor_id"];
        $sensor["sensor_name"] = $request["sensor_name"];
        $sensor["sensor_ip"] = $request["sensor_ip"];
        $sensor["sensor_port"] = $request["sensor_port"];
        $sensor["sensor_topic"] = $request["sensor_topic"];
        $sensor["sensor_username"] = $request["sensor_username"];
        $sensor["sensor_password"] = $request["sensor_password"];
        $sensor->save();

        $sensor = SensorInfo::where("sensor_id", $request->session()->get("1752051_current_sensor")["sensor_id"])->first();

        $sensor_log = SensorLogInfo::where("sensor_id", $request->session()->get("1752051_current_sensor")["sensor_id"])->orderBy('sensor_timestamp', 'DESC')->get();

        $request->session()->put("1752051_current_sensor_log",$sensor_log);

        $request->session()->put("1752051_current_sensor",$sensor);

        return redirect()->back()->with('msg_room', Lang::get("Successfully updated !!!"))->with('msg_type_room', 'success');

    }

    /* Refresh sensor */

    public function refresh_sensor(Request $request){

        $sensor = SensorInfo::where("sensor_id", $request->session()->get("1752051_current_sensor")["sensor_id"])->first();

        $sensor_log = SensorLogInfo::where("sensor_id", $request->session()->get("1752051_current_sensor")["sensor_id"])->orderBy('sensor_timestamp', 'DESC')->get();

        $request->session()->put("1752051_current_sensor_log",$sensor_log);

        $request->session()->put("1752051_current_sensor",$sensor);

        return redirect()->back()->with('msg_room', Lang::get("Successfully updated !!!"))->with('msg_type_room', 'success');

    }

    /* Choose sensor */

    public function choose_sensor(Request $request){

        $sensor = SensorInfo::where("sensor_id", $request["sensor_id"])->first();

        $sensor_log = SensorLogInfo::where("sensor_id", $request["sensor_id"])->orderBy('sensor_timestamp', 'DESC')->get();

        $request->session()->put("1752051_current_sensor",$sensor);

        $request->session()->put("1752051_current_sensor_log",$sensor_log);

        echo "Success";

    }

    /* Run / Stop sensor */

    public function run_stop_sensor(Request $request){

        if ($request["button"] == 1){

//            echo 2;

            $sensor = SensorInfo::where("sensor_id", $request->session()->get("1752051_current_sensor")["sensor_id"])->first();

            $process = new Process('kill -9 '.$sensor["sensor_pid"]);

            $process->run();

            $sensor["sensor_pid"] = null;

            $sensor->save();

            $sensor_log = SensorLogInfo::where("sensor_id", $request->session()->get("1752051_current_sensor")["sensor_id"])->orderBy('sensor_timestamp', 'DESC')->get();

            $request->session()->put("1752051_current_sensor",$sensor);

            $request->session()->put("1752051_current_sensor_log",$sensor_log);

        }
        else {

//            echo 1;

            $process = new Process('python3 /Users/WhiteWolf21/Documents/Heroku/SCC/final/subscribe_temp_humid.py '.$request->session()->get("1752051_current_sensor")["sensor_username"].' '.$request->session()->get("1752051_current_sensor")["sensor_password"].' '.$request->session()->get("1752051_current_sensor")["sensor_ip"].' '.$request->session()->get("1752051_current_sensor")["sensor_port"].' '.$request->session()->get("1752051_current_sensor")["sensor_topic"].' '.$request->session()->get("1752051_current_sensor")["sensor_id"].' ');
            # python3 /Users/WhiteWolf21/Documents/Heroku/SCC/final/subscribe_temp_humid.py "BKvm2" "Hcmut_CSE_2020" "13.76.250.158" "1883" "Topic/TempHumi" "TEMP-HUD100"

            $process->setTimeout(31557600);

//            $this->process->run();
//
//            // executes after the command finishes
//            if (!$this->process->isSuccessful()) {
//                throw new ProcessFailedException($this->process);
//            }

            $process->start();

            while ($process->isRunning()) {
                // waiting for process to finish

                $sensor = SensorInfo::where("sensor_id", $request->session()->get("1752051_current_sensor")["sensor_id"])->first();

                $sensor["sensor_pid"] = $process->getPid();

                $sensor->save();

                $sensor = SensorInfo::where("sensor_id", $request->session()->get("1752051_current_sensor")["sensor_id"])->first();

                $request->session()->put("1752051_current_sensor", $sensor);

            }

        }
    }

}
