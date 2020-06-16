<?php


namespace App\Http\Controllers\API;
use App\ContactInfo;
use App\FormInfo;
use App\FormFoodInfo;
use App\Mail\EmailNotice;
use App\Mail\EmailFoodNotice;
use App\Mail\EmailSignUp;
use App\UserInfo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use App\Schedules;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Ixudra\Curl\Facades\Curl;

class APIController extends Controller{

    protected $pwd;

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

    public function query(Request $request){

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:user'
        ],
        [
            'user_id.required' => 'Vui Lòng Nhập ID Người Dùng',
            'user_id.exists' => 'ID Không Tồn Tại'
        ]);

        if ($validator->fails()) {
            return $this->sendError("Đã có lỗi xảy ra !!!", $validator->errors());
        }

        try {
            $query = DB::select($request["query"]);

            return $this->sendResponse($query, 'Gửi Yêu Cầu Thành Công !!!');
        } catch ( \Exception $e ) {
            return $this->sendError("Đã có lỗi xảy ra !!!", $e);
        }
    }

    public function sign_in(Request $request){

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
            $error = json_decode($validator->errors())->user_email;
            if ($error != "") {
                return $this->sendError("Đã có lỗi xảy ra !!!", $error);
            }
            return $this->sendError("Đã có lỗi xảy ra !!!", $validator->errors());
        }

        $user_db = UserInfo::where("user_password", md5($request["user_password"]))->where("user_email", $request["user_email"])->first();

        if ($request["user_remember"] == 1){
            $remember_token = $this->getToken(21);
            $user_db["user_remember_token"] = $remember_token;
            $user_db->save();

//            $response->withCookie(Cookie::make('1752051_user_remember', $remember_token, 45000));
        }

        unset($user_db['user_password']);
        unset($user_db['user_login_attempt']);
        unset($user_db['user_remember_token']);

        return $this->sendResponse($user_db, 'Đăng nhập thành công !!!');
    }

