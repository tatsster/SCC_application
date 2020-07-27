<?php


namespace App\Http\Controllers\API;
use App\BuildingInfo;
use App\DeviceInfo;
use App\DeviceLogInfo;
use App\FloorInfo;
use App\RoomInfo;
use App\ContactInfo;
use App\FormInfo;
use App\FormFoodInfo;
use App\Mail\EmailNotice;
use App\Mail\EmailFoodNotice;
use App\Mail\EmailSendEmailSuccess;
use App\Mail\EmailSignUp;
use App\PermissionInfo;
use App\SensorInfo;
use App\SensorLogInfo;
use App\UserInfo;
use Carbon\Carbon;
use Cocur\BackgroundProcess\BackgroundProcess;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use App\Schedules;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Ixudra\Curl\Facades\Curl;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class APIController extends Controller{

    protected $pwd;

    public function send_response($result, $message){
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

    private function get_token($length)
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

    public function query(Request $request){

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:user'
        ],
        [
            'user_id.required' => 'Vui Lòng Nhập ID Người Dùng',
            'user_id.exists' => 'ID Không Tồn Tại'
        ]);

        if ($validator->fails()) {
            return $this->send_error($validator->errors(), Lang::get("An error has occurred !!!"));
        }

        try {
            $query = DB::select($request["query"]);

            return $this->send_response($query, Lang::get('Successfully sent !!!'));
        } catch ( \Exception $e ) {
            return $this->send_error([$e], "Đã có lỗi xảy ra !!!");
        }
    }

    public function sign_in(Request $request){

        $this->pwd = md5($request["user_password"]);

        $validator = Validator::make($request->all(), [
            'user_email' => 'required|exists:user'
        ],
            [
                'user_email.required' => Lang::get('Please Input Email Address'),
                'user_email.exists' => Lang::get('Email Address Is Wrong / Not Exists')
            ]);

        if ($validator->fails()) {
//            $cookie = cookie()->forever('1752051_captcha', true);
            $errors = array_values($validator->errors()->toArray());
            return $this->send_error($errors[0], "An error has occurred !!!");
        }

        $validator = Validator::make($request->all(), [
            'user_password' => 'required',
            'user_email' => [
                Rule::exists('user')->where(function ($query) {
                    $query->where('user_password', $this->pwd);
                })]
        ],
            [
                'user_password.required' => Lang::get('Please Input Password'),
                'user_email.exists' => Lang::get('Password Is Wrong')
            ]);

        if ($validator->fails()) {

            $final_validator = $validator;

            $validator = Validator::make($request->all(), [
                'user_password' => 'required',
                'user_email' => [
                    Rule::exists('user')->where(function ($query) {
                        $query->where('user_temporary_password', $this->pwd);
                    })]
            ],
                [
                    'user_password.required' => Lang::get('Please Input Password'),
                    'user_email.exists' => Lang::get('Password Is Wrong')
                ]);

            if ($validator->fails()) {
//                $cookie = cookie()->forever('1752051_captcha', true);
                $errors = array_values($validator->errors()->toArray());
                return $this->send_error($errors[0], "An error has occurred !!!");
            }

        }

        $validator = Validator::make($request->all(), [
            'user_email' => [
                Rule::exists('user')->where(function ($query) {
                    $query->where('user_active', true);
                })]
        ],
            [
                'user_email.exists' => Lang::get('Account Is Not Activated Yet / Contact Us For Help: 0888315899')
            ]);

        if ($validator->fails()) {
//            $cookie = cookie()->forever('1752051_captcha', true);
            $errors = array_values($validator->errors()->toArray());
            return $this->send_error($errors[0], "An error has occurred !!!");
        }

//        if ($request->cookie('1752051_captcha') != null){
//
//            $validator = Validator::make($request->all(), [
//                'g-recaptcha-response' => 'required|captcha',
//            ],
//                [
//                    'g-recaptcha-response.required' => Lang::get('Please Do the Captcha Challenge !!!'),
//                    'g-recaptcha-response.captcha' => Lang::get('Challenge Failed !!!')
//                ]);
//
//            if ($validator->fails()) {
//                $cookie = cookie()->forever('1752051_captcha', true);
//                return redirect()
//                    ->back()
//                    ->withErrors($validator)
//                    ->withInput()
//                    ->withCookie($cookie);
//            }
//
//        }

//        $request->session()->forget("1752051_user_timeout");

//        $cookie_captcha = cookie()->forget('1752051_captcha');

        $user_db = UserInfo::where("user_email", $request["user_email"])->where("user_password", md5($request["user_password"]))->orWhere("user_temporary_password", md5($request["user_password"]))->first();

//        if ($request["user_remember"] == "on"){
//            $remember_token = parent::get_token(21);
//            $user_db["user_remember_token"] = $remember_token;
//            $user_db->save();
//
//            $user_role = PermissionInfo::where("permission_role", $user_db['user_role'])->first();
//
//            unset($user_db['user_password']);
//            unset($user_db['user_login_attempt']);
//            unset($user_db['user_remember_token']);
//
//            $request->session()->put("1752051_user",$user_db);
//
//            $request->session()->put("1752051_user_role",$user_role);
//
//            $cookie = cookie()->forever('1752051_user_remember', $remember_token);
//
//            $cookie_lang = cookie()->forever('1752051_user_lang',$user_db["user_lang"]);
//
//            return response()->redirectTo("dashboard")->withCookie($cookie)->withCookie($cookie_captcha)->withCookie($cookie_lang);
//        }

        $user_role = PermissionInfo::where("permission_role", $user_db['user_role'])->first();

        unset($user_db['user_password']);
        unset($user_db['user_remember_token']);
        unset($user_db['user_confirmation_code']);
        unset($user_db['user_temporary_password']);

//        $request->session()->put("1752051_user",$user_db);

//        $request->session()->put("1752051_user_role",$user_role);

        $return_data = [
            "user" => $user_db,
            "user_role" => $user_role
        ];

//        $cookie_lang = cookie()->forever('1752051_user_lang',$user_db["user_lang"]);

//        return redirect("dashboard")->withCookie($cookie_captcha)->withCookie($cookie_lang);

        return $this->send_response([$return_data], 'Successfully signed in !!!');
    }

    public function hours_usage_electrical_consumption(Request $request){
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

        $return_data = [
            "hours_usage" => $hours_usage,
            "electrical_consumption" => $electrical_consumption
        ];

        return $this->send_response([$return_data], 'Successfully query !!!');
    }

    public function update_profile(Request $request){

//        Lang::setLocale($request->session()->get('1752051_user')["user_lang"]);

//        $user = $request->session()->get("1752051_user");

        $user_db = UserInfo::where('user_id', $request["user_id"])->get();

        if (count($user_db) > 0){
            $current_user = $user_db->first();
//            $email = $request["user_email"];
//            $password = md5($request["user_password"]);
            $check_empty = true;

            if ($current_user["user_fullname"] != $request["user_fullname"] && $request["user_fullname"] != ""){

                $validator = Validator::make($request->all(), [
                    'user_fullname' => 'min:5|max:255'
                ],
                    [
                        'user_fullname.max' => Lang::get('Full Name Only Allows Maximum 255 Characters'),
                        'user_fullname.min' => Lang::get('Full Name Needs At least 5 Characters'),
                    ]);

                if ($validator->fails()) {
                    return $this->send_error([], Lang::get('Full Name Only Allows minimum 5 and maximum 255 Characters'));
                }

                $current_user["user_fullname"] = $request["user_fullname"];
                $check_empty = false;
            }

//            if ($current_user["user_email"] != $request["user_email"] && $request["user_email"] != ""){
//
//                $validator = Validator::make($request->all(), [
//                    'user_email' => 'unique:user'
//                ],
//                    [
//                        'user_email.unique' => Lang::get('Email Address Already Exists, Please Choose Another Address')
//                    ]);
//
//                if ($validator->fails()) {
//                    return redirect()->back()->with('msg_profile', Lang::get('Email Address Already Exists, Please Choose Another Address'))->with('msg_type_profile', 'danger');
//                }
//
//                try {
//                    $code = parent::get_token(17);
//                    Mail::to($request["user_email"])->send(new EmailSendEmailSuccess(Lang::get("Email For Checking Personal Information"),$user["user_fullname"],$code,$request["user_email"]));
//
//                } catch ( \Exception $e ) {
//                    return redirect()->back()->with('msg_profile', strval($e))->with('msg_type_profile', 'danger');
//                }
//
////                $current_user["user_email"] = $request["user_email"];
//                $current_user["user_confirmation_code"] = $code;
//                $current_user["user_active"] = false;
//                $check_empty = false;
//            }
//            else
//                $email = $current_user["admin_email"];

//            if ($current_user["user_password"] != md5($request["user_password"]) && $request["user_password"] != ""){
//
//                $validator = Validator::make($request->all(), [
//                    'user_password' => 'min:3'
//                ],
//                    [
//                        'user_password.min' => Lang::get('Password Need At least 3 Characters')
//                    ]);
//
//                if ($validator->fails()) {
//                    $errors = array_values($validator->errors()->messages());
//                    return redirect()->back()->with('msg_profile', Lang::get($errors[0][0]))->with('msg_type_profile', 'danger');
//                }
//
//                $validator = Validator::make($request->all(), [
//                    'user_password' => 'max:255'
//                ],
//                    [
//                        'user_password.max' => Lang::get('Password Only Allows Maximum 255 Characters')
//                    ]);
//
//                if ($validator->fails()) {
//                    $errors = array_values($validator->errors()->messages());
//                    return redirect()->back()->with('msg_profile', Lang::get($errors[0][0]))->with('msg_type_profile', 'danger');
//                }
//
//                $validator = Validator::make($request->all(), [
//                    'user_password' => 'confirmed'
//                ],
//                    [
//                        'user_password.confirmed' => Lang::get('Confirmed Password Wrong')
//                    ]);
//
//                if ($validator->fails()) {
//                    $errors = array_values($validator->errors()->messages());
//                    return redirect()->back()->with('msg_profile', Lang::get($errors[0][0]))->with('msg_type_profile', 'danger');
//                }
//
//                $current_user["user_password"] = md5($request["user_password"]);
//                $current_user["user_temporary_password"] = null;
//                $check_empty = false;
//            }
//            else
//                $password = $current_user["user_password"];

            if ($current_user["user_address"] != $request["user_address"] && $request["user_address"] != ""){

                $validator = Validator::make($request->all(), [
                    'user_address' => 'max:255'
                ],
                    [
                        'user_address.max' => Lang::get('Address Only Allows Maximum 255 Characters')
                    ]);

                if ($validator->fails()) {
                    return $this->send_error([], Lang::get('Address Only Allows Maximum 255 Characters'));
                }

                $current_user["user_address"] = $request["user_address"];
                $check_empty = false;
            }

//            if ($current_user["user_about"] != $request["user_about"] && $request["user_about"] != ""){
//
//                $validator = Validator::make($request->all(), [
//                    'user_about' => 'max:255'
//                ],
//                    [
//                        'user_about.max' => Lang::get('About Only Allows Maximum 255 Characters')
//                    ]);
//
//                if ($validator->fails()) {
//                    return redirect()->back()->with('msg_profile', Lang::get('About Only Allows Maximum 255 Characters'))->with('msg_type_profile', 'danger');
//                }
//
//                $current_user["user_about"] = $request["user_about"];
//                $check_empty = false;
//            }

            if ($current_user["user_mobile"] != $request["user_mobile"] && $request["user_mobile"] != ""){

                $validator = Validator::make($request->all(), [
                    'user_mobile' => 'max:20'
                ],
                    [
                        'user_mobile.max' => Lang::get('Mobile Only Allows Maximum 20 Characters')
                    ]);

                if ($validator->fails()) {
                    return $this->send_error([], Lang::get('Mobile Only Allows Maximum 20 Characters'));
                }

                $current_user["user_mobile"] = $request["user_mobile"];
                $check_empty = false;
            }

//            if ($current_user["user_session_timeout"] != $request["user_session_timeout"] && $request["user_session_timeout"] != ""){
//
//                $validator = Validator::make($request->all(), [
//                    'user_session_timeout' => 'numeric|not_in:0'
//                ],
//                    [
//                        'user_session_timeout.not_in' => Lang::get('Session Timeout Must Be Larger Than 0'),
//                        'user_session_timeout.numeric' => Lang::get('Session Timeout Must Be Numeric'),
//                    ]);
//
//                if ($validator->fails()) {
//                    $errors = array_values($validator->errors()->messages());
//                    $final_errors = "";
//                    foreach ($errors as $error){
//                        $final_errors = $final_errors.$error[0]."<br>";
//                    }
//                    return redirect()->back()->with('msg_profile', $final_errors)->with('msg_type_profile', 'danger');
//                }
//
//                $current_user["user_session_timeout"] = $request["user_session_timeout"];
//                $check_empty = false;
//            }

            if ($check_empty)
                return $this->send_response([], Lang::get('Nothing changes !!!'));
            else {

//                $notice = array();

//                if ($request["user_password"] != ""){
//                    array_push($notice, Lang::get('Please sign in with new password !!!'));
//                }
//
//                if ($request["user_email"] != ""){
//                    array_push($notice, Lang::get('Please confirm your new email to sign in !!!'));
//                }
//
//                if (!empty($notice)){
//                    $current_user->save();
//
//                    $user_db = UserInfo::where('user_id', $user["user_id"])->get();
//                    $current_user = $user_db->first();
//
//                    $request->session()->forget('1752051_user');
//
//                    return redirect("sign-in")
//                        ->withErrors($notice)
//                        ->withInput();
//                }
//                else{
                    $current_user->save();

                    $user_db = UserInfo::where('user_id', $request["user_id"])->get();
                    $current_user = $user_db->first();

//                    $request->session()->put('1752051_user',$current_user);
//                }

                unset($current_user['user_password']);
                unset($current_user['user_remember_token']);
                unset($current_user['user_confirmation_code']);
                unset($current_user['user_temporary_password']);

                return $this->send_response([$current_user], Lang::get('Successfully updated !!!'));
            }
        } else {
            return $this->send_error([], Lang::get('Fail to update !!!'));
        }
    }

    public function user_list(Request $request){

        $user_list = UserInfo::get();

        foreach ($user_list as $each){

            unset($each['user_password']);
            unset($each['user_remember_token']);
            unset($each['user_confirmation_code']);
            unset($each['user_temporary_password']);

        }

        return $this->send_response($user_list, Lang::get('Successfully updated !!!'));

    }

    public function get_building(Request $request){

        if ($request["building"] != null){

            return $this->send_response([BuildingInfo::where("building_name",$request["building"])->first()], Lang::get('Successfully sent !!!'));

        }
        else{

            return $this->send_response(BuildingInfo::get(), Lang::get('Successfully sent !!!'));

        }

    }

    public function get_floor(Request $request){

        if ($request["building"] != null && $request["floor"] != null){

            return $this->send_response([FloorInfo::where("floor_building",$request["building"])->where("floor_name",$request["floor"])->first()], Lang::get('Successfully sent !!!'));

        }
        else if ($request["building"] != null){

            return $this->send_response(FloorInfo::where("floor_building",$request["building"])->get(), Lang::get('Successfully sent !!!'));

        }
        else{

            return $this->send_response(FloorInfo::get(), Lang::get('Successfully sent !!!'));

        }

    }

    public function get_room(Request $request){

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

            return $this->send_response(RoomInfo::get(), Lang::get('Successfully sent !!!'));

        }

    }

    public function run_stop_sensor(Request $request){

        try {

            if ($request["button"] == 1){

//            echo 2;

                $sensor = SensorInfo::where("sensor_id", $request["sensor_id"])->first();

                $process = new Process('kill -9 '.$sensor["sensor_pid"]);

                $process->run();

                $sensor["sensor_pid"] = null;

                $sensor->save();

//                $sensor_log = SensorLogInfo::where("sensor_id", $request->session()->get("1752051_current_sensor")["sensor_id"])->orderBy('sensor_timestamp', 'DESC')->get();
//
//                $request->session()->put("1752051_current_sensor",$sensor);
//
//                $request->session()->put("1752051_current_sensor_log",$sensor_log);

                return $this->send_response([], Lang::get('Successfully turn off sensor !!!'));

            }
            else {

//            echo 1;

                $process = new BackgroundProcess('python3 /Users/WhiteWolf21/Documents/Heroku/SCC/final/subscribe_real_sensor.py "'.$request["sensor_username"].'" "'.$request["sensor_password"].'" "'.$request["sensor_ip"].'" "'.$request["sensor_port"].'" "'.$request["sensor_topic"].'" "'.$request["sensor_id"].'"');
                # python3 /Users/WhiteWolf21/Documents/Heroku/SCC/final/subscribe_temp_humid.py "BKvm2" "Hcmut_CSE_2020" "13.76.250.158" "1883" "Topic/TempHumi" "TEMP-HUD100"

//            $process->setTimeout(3100000000);

                $process->run();

                $sensor = SensorInfo::where("sensor_id", $request["sensor_id"])->first();

                $sensor["sensor_pid"] = $process->getPid();

                $sensor->save();

//                $sensor = SensorInfo::where("sensor_id", $request->session()->get("1752051_current_sensor")["sensor_id"])->first();
//
//                $request->session()->put("1752051_current_sensor", $sensor);

                return $this->send_response([], Lang::get('Successfully turn on sensor !!!'));

            }

        } catch ( \Exception $e ) {
//            dd($e);
//            abort(404);
//            echo $e;
            return $this->send_error($e, Lang::get('Fail to execute !!!'));
        }

    }

    public function run_stop_device(Request $request){

        try {

            if ($request["button"] == 1){

//            echo 1;

                $process = new Process('python3 /Users/WhiteWolf21/Documents/Heroku/SCC/final/publish_real_device.py "'.$request["device_username"].'" "'.$request["device_password"].'" "'.$request["device_ip"].'" "'.$request["device_port"].'" "'.$request["device_topic"].'" ["0","0"] "'.$request["device_id"].'"');
                # python3 /Users/WhiteWolf21/Documents/Heroku/SCC/final/subscribe_temp_humid.py "BKvm2" "Hcmut_CSE_2020" "13.76.250.158" "1883" "Topic/TempHumi" "TEMP-HUD100"

//            echo 2;


                $process->run();

                if (!$process->isSuccessful()) {
//                echo 3;

                    throw new ProcessFailedException($process);
                }

                $device = DeviceInfo::where("device_id", $request["device_id"])->first();

                $process = new Process('kill -9 '.$device["device_pid"]);

                $process->run();

                $device["device_pid"] = null;

                $device->save();

                $device_log = DeviceLogInfo::where("device_id", $request["device_id"])->orderBy('device_timestamp', 'DESC')->first();

                if ($device_log["device_status"] == true) {

                    $device_kwh = DeviceInfo::where("device_id", $request["device_id"])->first(["device_kwh"])["device_kwh"];

                    $device_new_log = new DeviceLogInfo();

                    $device_new_log["device_id"] = $request["device_id"];
                    $device_new_log["device_status"] = false;

                    $timestamp_now = Carbon::now()->timestamp;

                    $device_new_log["device_timestamp"] = $timestamp_now;
                    $device_new_log["device_status_value"] = $request["device_status_value"];

                    $hours_duration = floatval($timestamp_now - intval($device_log["device_timestamp"])) / 3600.0;
                    $device_new_log["device_hours_usage"] = $hours_duration;

                    $device_new_log["device_electrical_consumption"] = $hours_duration * floatval($device_kwh);

                    $device_new_log->save();

                }
//
//                $device_log = DeviceLogInfo::where("device_id", $request->session()->get("1752051_current_device")["device_id"])->orderBy('device_timestamp', 'DESC')->get();
//
//                $device = DeviceInfo::where("device_id", $request->session()->get("1752051_current_device")["device_id"])->first();
//
//                $request->session()->put("1752051_current_device",$device);
//
//                $request->session()->put("1752051_current_device_log",$device_log);

                return $this->send_response([], Lang::get('Successfully turn off device !!!'));

            }
            else {

//            echo 1;

                $process = new Process('python3 /Users/WhiteWolf21/Documents/Heroku/SCC/final/publish_real_device.py "'.$request["device_username"].'" "'.$request["device_password"].'" "'.$request["device_ip"].'" "'.$request["device_port"].'" "'.$request["device_topic"].'" ["1",'.$request["device_status_value"].'] "'.$request["device_id"].'"');
                # python3 /Users/WhiteWolf21/Documents/Heroku/SCC/final/subscribe_temp_humid.py "BKvm2" "Hcmut_CSE_2020" "13.76.250.158" "1883" "Topic/TempHumi" "TEMP-HUD100"

                // waiting for process to finish

                $device_log = new DeviceLogInfo();

                $device_log["device_id"] = $request["device_id"];
                $device_log["device_status"] = true;

                $timestamp_now = Carbon::now()->timestamp;

                $device_log["device_timestamp"] = $timestamp_now;
                $device_log["device_status_value"] = $request["device_status_value"];
                $device_log->save();

                $device = DeviceInfo::where("device_id", $request["device_id"])->first();

                $process->start();

                $device["device_pid"] = $process->getPid();

                $process->wait();

                $device->save();

//                $device_log = DeviceLogInfo::where("device_id", $request->session()->get("1752051_current_device")["device_id"])->orderBy('device_timestamp', 'DESC')->get();
//
//                $device = DeviceInfo::where("device_id", $request->session()->get("1752051_current_device")["device_id"])->first();
//
//                $request->session()->put("1752051_current_device", $device);
//
//                $request->session()->put("1752051_current_device_log",$device_log);

                return $this->send_response([], Lang::get('Successfully turn on device !!!'));

            }

        } catch ( \Exception $e ) {
//            echo $e;
//            abort(404);
            return $this->send_error([$e], Lang::get('Fail to execute !!!'));
        }

    }

    public function auto_run_stop_device(Request $request){

        try {

//            echo 1;

            $timestamp_now = Carbon::now()->timestamp;

            $process = new BackgroundProcess('python3 /Users/WhiteWolf21/Documents/Heroku/SCC/final/publish_auto_real_device.py "'.session("1752051_current_device")["device_username"].'" "'.session("1752051_current_device")["device_password"].'" "'.session("1752051_current_device")["device_ip"].'" "'.session("1752051_current_device")["device_port"].'" "'.session("1752051_current_device")["device_auto_based_on_sensor_topic"].'" "'.session("1752051_current_device")["device_topic"].'" "'.session("1752051_current_device")["device_status_value"].'" "'.session("1752051_current_device")["device_lower_threshold"].'" "'.session("1752051_current_device")["device_upper_threshold"].'" "'.session("1752051_current_device")["device_id"].'" "'.$timestamp_now.'" "'.session("1752051_current_device")["device_kwh"].'"');
            # python3 /Users/WhiteWolf21/Documents/Heroku/SCC/final/subscribe_temp_humid.py "BKvm2" "Hcmut_CSE_2020" "13.76.250.158" "1883" "Topic/TempHumi" "TEMP-HUD100"

//            $process->setTimeout(3100000000);

            $process->run();

            $device_log = new DeviceLogInfo();

            $device_log["device_id"] = $request->session()->get("1752051_current_device")["device_id"];
            $device_log["device_status"] = true;

            $request->session()->put('previous_timestamp', $timestamp_now);

            $request->session()->put('previous_kwh',$request->session()->get("1752051_current_device")["device_kwh"]);

            $device_log["device_timestamp"] = $timestamp_now;
            $device_log["device_status_value"] = session("1752051_current_device")["device_status_value"];
            $device_log->save();

            $device = DeviceInfo::where("device_id", $request->session()->get("1752051_current_device")["device_id"])->first();

            $device["device_pid"] = $process->getPid();

            $device->save();

            $device_log = DeviceLogInfo::where("device_id", $request->session()->get("1752051_current_device")["device_id"])->orderBy('device_timestamp', 'DESC')->get();

            $device = DeviceInfo::where("device_id", $request->session()->get("1752051_current_device")["device_id"])->first();

            $request->session()->put("1752051_current_device", $device);

            $request->session()->put("1752051_current_device_log",$device_log);

        } catch ( \Exception $e ) {
//            dd($e);
            abort(404);
        }

    }

}
