<?php


namespace App\Http\Controllers;


use App\PermissionInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class PermissionController extends MainController {

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
//            echo $this->send_error("Đã có lỗi xảy ra !!!", $validator->errors());
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

}
