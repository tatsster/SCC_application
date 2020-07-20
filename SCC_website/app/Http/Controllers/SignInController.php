<?php


namespace App\Http\Controllers;


use App\Mail\EmailResetPassword;
use App\PermissionInfo;
use App\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SignInController extends MainController {

    /* Sign in the system */

    private $pwd = null;

    public function send_sign_in(Request $request, Response $response){

        $this->pwd = md5($request["user_password"]);

        $validator = Validator::make($request->all(), [
            'user_email' => 'required|exists:user'
        ],
            [
                'user_email.required' => Lang::get('Please Input Email Address'),
                'user_email.exists' => Lang::get('Email Address Is Wrong / Not Exists')
            ]);

        if ($validator->fails()) {
            $cookie = cookie()->forever('1752051_captcha', true);
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->withCookie($cookie);
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
                $cookie = cookie()->forever('1752051_captcha', true);
                return redirect()
                    ->back()
                    ->withErrors($final_validator)
                    ->withInput()
                    ->withCookie($cookie);
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
            $cookie = cookie()->forever('1752051_captcha', true);
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->withCookie($cookie);
        }

        if ($request->cookie('1752051_captcha') != null){

            $validator = Validator::make($request->all(), [
                'g-recaptcha-response' => 'required|captcha',
            ],
                [
                    'g-recaptcha-response.required' => Lang::get('Please Do the Captcha Challenge !!!'),
                    'g-recaptcha-response.captcha' => Lang::get('Challenge Failed !!!')
                ]);

            if ($validator->fails()) {
                $cookie = cookie()->forever('1752051_captcha', true);
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput()
                    ->withCookie($cookie);
            }

        }

        $request->session()->forget("1752051_user_timeout");

        $cookie_captcha = cookie()->forget('1752051_captcha');

        $user_db = UserInfo::where("user_email", $request["user_email"])->where("user_password", md5($request["user_password"]))->orWhere("user_temporary_password", md5($request["user_password"]))->first();

        if ($request["user_remember"] == "on"){
            $remember_token = parent::get_token(21);
            $user_db["user_remember_token"] = $remember_token;
            $user_db->save();

            $user_role = PermissionInfo::where("permission_role", $user_db['user_role'])->first();

            unset($user_db['user_password']);
            unset($user_db['user_login_attempt']);
            unset($user_db['user_remember_token']);

            $request->session()->put("1752051_user",$user_db);

            $request->session()->put("1752051_user_role",$user_role);

            $cookie = cookie()->forever('1752051_user_remember', $remember_token);

            $cookie_lang = cookie()->forever('1752051_user_lang',$user_db["user_lang"]);

            return response()->redirectTo("dashboard")->withCookie($cookie)->withCookie($cookie_captcha)->withCookie($cookie_lang);
        }

        $user_role = PermissionInfo::where("permission_role", $user_db['user_role'])->first();

        unset($user_db['user_password']);
        unset($user_db['user_login_attempt']);
        unset($user_db['user_remember_token']);

        $request->session()->put("1752051_user",$user_db);

        $request->session()->put("1752051_user_role",$user_role);

        $cookie_lang = cookie()->forever('1752051_user_lang',$user_db["user_lang"]);

        return redirect("dashboard")->withCookie($cookie_captcha)->withCookie($cookie_lang);

    }

    /* Sign in the system */

    public function send_recover_password(Request $request, Response $response){

        $this->pwd = md5($request["user_password"]);

        $validator = Validator::make($request->all(), [
            'user_email' => 'required|exists:user'
        ],
            [
                'user_email.required' => Lang::get('Please Input Email Address'),
                'user_email.exists' => Lang::get('Email Address Is Wrong / Not Exists')
            ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user_db = UserInfo::where("user_email", $request["user_email"])->first();

        $temp_password = parent::get_token(30);
        $user_db["user_temporary_password"] = md5($temp_password);
        $user_db->save();

        try {
            Mail::to($request["user_email"])->send(new EmailResetPassword(Lang::get("Your Request For Temporary Password Is Success"),$temp_password));
        } catch ( \Exception $e ) {
            return redirect()
                ->back()
                ->withErrors($e->getMessage())
                ->withInput();
        }

        return redirect("sign-in")
            ->withErrors([Lang::get('Please check email and sign in with temporary password !!! Remember to change new password !!!')])
            ->withInput();

    }

}
