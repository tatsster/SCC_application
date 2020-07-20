<?php


namespace App\Http\Controllers;


use App\UserInfo;
use Illuminate\Http\Request;

class ChangeLanguageController extends MainController {

    /* Change language */

    public function change_language(Request $request){

        $user_db = UserInfo::where("user_id", $request->session()->get("1752051_user")["user_id"])->where("user_email", $request->session()->get("1752051_user")["user_email"])->first();

        $user_db["user_lang"] = $request["user_lang"];

        $user_db->save();

        $cookie = cookie()->forever('1752051_user_lang',$request["user_lang"]);

        $request->session()->put("1752051_user",$user_db);

        return response("Success")->withCookie($cookie);

    }

    public function change_language_cookie(Request $request){

        $cookie = cookie()->forever('1752051_user_lang',$request["user_lang"]);

        return response("Success")->withCookie($cookie);

    }

}