//    public function sign_up(Request $request){
//
//        $validator = Validator::make($request->all(), [
//            'user_fullname' => 'required|min:5|max:255',
//            'user_password' => 'required|min:3',
//            'user_email' => 'required|unique:user',
//            'user_mobile' => 'required|max:20',
//            'user_city' => 'required|max:255',
//            'user_district' => 'required|max:255',
//            'user_commune' => 'required|max:255',
//            'user_city_code' => 'required',
//            'user_district_code' => 'required',
//            'user_commune_code' => 'required',
//            'user_address' => 'required|max:255'
//        ],
//        [
//            'user_fullname.required' => 'Vui Lòng Nhập Họ Tên',
//            'user_fullname.min' => 'Tên Có Tối Thiểu 5 Ký Tự',
//            'user_fullname.max' => 'Tên Có Tối Đa 255 Ký Tự',
//            'user_password.required' => 'Vui Lòng Nhập Mật Khẩu',
//            'user_password.min' => 'Mật Khẩu Có Tối Thiểu 5 Ký Tự',
//            'user_email.required' => 'Vui Lòng Nhập Địa Chỉ Email',
//            'user_email.unique' => 'Địa Chỉ Email Đã Tồn Tại',
//            'user_mobile.required' => 'Vui Lòng Nhập Số Điện Thoại',
//            'user_mobile.max' => 'Số Điện Thoại Có Tối Đa 20 Ký Tự',
//            'user_city.required' => 'Vui Lòng Nhập Thành Phố',
//            'user_city.max' => 'Tỉnh/Thành Phố Có Tối Đa 255 Ký Tự',
//            'user_city_code.required' => 'Vui Lòng Nhập Mã Thành Phố',
//            'user_district.required' => 'Vui Lòng Nhập Huyện/Quận',
//            'user_district.max' => 'Huyện/Quận Có Tối Đa 255 Ký Tự',
//            'user_district_code.required' => 'Vui Lòng Nhập Mã Huyện/Quận',
//            'user_commune.required' => 'Vui Lòng Nhập Xã/Phường',
//            'user_commune.max' => 'Xã/Phường Có Tối Đa 255 Ký Tự',
//            'user_commune_code.required' => 'Vui Lòng Nhập Mã Xã/Phường',
//            'user_address.required' => 'Vui Lòng Nhập Địa Chỉ Cụ Thể',
//            'user_address.max' => 'Địa Chỉ Cụ Thể Có Tối Đa 255 Ký Tự',
//        ]);
//
//        if ($validator->fails()) {
//            return $this->sendError("Đã có lỗi xảy ra !!!", $validator->errors());
//        }
//
//        $token = $this->getToken(17);
//
//        $user = new UserInfo();
//        $user["user_id"] = $token;
//        $user["user_password"] = md5($request["user_password"]);
//        $user["user_fullname"] = $request["user_fullname"];
//        $user["user_email"] = $request["user_email"];
//        $user["user_mobile"] = $request["user_mobile"];
//        $user["user_city"] = $request["user_city"];
//        $user["user_district"] = $request["user_district"];
//        $user["user_commune"] = $request["user_commune"];
//        $user["user_city_code"] = $request["user_city_code"];
//        $user["user_district_code"] = $request["user_district_code"];
//        $user["user_commune_code"] = $request["user_commune_code"];
//        $user["user_address"] = $request["user_address"];
//        $user->save();
//
//        try {
//            Mail::to($request["user_email"])->send(new EmailSignUp($token,$request["user_fullname"]));
//        } catch ( \Exception $e ) {
//
//        }
//
//        return $this->sendResponse([], 'Quý Khách Đã Đăng Ký Thành Công !!! Vui Lòng Kiểm Tra Email Để Xác Nhận Tài Khoản.');
//    }
//
//
//    public function get_province(){
//        $response = Curl::to('https://api.mysupership.vn/v1/partner/areas/province')
//            ->get();
//
//        $res = json_decode($response,true);
//
//        try {
//            return $this->sendResponse($res["results"], 'Lấy thông tin Tỉnh/Thành Phố thành công !!!');
//        } catch ( \Exception $e ) {
//            return $this->sendError("", '');
//        }
//    }
//
//    public function get_district(Request $request){
//        $response = Curl::to('https://api.mysupership.vn/v1/partner/areas/district?province='.$request["current_city"])
//            ->get();
//
//        $res = json_decode($response,true);
//
//        try {
//            return $this->sendResponse($res["results"], 'Lấy thông tin Huyện/Quận thành công !!!');
//        } catch ( \Exception $e ) {
//            return $this->sendError("", '');
//        }
//    }
//
//    public function get_commune(Request $request){
//        $response = Curl::to('https://api.mysupership.vn/v1/partner/areas/commune?district='.$request["current_district"])
//            ->get();
//
//        $res = json_decode($response,true);
//
//        try {
//            return $this->sendResponse($res["results"], 'Lấy thông tin Xã/Phường thành công !!!');
//        } catch ( \Exception $e ) {
//            return $this->sendError("", '');
//        }
//    }
//
//    public function predict_fee(Request $request){
//
//        $response = Curl::to('https://api.mysupership.vn/v1/partner/orders/fee?sender_province='.urlencode($request["city_from"]).'&sender_district='.urlencode($request["district_from"]).'&receiver_province='.urlencode($request["city_to"]).'&receiver_district='.urlencode($request["district_to"]).'&weight='.urlencode($request["weight"]))
//            ->get();
//
//        $data = json_decode($response,true);
//
//        try {
//            return $this->sendResponse($data["results"][0]["fee"], 'Tính cước phí thành công !!!');
//        } catch ( \Exception $e ) {
//            return $this->sendError("Địa chỉ sai / Khối lượng nhập sai / Khối lượng đã lớn hơn 20000", '');
//        }
//    }
//
//    public function send_form(Request $request){
//
//        $validator = Validator::make($request->all(), [
//            'sender-fullname' => 'required|min:5|max:255',
//            'receiver-fullname' => 'required|min:5|max:255',
//            'sender-email' => 'required',
//            'sender-fee' => 'required',
//            'sender-mobile' => 'required|max:20',
//            'receiver-mobile' => 'required|max:20',
//            'sender-city' => 'required',
//            'sender-district' => 'required',
//            'sender-commune' => 'required',
//            'sender-address' => 'required',
//            'receiver-city' => 'required',
//            'receiver-district' => 'required',
//            'receiver-commune' => 'required',
//            'receiver-address' => 'required',
//            'sender-note' => 'max:255',
//            'who-pay' => 'required',
//            'sender-weight' => 'required'
//        ],
//            [
//                'sender-fullname.required' => 'Vui Lòng Nhập Họ Tên Người Gửi',
//                'sender-fullname.min' => 'Tên Người Gửi Có Tối Thiểu 5 Ký Tự',
//                'sender-fullname.max' => 'Tên Người Gửi Có Tối Đa 255 Ký Tự',
//                'receiver-fullname.required' => 'Vui Lòng Nhập Họ Tên Người Nhận',
//                'receiver-fullname.min' => 'Tên Người Nhận Có Tối Thiểu 5 Ký Tự',
//                'receiver-fullname.max' => 'Tên Người Nhận Có Tối Đa 255 Ký Tự',
//                'sender-email.required' => 'Vui Lòng Nhập Địa Chỉ Email Người Gửi',
//                'sender-fee.required' => 'Vui Lòng Đính Kèm Cước Phí',
//                'sender-mobile.required' => 'Vui Lòng Nhập Số Điện Thoại Người Gửi',
//                'sender-mobile.max' => 'Số Điện Thoại Người Gửi Có Tối Đa 20 Ký Tự',
//                'receiver-mobile.required' => 'Vui Lòng Nhập Số Điện Thoại Người Nhận',
//                'receiver-mobile.max' => 'Số Điện Thoại Người Nhận Có Tối Đa 20 Ký Tự',
//                'sender-city.required' => 'Vui Lòng Nhập Tỉnh/Thành phố Người Gửi',
//                'sender-district.required' => 'Vui Lòng Nhập Huyện/Quận Người Gửi',
//                'sender-commune.required' => 'Vui Lòng Nhập Xã/Phường Người Gửi',
//                'sender-address.required' => 'Vui Lòng Nhập Địa Chỉ phố Người Gửi',
//                'receiver-city.required' => 'Vui Lòng Nhập Tỉnh/Thành phố Người Nhận',
//                'receiver-district.required' => 'Vui Lòng Nhập Huyện/Quận Người Nhận',
//                'receiver-commune.required' => 'Vui Lòng Nhập Xã/Phường Người Nhận',
//                'receiver-address.required' => 'Vui Lòng Nhập Địa Chỉ phố Người Nhận',
//                'sender-note.max' => 'Nội Dung Có Tối Đa 255 Ký Tự',
//                'who-pay.required' => 'Vui Lòng Chọn Người Trả Cước Phí',
//                'sender-weight.required' => 'Vui Lòng Nhập Trọng Lượng'
//            ]);
//
//        if ($validator->fails()) {
//            return $this->sendError("Đã có lỗi xảy ra !!!", $validator->errors());
//        }
//
//        $form = new FormInfo();
//        $form_id = $this->getToken(19);
//        $form["form_id"] = $form_id;
//        $form["form_sender_mobile"] = $request["sender-mobile"];
//        $form["form_sender_fullname"] = $request["sender-fullname"];
//        $form["form_sender_address"] = $request["sender-address"];
//        $form["form_sender_city"] = $request["sender-city"];
//        $form["form_sender_district"] = $request["sender-district"];
//        $form["form_sender_commune"] = $request["sender-commune"];
//        $form["form_sender_fee"] = $request["sender-fee"];
//        $form["form_sender_note"] = $request["sender-note"];
//        $form["form_sender_money"] = $request["sender-money"];
//        $form["form_sender_email"] = $request["sender-email"];
//        $form["form_sender_weight"] = $request["sender-weight"];
//        $form["form_who_pay"] = $request["who-pay"];
//        $form["form_receiver_mobile"] = $request["receiver-mobile"];
//        $form["form_receiver_fullname"] = $request["receiver-fullname"];
//        $form["form_receiver_address"] = $request["receiver-address"];
//        $form["form_receiver_city"] = $request["receiver-city"];
//        $form["form_receiver_district"] = $request["receiver-district"];
//        $form["form_receiver_commune"] = $request["receiver-commune"];
//        $form["form_creation_date"] = Carbon::now()->timestamp;
//        $form->save();
//
//        try {
//            Mail::to($request["sender-email"])->send(new EmailNotice($form_id,$request["sender-fullname"]));
//        } catch ( \Exception $e ) {
//
//        }
//
//        return $this->sendResponse([], 'Gửi thành công !!! Bộ phận chăm sóc khách hàng sẽ nhanh chóng liên hệ với bạn qua email');
//
//    }
//
//    public function send_food_form(Request $request){
//
//        $validator = Validator::make($request->all(), [
//            'sender-fullname' => 'required|min:5|max:255',
//            'sender-email' => 'required',
//            'sender-mobile' => 'required|max:20',
//            'sender-city' => 'required',
//            'sender-district' => 'required',
//            'sender-commune' => 'required',
//            'sender-address' => 'required',
//            'sender-note' => 'max:255',
//            'sender-type' => 'required'
//        ],
//            [
//                'sender-fullname.required' => 'Vui Lòng Nhập Họ Tên Người Gửi',
//                'sender-fullname.min' => 'Tên Người Gửi Có Tối Thiểu 5 Ký Tự',
//                'sender-fullname.max' => 'Tên Người Gửi Có Tối Đa 255 Ký Tự',
//                'sender-email.required' => 'Vui Lòng Nhập Địa Chỉ Email Người Gửi',
//                'sender-mobile.required' => 'Vui Lòng Nhập Số Điện Thoại Người Gửi',
//                'sender-mobile.max' => 'Số Điện Thoại Người Gửi Có Tối Đa 20 Ký Tự',
//                'sender-city.required' => 'Vui Lòng Nhập Tỉnh/Thành phố Người Gửi',
//                'sender-district.required' => 'Vui Lòng Nhập Huyện/Quận Người Gửi',
//                'sender-commune.required' => 'Vui Lòng Nhập Xã/Phường Người Gửi',
//                'sender-address.required' => 'Vui Lòng Nhập Địa Chỉ phố Người Gửi',
//                'sender-note.max' => 'Nội Dung Có Tối Đa 255 Ký Tự',
//                'sender-type.required' => 'Vui Lòng Chọn Loại Đồ'
//            ]);
//
//        if ($validator->fails()) {
//            return $this->sendError("Đã có lỗi xảy ra !!!", $validator->errors());
//        }
//
//        $form = new FormFoodInfo();
//        $form_food_id = $this->getToken(18);
//        $form["form_food_id"] = $form_food_id;
//        $form["form_food_mobile"] = $request["sender-mobile"];
//        $form["form_food_fullname"] = $request["sender-fullname"];
//        $form["form_food_address"] = $request["sender-address"];
//        $form["form_food_city"] = $request["sender-city"];
//        $form["form_food_district"] = $request["sender-district"];
//        $form["form_food_commune"] = $request["sender-commune"];
//        $form["form_food_note"] = $request["sender-note"];
//        $form["form_food_email"] = $request["sender-email"];
//        $form["form_food_type"] = $request["sender-type"];
//        $form["form_food_creation_date"] = Carbon::now()->timestamp;
//        $form->save();
//
//        try {
//            Mail::to($request["sender-email"])->send(new EmailFoodNotice($form_food_id,$request["sender-fullname"]));
//        } catch ( \Exception $e ) {
//
//        }
//
//        return $this->sendResponse([], 'Gửi thành công !!! Bộ phận chăm sóc khách hàng sẽ nhanh chóng liên hệ với bạn qua email');
//
//    }
//
//    public function send_contact(Request $request){
//
//        $validator = Validator::make($request->all(), [
//            'contact_fullname' => 'required|min:5|max:255',
//            'contact_email' => 'required',
//            'contact_mobile' => 'required|max:20',
//            'contact_content' => 'required|max:255'
//        ],
//        [
//            'contact_fullname.required' => 'Vui Lòng Nhập Họ Tên',
//            'contact_fullname.min' => 'Tên Có Tối Thiểu 5 Ký Tự',
//            'contact_fullname.max' => 'Tên Có Tối Đa 255 Ký Tự',
//            'contact_email.required' => 'Vui Lòng Nhập Địa Chỉ Email',
//            'contact_mobile.required' => 'Vui Lòng Nhập Số Điện Thoại',
//            'contact_mobile.max' => 'Số Điện Thoại Có Tối Đa 20 Ký Tự',
//            'contact_content.required' => 'Nội Dung Có Tối Đa 255 Ký Tự'
//        ]);
//
//        if ($validator->fails()) {
//            return $this->sendError("Đã có lỗi xảy ra !!!", $validator->errors());
//        }
//
//        $contact = new ContactInfo();
//        $contact["contact_fullname"] = $request["contact_fullname"];
//        $contact["contact_mobile"] = $request["contact_mobile"];
//        $contact["contact_email"] = $request["contact_email"];
//        $contact["contact_content"] = $request["contact_content"];
//        $contact["contact_creation_date"] = Carbon::now()->timestamp;
//        $contact->save();
//
//        return $this->sendResponse([], 'Gửi thành công !!! Bộ phận chăm sóc khách hàng sẽ nhanh chóng liên hệ với bạn qua email');
//    }
//
//    public function get_your_form(Request $request){
//
//        $form_db = FormInfo::where('form_id', $request["form_id"])->get();
//        $form_db = $form_db->first();
//
//        return $this->sendResponse($form_db, 'Yêu cầu thành công !!!');
//    }

}
