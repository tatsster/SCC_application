<?php


namespace App\Http\Controllers;


use App\LanguageInfo;
use App\Mail\EmailSendEmailSuccess;
use App\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ProfileController extends MainController {

    /* Update profile information */

    public function update_profile(Request $request){

        Lang::setLocale($request->session()->get('1752051_user')["user_lang"]);

        $user = $request->session()->get("1752051_user");

        $user_db = UserInfo::where('user_id', $user["user_id"])->get();

        if (count($user_db) > 0){
            $current_user = $user_db->first();
            $email = $request["user_email"];
            $password = md5($request["user_password"]);
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
                    return redirect()->back()->with('msg_profile', Lang::get('Full Name Only Allows minimum 5 and maximum 255 Characters'))->with('msg_type_profile', 'danger');
                }

                $current_user["user_fullname"] = $request["user_fullname"];
                $check_empty = false;
            }

            if ($current_user["user_email"] != $request["user_email"] && $request["user_email"] != ""){

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
                    $code = parent::get_token(17);
                    Mail::to($request["user_email"])->send(new EmailSendEmailSuccess(Lang::get("Email For Checking Personal Information"),$user["user_fullname"],$code,$request["user_email"]));

                } catch ( \Exception $e ) {
                    return redirect()->back()->with('msg_profile', strval($e))->with('msg_type_profile', 'danger');
                }

//                $current_user["user_email"] = $request["user_email"];
                $current_user["user_confirmation_code"] = $code;
                $current_user["user_active"] = false;
                $check_empty = false;
            }
            else
                $email = $current_user["admin_email"];

            if ($current_user["user_password"] != md5($request["user_password"]) && $request["user_password"] != ""){

                $validator = Validator::make($request->all(), [
                    'user_password' => 'min:3'
                ],
                    [
                        'user_password.min' => Lang::get('Password Need At least 3 Characters')
                    ]);

                if ($validator->fails()) {
                    $errors = array_values($validator->errors()->messages());
                    return redirect()->back()->with('msg_profile', Lang::get($errors[0][0]))->with('msg_type_profile', 'danger');
                }

                $validator = Validator::make($request->all(), [
                    'user_password' => 'max:255'
                ],
                    [
                        'user_password.max' => Lang::get('Password Only Allows Maximum 255 Characters')
                    ]);

                if ($validator->fails()) {
                    $errors = array_values($validator->errors()->messages());
                    return redirect()->back()->with('msg_profile', Lang::get($errors[0][0]))->with('msg_type_profile', 'danger');
                }

                $validator = Validator::make($request->all(), [
                    'user_password' => 'confirmed'
                ],
                    [
                        'user_password.confirmed' => Lang::get('Confirmed Password Wrong')
                    ]);

                if ($validator->fails()) {
                    $errors = array_values($validator->errors()->messages());
                    return redirect()->back()->with('msg_profile', Lang::get($errors[0][0]))->with('msg_type_profile', 'danger');
                }

                $current_user["user_password"] = md5($request["user_password"]);
                $current_user["user_temporary_password"] = null;
                $check_empty = false;
            }
            else
                $password = $current_user["user_password"];

            if ($current_user["user_address"] != $request["user_address"] && $request["user_address"] != ""){

                $validator = Validator::make($request->all(), [
                    'user_address' => 'max:255'
                ],
                    [
                        'user_address.max' => Lang::get('Address Only Allows Maximum 255 Characters')
                    ]);

                if ($validator->fails()) {
                    return redirect()->back()->with('msg_profile', Lang::get('Address Only Allows Maximum 255 Characters'))->with('msg_type_profile', 'danger');
                }

                $current_user["user_address"] = $request["user_address"];
                $check_empty = false;
            }

            if ($current_user["user_about"] != $request["user_about"] && $request["user_about"] != ""){

                $validator = Validator::make($request->all(), [
                    'user_about' => 'max:255'
                ],
                    [
                        'user_about.max' => Lang::get('About Only Allows Maximum 255 Characters')
                    ]);

                if ($validator->fails()) {
                    return redirect()->back()->with('msg_profile', Lang::get('About Only Allows Maximum 255 Characters'))->with('msg_type_profile', 'danger');
                }

                $current_user["user_about"] = $request["user_about"];
                $check_empty = false;
            }

            if ($current_user["user_mobile"] != $request["user_mobile"] && $request["user_mobile"] != ""){

                $validator = Validator::make($request->all(), [
                    'user_mobile' => 'digits_between:3,14'
                ],
                    [
                        'user_mobile.digits_between' => Lang::get('Mobile Is Only Between 3 And 14 Numbers')
                    ]);

                if ($validator->fails()) {
                    return redirect()->back()->with('msg_profile', Lang::get('Mobile Is Only Between 3 And 14 Numbers'))->with('msg_type_profile', 'danger');
                }

                $current_user["user_mobile"] = $request["user_mobile"];
                $check_empty = false;
            }

            if ($current_user["user_session_timeout"] != $request["user_session_timeout"] && $request["user_session_timeout"] != ""){

                $validator = Validator::make($request->all(), [
                    'user_session_timeout' => 'numeric|not_in:0'
                ],
                    [
                        'user_session_timeout.not_in' => Lang::get('Session Timeout Must Be Larger Than 0'),
                        'user_session_timeout.numeric' => Lang::get('Session Timeout Must Be Numeric'),
                    ]);

                if ($validator->fails()) {
                    $errors = array_values($validator->errors()->messages());
                    $final_errors = "";
                    foreach ($errors as $error){
                        $final_errors = $final_errors.$error[0]."<br>";
                    }
                    return redirect()->back()->with('msg_profile', $final_errors)->with('msg_type_profile', 'danger');
                }

                $current_user["user_session_timeout"] = $request["user_session_timeout"];
                $check_empty = false;
            }

            if ($check_empty)
                return redirect()->back()->with('msg_profile', Lang::get('Nothing changes !!!'))->with('msg_type_profile', 'success');
            else {

                $notice = array();

                if ($request["user_password"] != ""){
                    array_push($notice, Lang::get('Please sign in with new password !!!'));
                }

                if ($request["user_email"] != ""){
                    array_push($notice, Lang::get('Please confirm your new email to sign in !!!'));
                }

                if (!empty($notice)){
                    $current_user->save();

                    $user_db = UserInfo::where('user_id', $user["user_id"])->get();
                    $current_user = $user_db->first();

                    $request->session()->forget('1752051_user');

                    return redirect("sign-in")
                        ->withErrors($notice)
                        ->withInput();
                }
                else{
                    $current_user->save();

                    $user_db = UserInfo::where('user_id', $user["user_id"])->get();
                    $current_user = $user_db->first();

                    $request->session()->put('1752051_user',$current_user);
                }

                return redirect()->back()->with('msg_profile', Lang::get('Successfully updated !!!'))->with('msg_type_profile', 'success');
            }
        } else {
            return redirect()->back()->with('msg_profile', Lang::get('Fail to update !!!'))->with('msg_type_profile', 'danger');
        }
    }

    public function update_other_profile(Request $request){

        Lang::setLocale($request->session()->get('1752051_user')["user_lang"]);

        $user = $request->session()->get("current_user");

        $user_db = UserInfo::where('user_id', $user["user_id"])->get();

        if (count($user_db) > 0){
            $current_user = $user_db->first();
            $email = $request["user_email"];
            $password = md5($request["user_password"]);
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
                    return redirect()->back()->with('msg_profile', Lang::get('Full Name Only Allows minimum 5 and maximum 255 Characters'))->with('msg_type_profile', 'danger');
                }

                $current_user["user_fullname"] = $request["user_fullname"];
                $check_empty = false;
            }

            if ($current_user["user_email"] != $request["user_email"] && $request["user_email"] != ""){

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
                    $code = parent::get_token(17);
                    Mail::to($request["user_email"])->send(new EmailSendEmailSuccess(Lang::get("Email For Checking Personal Information"),$user["user_fullname"],$code,$request["user_email"]));

                } catch ( \Exception $e ) {
                    return redirect()->back()->with('msg_profile', strval($e))->with('msg_type_profile', 'danger');
                }

//                $current_user["user_email"] = $request["user_email"];
                $current_user["user_confirmation_code"] = $code;
                $current_user["user_active"] = false;
                $check_empty = false;
            }
            else
                $email = $current_user["admin_email"];

            if ($current_user["user_password"] != md5($request["user_password"]) && $request["user_password"] != ""){

                $validator = Validator::make($request->all(), [
                    'user_password' => 'min:3'
                ],
                    [
                        'user_password.min' => Lang::get('Password Need At least 3 Characters')
                    ]);

                if ($validator->fails()) {
                    $errors = array_values($validator->errors()->messages());
                    return redirect()->back()->with('msg_profile', Lang::get($errors[0][0]))->with('msg_type_profile', 'danger');
                }

                $validator = Validator::make($request->all(), [
                    'user_password' => 'max:255'
                ],
                    [
                        'user_password.max' => Lang::get('Password Only Allows Maximum 255 Characters')
                    ]);

                if ($validator->fails()) {
                    $errors = array_values($validator->errors()->messages());
                    return redirect()->back()->with('msg_profile', Lang::get($errors[0][0]))->with('msg_type_profile', 'danger');
                }

                $validator = Validator::make($request->all(), [
                    'user_password' => 'confirmed'
                ],
                    [
                        'user_password.confirmed' => Lang::get('Confirmed Password Wrong')
                    ]);

                if ($validator->fails()) {
                    $errors = array_values($validator->errors()->messages());
                    return redirect()->back()->with('msg_profile', Lang::get($errors[0][0]))->with('msg_type_profile', 'danger');
                }

                $current_user["user_password"] = md5($request["user_password"]);
                $current_user["user_temporary_password"] = null;
                $check_empty = false;
            }
            else
                $password = $current_user["user_password"];

            if ($current_user["user_address"] != $request["user_address"] && $request["user_address"] != ""){

                $validator = Validator::make($request->all(), [
                    'user_address' => 'max:255'
                ],
                    [
                        'user_address.max' => Lang::get('Address Only Allows Maximum 255 Characters')
                    ]);

                if ($validator->fails()) {
                    return redirect()->back()->with('msg_profile', Lang::get('Address Only Allows Maximum 255 Characters'))->with('msg_type_profile', 'danger');
                }

                $current_user["user_address"] = $request["user_address"];
                $check_empty = false;
            }

            if ($current_user["user_about"] != $request["user_about"] && $request["user_about"] != ""){

                $validator = Validator::make($request->all(), [
                    'user_about' => 'max:255'
                ],
                    [
                        'user_about.max' => Lang::get('About Only Allows Maximum 255 Characters')
                    ]);

                if ($validator->fails()) {
                    return redirect()->back()->with('msg_profile', Lang::get('About Only Allows Maximum 255 Characters'))->with('msg_type_profile', 'danger');
                }

                $current_user["user_about"] = $request["user_about"];
                $check_empty = false;
            }

            if ($current_user["user_mobile"] != $request["user_mobile"] && $request["user_mobile"] != ""){

                $validator = Validator::make($request->all(), [
                    'user_mobile' => 'digits_between:3,14'
                ],
                    [
                        'user_mobile.digits_between' => Lang::get('Mobile Is Only Between 3 And 14 Numbers')
                    ]);

                if ($validator->fails()) {
                    return redirect()->back()->with('msg_profile', Lang::get('Mobile Is Only Between 3 And 14 Numbers'))->with('msg_type_profile', 'danger');
                }

                $current_user["user_mobile"] = $request["user_mobile"];
                $check_empty = false;
            }

            if ($current_user["user_session_timeout"] != $request["user_session_timeout"] && $request["user_session_timeout"] != ""){

                $validator = Validator::make($request->all(), [
                    'user_session_timeout' => 'numeric|not_in:0'
                ],
                    [
                        'user_session_timeout.not_in' => Lang::get('Session Timeout Must Be Larger Than 0'),
                        'user_session_timeout.numeric' => Lang::get('Session Timeout Must Be Numeric'),
                    ]);

                if ($validator->fails()) {
                    $errors = array_values($validator->errors()->messages());
                    $final_errors = "";
                    foreach ($errors as $error){
                        $final_errors = $final_errors.$error[0]."<br>";
                    }
                    return redirect()->back()->with('msg_profile', $final_errors)->with('msg_type_profile', 'danger');
                }

                $current_user["user_session_timeout"] = $request["user_session_timeout"];
                $check_empty = false;
            }

            if ($current_user["user_role"] != $request["user_role"] && $request["user_role"] != ""){

                $validator = Validator::make($request->all(), [
                    'user_role' => 'max:255'
                ],
                    [
                        'user_role.max' => Lang::get('Role Only Allows Maximum 255 Characters'),
                    ]);

                if ($validator->fails()) {
                    return redirect()->back()->with('msg_profile', Lang::get('Role Only Allows Maximum 255 Characters'))->with('msg_type_profile', 'danger');
                }

                $current_user["user_role"] = $request["user_role"];
                $check_empty = false;
            }

            if ($check_empty)
                return redirect()->back()->with('msg_profile', Lang::get('Nothing changes !!!'))->with('msg_type_profile', 'success');
            else {

                $notice = array();

                if ($request["user_password"] != ""){
                    array_push($notice, Lang::get('Please sign in with new password !!!'));
                }

                if ($request["user_email"] != ""){
                    array_push($notice, Lang::get('Please confirm your new email to sign in !!!'));
                }

                $current_user->save();

                $user_db = UserInfo::where('user_id', $user["user_id"])->get();
                $current_user = $user_db->first();

                $request->session()->put('current_user',$current_user);

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
            $current_user = $user_db->first();
            $error = "";
            $current_path = str_replace("../","",$current_user["user_avatar"]);

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
                    $current_user["user_avatar"] = $path;
                }
                else
                    $error = Lang::get('Không Đúng Định Dạng File Ảnh !!!');
            }

            if ($error != ""){
                return redirect()->back()->with('msg_profile', $error)->with('msg_type_profile', 'danger');
            }
            else {
                $current_user->save();

                $user_db = UserInfo::where('user_email', $current_user["user_email"])->where('user_password', $current_user["user_password"])->get();
                $current_user = $user_db->first();
                $request->session()->put('1752051_user',$current_user);
                return redirect()->back()->with('msg_profile', Lang::get('Successfully updated !!!'))->with('msg_type_profile', 'success');
            }
        } else {
            return redirect()->back()->with('msg_profile', Lang::get('Fail to update !!!'))->with('msg_type_profile', 'danger');
        }
    }

    public function update_other_profile_avatar(Request $request){

        Lang::setLocale($request->session()->get('1752051_user')["user_lang"]);

        $user = $request->session()->get("current_user");

        $user_db = UserInfo::where('user_id', $user["user_id"])->get();

        if (count($user_db) > 0 && $request->file('user_avatar') != ""){
            $current_user = $user_db->first();
            $error = "";
            $current_path = str_replace("../","",$current_user["user_avatar"]);

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
                    $current_user["user_avatar"] = $path;
                }
                else
                    $error = Lang::get('Không Đúng Định Dạng File Ảnh !!!');
            }

            if ($error != ""){
                return redirect()->back()->with('msg_profile', $error)->with('msg_type_profile', 'danger');
            }
            else {
                $current_user->save();

                $user_db = UserInfo::where('user_id', $user["user_id"])->get();
                $current_user = $user_db->first();

                $request->session()->put('current_user',$current_user);

                return redirect()->back()->with('msg_profile', Lang::get('Successfully updated !!!'))->with('msg_type_profile', 'success');
            }
        } else {
            return redirect()->back()->with('msg_profile', Lang::get('Fail to update !!!'))->with('msg_type_profile', 'danger');
        }
    }

    public function new_profile(Request $request){

        Lang::setLocale($request->session()->get('1752051_user')["user_lang"]);

        $validator = Validator::make($request->all(), [
            'user_fullname' => 'min:5|max:255',
            'user_email' => 'unique:user',
            'user_password' => 'min:3|max:255|confirmed',
            'user_address' => 'max:255',
            'user_about' => 'max:255',
            'user_mobile' => 'digits_between:3,14',
            'user_role' => 'max:255'
        ],
            [
                'user_fullname.max' => Lang::get('Full Name Only Allows Maximum 255 Characters'),
                'user_fullname.min' => Lang::get('Full Name Needs At least 5 Characters'),
                'user_email.unique' => Lang::get('Email Address Already Exists, Please Choose Another Address'),
                'user_password.min' => Lang::get('Password Need At least 3 Characters'),
                'user_password.max' => Lang::get('Password Only Allows Maximum 255 Characters'),
                'user_password.confirmed' => Lang::get('Confirmed Password Wrong'),
                'user_address.max' => Lang::get('Address Only Allows Maximum 255 Characters'),
                'user_mobile.digits_between' => Lang::get('Mobile Is Only Between 3 And 14 Numbers'),
                'user_role.max' => Lang::get('Role Only Allows Maximum 255 Characters'),
                'user_about.max' => Lang::get('About Only Allows Maximum 255 Characters')
            ]);

        if ($validator->fails()) {
            $errors = array_values($validator->errors()->messages());
            $final_errors = "";
            foreach ($errors as $error){
                $final_errors = $final_errors.$error[0]."<br>";
            }
            return redirect()->back()->with('msg_profile', $final_errors)->with('msg_type_profile', 'danger');
        }

        $current_user = new UserInfo();

        $current_user["user_fullname"] = $request["user_fullname"];
        $current_user["user_password"] = md5($request["user_password"]);
        $current_user["user_address"] = $request["user_address"];
        $current_user["user_about"] = $request["user_about"];
        $current_user["user_mobile"] = $request["user_mobile"];
        $current_user["user_role"] = $request["user_role"];
        $current_user["user_lang"] = "us";

        try {
            $code = parent::get_token(17);
            Mail::to($request["user_email"])->send(new EmailSendEmailSuccess(Lang::get("Email For Checking Personal Information"),$request["user_fullname"],$code,$request["user_email"]));

        } catch ( \Exception $e ) {
            return redirect()->back()->with('msg_profile', strval($e))->with('msg_type_profile', 'danger');
        }

        $current_user["user_email"] = $request["user_email"];
        $current_user["user_confirmation_code"] = $code;
        $current_user["user_active"] = false;
        $current_user_id = parent::get_token(20);
        $current_user["user_id"] = $current_user_id;

        $current_user->save();

        $user_db = UserInfo::where('user_id', $current_user_id)->get();

        if (count($user_db) > 0 && $request->file('user_avatar') != ""){
            $current_user = $user_db->first();
            $error = "";
            $current_path = str_replace("../","",$current_user["user_avatar"]);

            if(File::exists($current_path)) {
                File::delete($current_path);
            }

            if($request->file('user_avatar')) {
                $allowedMimeTypes = ['image/jpeg', 'image/gif', 'image/png', 'image/bmp', 'image/svg+xml'];
                $contentType = $request->file('user_avatar')->getClientMimeType();

                if (in_array($contentType, $allowedMimeTypes)) {

                    $realType = explode("/",$request->file('user_avatar')->getClientMimeType());
                    $realType = explode("+",$realType[1])[0];

                    $path = '../assets/users/avatar/'.$current_user_id.'.'.$realType;
                    $request->file('user_avatar')->storeAs('assets/users/avatar/', $current_user_id.'.'.$realType, ['disk' => 'public_element']);
                    $current_user["user_avatar"] = $path;
                }
                else
                    $error = Lang::get('Không Đúng Định Dạng File Ảnh !!!');
            }

            if ($error != ""){
                return redirect()->back()->with('msg_profile', $error)->with('msg_type_profile', 'danger');
            }
            else {
                $current_user->save();
            }
        }

        return redirect('user-list')->with('msg_user_list', Lang::get('Successfully added !!!'))->with('msg_type_user_list', 'success');

    }

    public function register(Request $request){

        Lang::setLocale($request->cookie('1752051_user_lang'));

        $validator = Validator::make($request->all(), [
            'user_fullname' => 'min:5|max:255',
            'user_email' => 'unique:user',
            'user_password' => 'min:3|max:255|confirmed',
            'user_address' => 'max:255',
            'user_about' => 'max:255',
            'user_mobile' => 'digits_between:3,14',
            'user_role' => 'max:255'
        ],
            [
                'user_fullname.max' => Lang::get('Full Name Only Allows Maximum 255 Characters'),
                'user_fullname.min' => Lang::get('Full Name Needs At least 5 Characters'),
                'user_email.unique' => Lang::get('Email Address Already Exists, Please Choose Another Address'),
                'user_password.min' => Lang::get('Password Need At least 3 Characters'),
                'user_password.max' => Lang::get('Password Only Allows Maximum 255 Characters'),
                'user_password.confirmed' => Lang::get('Confirmed Password Wrong'),
                'user_address.max' => Lang::get('Address Only Allows Maximum 255 Characters'),
                'user_mobile.digits_between' => Lang::get('Mobile Is Only Between 3 And 14 Numbers'),
                'user_role.max' => Lang::get('Role Only Allows Maximum 255 Characters'),
                'user_about.max' => Lang::get('About Only Allows Maximum 255 Characters')
            ]);

        if ($validator->fails()) {
            $errors = array_values($validator->errors()->messages());
            $final_errors = "";
            foreach ($errors as $error){
                $final_errors = $final_errors.$error[0]."<br>";
            }
            return redirect()->back()->with('msg_profile', $final_errors)->with('msg_type_profile', 'danger');
        }

        $current_user = new UserInfo();

        $current_user["user_fullname"] = $request["user_fullname"];
        $current_user["user_password"] = md5($request["user_password"]);
        $current_user["user_address"] = $request["user_address"];
        $current_user["user_about"] = $request["user_about"];
        $current_user["user_mobile"] = $request["user_mobile"];
        $current_user["user_role"] = "Newcomer";
        $current_user["user_lang"] = "us";

        try {
            $code = parent::get_token(17);
            Mail::to($request["user_email"])->send(new EmailSendEmailSuccess(Lang::get("Email For Checking Personal Information"),$request["user_fullname"],$code,$request["user_email"]));

        } catch ( \Exception $e ) {
            return redirect()->back()->with('msg_profile', strval($e))->with('msg_type_profile', 'danger');
        }

        $current_user["user_email"] = $request["user_email"];
        $current_user["user_confirmation_code"] = $code;
        $current_user["user_active"] = false;
        $current_user_id = parent::get_token(20);
        $current_user["user_id"] = $current_user_id;

        $validator = Validator::make($request->all(), [
            'g-recaptcha-response' => 'required|captcha',
        ],
            [
                'g-recaptcha-response.required' => Lang::get('Please Do the Captcha Challenge !!!'),
                'g-recaptcha-response.captcha' => Lang::get('Challenge Failed !!!')
            ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $current_user->save();

        $user_db = UserInfo::where('user_id', $current_user_id)->get();

        if (count($user_db) > 0 && $request->file('user_avatar') != ""){
            $current_user = $user_db->first();
            $error = "";
            $current_path = str_replace("../","",$current_user["user_avatar"]);

            if(File::exists($current_path)) {
                File::delete($current_path);
            }

            if($request->file('user_avatar')) {
                $allowedMimeTypes = ['image/jpeg', 'image/gif', 'image/png', 'image/bmp', 'image/svg+xml'];
                $contentType = $request->file('user_avatar')->getClientMimeType();

                if (in_array($contentType, $allowedMimeTypes)) {

                    $realType = explode("/",$request->file('user_avatar')->getClientMimeType());
                    $realType = explode("+",$realType[1])[0];

                    $path = '../assets/users/avatar/'.$current_user_id.'.'.$realType;
                    $request->file('user_avatar')->storeAs('assets/users/avatar/', $current_user_id.'.'.$realType, ['disk' => 'public_element']);
                    $current_user["user_avatar"] = $path;
                }
                else
                    $error = Lang::get('Không Đúng Định Dạng File Ảnh !!!');
            }

            if ($error != ""){
                return redirect()->back()->with('msg_profile', $error)->with('msg_type_profile', 'danger');
            }
            else {
                $current_user->save();
            }
        }

        return redirect('sign-in')->withErrors(Lang::get('Register successfully !!! Now please wait for activation email before you can sign in !!!'))->withInput();

    }

}
