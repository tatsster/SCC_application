<?php


namespace App\Http\Controllers;


use App\BuildingInfo;
use App\DeviceLogInfo;
use App\FloorInfo;
use App\RoomInfo;
use App\DeviceInfo;
use App\SensorInfo;
use App\SensorLogInfo;
use Carbon\Carbon;
use Cocur\BackgroundProcess\BackgroundProcess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class ReportController extends MainController {

    /* Create building */

    public function create_building(Request $request){

        $building = BuildingInfo::where("building_name",$request["building"])->get();

        $floor = FloorInfo::where("floor_building",$request["building"])->where("floor_name",$request["floor"])->get();

        $room = RoomInfo::where("room_building",$request["building"])->where("room_floor",$request["floor"])->where("room_name",$request["room"])->get();

        if (count($building) > 0 && count($floor) > 0 && count($room) > 0) {
            abort(400);
        }
        else {

            $building = new BuildingInfo();

            $building["building_name"] = $request["building"];
            $building->save();

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
                "building" => $building
            );

            $floor = FloorInfo::where("floor_building",$request["building"])->orderBy('floor_name')->get();

            foreach($floor as $each_floor){

                $room_array = [];

                $room = RoomInfo::where("room_building",$request["building"])->where("room_floor",$each_floor["floor_name"])->orderBy('room_name')->get();

                foreach($room as $each_room){

                    array_push($room_array,$each_room);

                }

                $current_building[$each_floor["floor_name"]] = array($each_floor,$room_array);

            }

            $request->session()->put("1752051_current_building",$current_building);

            echo "Success";

        }

    }

    /* Choose building to edit */

    public function choose_building(Request $request){

//        echo 1;

        $building = BuildingInfo::where("building_name",$request["building"])->first();

        $current_building = array(
            "building" => $building
        );

        $floor = FloorInfo::where("floor_building",$request["building"])->orderBy('floor_name')->get();

        foreach($floor as $each_floor){

            $room_array = [];

            $room = RoomInfo::where("room_building",$request["building"])->where("room_floor",$each_floor["floor_name"])->orderBy('room_name')->get();

            foreach($room as $each_room){

                array_push($room_array,$each_room);

            }

            $current_building[$each_floor["floor_name"]] = array($each_floor,$room_array);

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

    /* Rename building */

    public function rename_building(Request $request){

        $building = BuildingInfo::where('building_name',$request["building"])->get();

        if (count($building) > 0){
            abort(400);
        }
        else{
            $building = BuildingInfo::where('building_name',$request["current_building"])->first();
            $building["building_name"] = $request["building"];
            $building->save();

            $building = FloorInfo::where('floor_building',$request["current_building"])->get();

            foreach ($building as $each) {
                $each["floor_building"] = $request["building"];
                $each->save();
            }

            $building = RoomInfo::where('room_building',$request["current_building"])->get();

            foreach ($building as $each) {
                $each["room_building"] = $request["building"];
                $each->save();
            }

            $building = SensorInfo::where('sensor_building_name',$request["current_building"])->get();
            if (count($building) > 0){

                foreach ($building as $each) {
                    $each["sensor_building_name"] = $request["building"];
                    $each->save();
                }

            }

            $building = DeviceInfo::where('device_building_name',$request["current_building"])->get();
            if (count($building) > 0){

                foreach ($building as $each) {
                    $each["device_building_name"] = $request["building"];
                    $each->save();
                }

            }

            $this->choose_building($request);

            echo "Success";

        }

    }

    /* Delete building */

    public function delete_building(Request $request){

        BuildingInfo::where('building_name',$request["building"])->delete();

        FloorInfo::where('floor_building',$request["building"])->delete();

        RoomInfo::where('room_building',$request["building"])->delete();

        SensorInfo::where('sensor_building_name',$request["building"])->delete();

        DeviceInfo::where('device_building_name',$request["building"])->delete();

        $request->session()->forget("1752051_current_building");

        echo "Success";

    }

    /* Create floor */

    public function create_floor(Request $request){

        $floor = FloorInfo::where("floor_building",$request["building"])->where("floor_name",$request["floor"])->get();

        $room = RoomInfo::where("room_building",$request["building"])->where("room_floor",$request["floor"])->where("room_name",$request["room"])->get();

        if (count($floor) > 0 && count($room) > 0) {
            abort(400);
        }
        else {

            $floor = new FloorInfo();

            $floor["floor_building"] = $request["building"];
            $floor["floor_name"] = $request["floor"];
            $floor->save();

            $room= new RoomInfo();

            $room["room_building"] = $request["building"];
            $room["room_floor"] = $request["floor"];
            $room["room_name"] = $request["room"];
            $room->save();

            $building = BuildingInfo::where("building_name",$request["building"])->first();

            $current_building = array(
                "building" => $building
            );

            $floor = FloorInfo::where("floor_building",$request["building"])->orderBy('floor_name')->get();

            foreach($floor as $each_floor){

                $room_array = [];

                $room = RoomInfo::where("room_building",$request["building"])->where("room_floor",$each_floor["floor_name"])->orderBy('room_name')->get();

                foreach($room as $each_room){

                    array_push($room_array,$each_room);

                }

                $current_building[$each_floor["floor_name"]] = array($each_floor,$room_array);

            }

            $request->session()->put("1752051_current_building",$current_building);

            echo "Success";

        }

    }

    /* Rename floor */

    public function rename_floor(Request $request){

        $building = FloorInfo::where('floor_building',$request["building"])->where('floor_name',$request["new_floor"])->get();

        if (count($building) > 0){
            abort(400);
        }
        else{
            $building = FloorInfo::where('floor_building',$request["building"])->where('floor_name',$request["current_floor"])->get();
            foreach ($building as $each) {
                $each["floor_name"] = $request["new_floor"];
                $each->save();
            }

            $building = RoomInfo::where('room_building',$request["building"])->where('room_floor',$request["current_floor"])->get();

            foreach ($building as $each) {
                $each["room_floor"] = $request["new_floor"];
                $each->save();
            }

            $building = SensorInfo::where('sensor_building_name',$request["building"])->where('sensor_floor_name',$request["current_floor"])->get();
            if (count($building) > 0){

                foreach ($building as $each) {
                    $each["sensor_floor_name"] = $request["new_floor"];
                    $each->save();
                }

            }

            $building = DeviceInfo::where('device_building_name',$request["building"])->where('device_floor_name',$request["current_floor"])->get();
            if (count($building) > 0){

                foreach ($building as $each) {
                    $each["device_floor_name"] = $request["new_floor"];
                    $each->save();
                }

            }

            $this->choose_building($request);

            echo "Success";

        }

    }

    /* Delete floor */

    public function delete_floor(Request $request){

        FloorInfo::where('floor_building',$request["building"])->where('floor_name',$request["current_floor"])->delete();

        RoomInfo::where('room_building',$request["building"])->where('room_floor',$request["current_floor"])->delete();

        SensorInfo::where('sensor_building_name',$request["building"])->where('sensor_floor_name',$request["current_floor"])->delete();

        DeviceInfo::where('device_building_name',$request["building"])->where('device_floor_name',$request["current_floor"])->delete();

        $this->choose_building($request);

        echo "Success";

    }

    /* Create room */

    public function create_room(Request $request){

        $room = RoomInfo::where("room_building",$request["building"])->where("room_floor",$request["floor"])->where("room_name",$request["room"])->get();

        if (count($room) > 0) {
            abort(400);
        }
        else {

            $room= new RoomInfo();

            $room["room_building"] = $request["building"];
            $room["room_floor"] = $request["floor"];
            $room["room_name"] = $request["room"];
            $room->save();

            $building = BuildingInfo::where("building_name",$request["building"])->first();

            $current_building = array(
                "building" => $building
            );

            $floor = FloorInfo::where("floor_building",$request["building"])->orderBy('floor_name')->get();

            foreach($floor as $each_floor){

                $room_array = [];

                $room = RoomInfo::where("room_building",$request["building"])->where("room_floor",$each_floor["floor_name"])->orderBy('room_name')->get();

                foreach($room as $each_room){

                    array_push($room_array,$each_room);

                }

                $current_building[$each_floor["floor_name"]] = array($each_floor,$room_array);

            }

            $request->session()->put("1752051_current_building",$current_building);

            echo "Success";

        }

    }

    /* Rename room */

    public function rename_room(Request $request){

        $building = RoomInfo::where('room_building',$request["building"])->where('room_floor',$request["current_floor"])->where('room_name',$request["new_room"])->get();

        if (count($building) > 0){
            abort(400);
        }
        else{
            $building = RoomInfo::where('room_building',$request["building"])->where('room_floor',$request["current_floor"])->where('room_name',$request["current_room"])->get();
            foreach ($building as $each) {
                $each["room_name"] = $request["new_room"];
                $each->save();
            }

            $building = SensorInfo::where('sensor_building_name',$request["building"])->where('sensor_floor_name',$request["current_floor"])->where('sensor_room_name',$request["current_room"])->get();
            if (count($building) > 0){

                foreach ($building as $each) {
                    $each["sensor_room_name"] = $request["new_room"];
                    $each->save();
                }

            }

            $building = DeviceInfo::where('device_building_name',$request["building"])->where('device_floor_name',$request["current_floor"])->where('device_room_name',$request["current_room"])->get();
            if (count($building) > 0){

                foreach ($building as $each) {
                    $each["device_room_name"] = $request["new_room"];
                    $each->save();
                }

            }

            $this->choose_building($request);

            echo "Success";

        }

    }

    /* Delete room */

    public function delete_room(Request $request){

        RoomInfo::where('room_building',$request["building"])->where('room_floor',$request["current_floor"])->where('room_name',$request["current_room"])->delete();

        SensorInfo::where('sensor_building_name',$request["building"])->where('sensor_floor_name',$request["current_floor"])->where('sensor_room_name',$request["current_room"])->delete();

        DeviceInfo::where('device_building_name',$request["building"])->where('device_floor_name',$request["current_floor"])->where('device_room_name',$request["current_room"])->delete();

        $this->choose_building($request);

        echo "Success";

    }

    /* Delete all log */

    public function delete_all_log(Request $request){

        if ($request["delete_type"] == 0){
            SensorLogInfo::where('sensor_id',$request->session()->get("1752051_current_sensor")["sensor_id"])->delete();
            $sensor_log = SensorLogInfo::where('sensor_id',$request->session()->get("1752051_current_sensor")["sensor_id"])->orderBy('sensor_timestamp', 'DESC')->get();
            $request->session()->put("1752051_current_sensor_log",$sensor_log);
        }
        else {
            DeviceLogInfo::where('device_id',$request->session()->get("1752051_current_device")["device_id"])->delete();
            $device_log = DeviceLogInfo::where('device_id',$request->session()->get("1752051_current_device")["device_id"])->orderBy('device_timestamp', 'DESC')->get();
            $request->session()->put("1752051_current_device_log",$device_log);
        }

        echo "Success";

    }

    public function delete_log(Request $request){

        if ($request["delete_type"] == 0){
            SensorLogInfo::where('sensor_order',$request["delete_order"])->delete();
            $sensor_log = SensorLogInfo::where('sensor_id',$request->session()->get("1752051_current_sensor")["sensor_id"])->orderBy('sensor_timestamp', 'DESC')->get();
            $request->session()->put("1752051_current_sensor_log",$sensor_log);
        }
        else {
            DeviceLogInfo::where('device_order',$request["delete_order"])->delete();
            $device_log = DeviceLogInfo::where('device_id',$request->session()->get("1752051_current_device")["device_id"])->orderBy('device_timestamp', 'DESC')->get();
            $request->session()->put("1752051_current_device_log",$device_log);
        }

        echo "Success";

    }















    public function create_sensor(Request $request){

        $validator = Validator::make($request->all(), [
            'sensor_id' => 'required|unique:sensor|max:255',
            'sensor_name' => 'required|max:255',
            'sensor_ip' => 'required|max:255|ip',
            'sensor_port' => 'required|integer',
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
                'sensor_ip.ip' => Lang::get('MQTT IP is not valid'),
                'sensor_ip.max' => Lang::get('MQTT IP has maximum 255 characters'),
                'sensor_port.required' => Lang::get('You need to input MQTT port'),
                'sensor_port.max' => Lang::get('MQTT port has maximum 255 characters'),
                'sensor_port.integer' => Lang::get('MQTT port must be integer'),
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

        if ($request["btn-delete"] == 1){

            SensorInfo::where("sensor_id", $request->session()->get("1752051_current_sensor")["sensor_id"])->delete();

            $request->session()->forget("1752051_current_sensor_log");

            $request->session()->forget("1752051_current_sensor");

            return redirect()->back()->with('msg_room', Lang::get("Successfully deleted !!!"))->with('msg_type_room', 'danger');

        }
        else{

            if ($request->session()->get("1752051_current_sensor")["sensor_id"] != $request["sensor_id"]){

                $validator = Validator::make($request->all(), [
                    'sensor_id' => 'required|unique:sensor|max:255',
                    'sensor_name' => 'required|max:255',
                    'sensor_ip' => 'required|max:255|ip',
                    'sensor_port' => 'required|integer',
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
                        'sensor_ip.ip' => Lang::get('MQTT IP is not valid'),
                        'sensor_ip.max' => Lang::get('MQTT IP has maximum 255 characters'),
                        'sensor_port.required' => Lang::get('You need to input MQTT port'),
                        'sensor_port.max' => Lang::get('MQTT port has maximum 255 characters'),
                        'sensor_port.integer' => Lang::get('MQTT port must be integer'),
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

            }

            else {

                $validator = Validator::make($request->all(), [
                    'sensor_id' => 'required|max:255',
                    'sensor_name' => 'required|max:255',
                    'sensor_ip' => 'required|max:255|ip',
                    'sensor_port' => 'required|integer',
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
                        'sensor_ip.ip' => Lang::get('MQTT IP is not valid'),
                        'sensor_ip.max' => Lang::get('MQTT IP has maximum 255 characters'),
                        'sensor_port.required' => Lang::get('You need to input MQTT port'),
                        'sensor_port.max' => Lang::get('MQTT port has maximum 255 characters'),
                        'sensor_port.integer' => Lang::get('MQTT port must be integer'),
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

            $sensor_log = SensorLogInfo::where("sensor_id", $request->session()->get("1752051_current_sensor")["sensor_id"])->get();

            if (count($sensor_log) > 0){

                foreach ($sensor_log as $each){
                    $each["sensor_id"] = $request["sensor_id"];
                    $each->save();
                }

            }

            $sensor = SensorInfo::where("sensor_id", $request["sensor_id"])->first();

            $sensor_log = SensorLogInfo::where("sensor_id", $request["sensor_id"])->orderBy('sensor_timestamp', 'DESC')->get();

            $request->session()->put("1752051_current_sensor_log",$sensor_log);

            $request->session()->put("1752051_current_sensor",$sensor);

            return redirect()->back()->with('msg_room', Lang::get("Successfully updated !!!"))->with('msg_type_room', 'success');

        }

    }

    /* Refresh sensor */

    public function refresh_sensor(Request $request){

        $sensor = SensorInfo::where("sensor_id", $request->session()->get("1752051_current_sensor")["sensor_id"])->first();

        $sensor_log = SensorLogInfo::where("sensor_id", $request->session()->get("1752051_current_sensor")["sensor_id"])->orderBy('sensor_timestamp', 'DESC')->get();

        $request->session()->forget("1752051_sensor_start_datetime");

        $request->session()->forget("1752051_sensor_end_datetime");

        $request->session()->put("1752051_current_sensor_log",$sensor_log);

        $request->session()->put("1752051_current_sensor",$sensor);

        echo "Success";

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

        try {

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

                $process = new BackgroundProcess('python3 /Users/WhiteWolf21/Documents/Heroku/SCC/final/subscribe_real_sensor.py "'.session("1752051_current_sensor")["sensor_username"].'" "'.session("1752051_current_sensor")["sensor_password"].'" "'.session("1752051_current_sensor")["sensor_ip"].'" "'.session("1752051_current_sensor")["sensor_port"].'" "'.session("1752051_current_sensor")["sensor_topic"].'" "'.session("1752051_current_sensor")["sensor_id"].'"');
                # python3 /Users/WhiteWolf21/Documents/Heroku/SCC/final/subscribe_temp_humid.py "BKvm2" "Hcmut_CSE_2020" "13.76.250.158" "1883" "Topic/TempHumi" "TEMP-HUD100"

//            $process->setTimeout(3100000000);

                $process->run();

                $sensor = SensorInfo::where("sensor_id", $request->session()->get("1752051_current_sensor")["sensor_id"])->first();

                $sensor["sensor_pid"] = $process->getPid();

                $sensor->save();

                $sensor = SensorInfo::where("sensor_id", $request->session()->get("1752051_current_sensor")["sensor_id"])->first();

                $request->session()->put("1752051_current_sensor", $sensor);

            }

        } catch ( \Exception $e ) {
//            dd($e);
            abort(404);
        }

    }

    /* Sensor search time range */

    public function sensor_search_time_range(Request $request){

        $times = explode(" - ",$request["sensor_time_range"]);
        $time0 = Carbon::createFromFormat('d/m/Y H:i:s', $times[0])->timestamp;
        $time1 = Carbon::createFromFormat('d/m/Y H:i:s', $times[1])->timestamp;

        $sensor_log = SensorLogInfo::where("sensor_id", $request["sensor_id"])->whereBetween("sensor_timestamp",[$time0,$time1])->orderBy('sensor_timestamp', 'DESC')->get();

        $request->session()->put("1752051_current_sensor_log",$sensor_log);

        $request->session()->put("1752051_sensor_start_datetime",$times[0]);
        $request->session()->put("1752051_sensor_end_datetime",$times[1]);

        return redirect("room");

    }

    /* Get sensor real time temperature */

    public function get_sensor_real_time(Request $request){

        if ($request["sensor_real_time_type"] == 0){

            $each = SensorLogInfo::where("sensor_id", $request["sensor_id"])->orderBy('sensor_timestamp', 'DESC')->first(['sensor_timestamp','sensor_temp']);

            echo $each['sensor_timestamp'].",".$each['sensor_temp'];

        }
        if ($request["sensor_real_time_type"] == 1){

            $each = SensorLogInfo::where("sensor_id", $request["sensor_id"])->orderBy('sensor_timestamp', 'DESC')->first(['sensor_timestamp','sensor_humid']);

            echo $each['sensor_timestamp'].",".$each['sensor_humid'];

        }
        else {

            $each = SensorLogInfo::where("sensor_id", $request["sensor_id"])->orderBy('sensor_timestamp', 'DESC')->first(['sensor_timestamp','sensor_heat_index']);

            echo $each['sensor_timestamp'].",".$each['sensor_heat_index'];

        }

    }

    public function update_sensor_real_time(Request $request){

        $each = SensorLogInfo::where("sensor_id", $request["sensor_id"])->orderBy('sensor_timestamp', 'DESC')->first();

        echo $each['sensor_order'].",".$each['sensor_id'].",".$each['sensor_temp'].",".$each['sensor_humid'].",".$each['sensor_heat_index'].",".$each['sensor_timestamp'];

    }

    public function update_device_real_time(Request $request){

        $each = DeviceLogInfo::where("device_id", $request["device_id"])->orderBy('device_timestamp', 'DESC')->first();

        echo $each['device_order'].",".$each['device_id'].",".$each['device_status'].",".$each['device_status_value'].",".$each['device_hours_usage'].",".$each['device_electrical_consumption'].",".$each['device_timestamp'];

    }

    /*
    |--------------------------------------------------------------------------
    | Room Report
    |--------------------------------------------------------------------------
    |
    |
    |
    */


    /* Create device */

    public function create_device(Request $request){

//        dd($request["device_port"]);

        $validator = Validator::make($request->all(), [
            'device_id' => 'required|unique:device|max:255',
            'device_name' => 'required|max:255',
            'device_ip' => 'required|max:255|ip',
            'device_port' => 'required|integer',
            'device_topic' => 'required|max:255',
            'device_username' => 'max:255',
            'device_password' => 'max:255',
            'device_kwh' => 'required|numeric',
            'device_status_value' => 'required|numeric',
        ],
            [
                'device_id.required' => Lang::get('You need to input sensor ID'),
                'device_id.unique' => Lang::get('This device ID had already existed'),
                'device_id.max' => Lang::get('Device ID has maximum 255 characters'),
                'device_name.required' => Lang::get('You need to input device name'),
                'device_name.max' => Lang::get('Device name has maximum 255 characters'),
                'device_ip.required' => Lang::get('You need to input MQTT IP'),
                'device_ip.max' => Lang::get('MQTT IP has maximum 255 characters'),
                'device_ip.ip' => Lang::get('MQTT IP is not valid'),
                'device_port.required' => Lang::get('You need to input MQTT port'),
                'device_port.integer' => Lang::get('MQTT port must be integer'),
                'device_topic.required' => Lang::get('You need to input MQTT topic'),
                'device_topic.max' => Lang::get('MQTT topic has maximum 255 characters'),
                'device_username.max' => Lang::get('MQTT username has maximum 255 characters'),
                'device_password.max' => Lang::get('MQTT password has maximum 255 characters'),
                'device_kwh.numeric' => Lang::get('Device electrical consumption must be numeric'),
                'device_kwh.required' => Lang::get('You need to input device electrical consumption'),
                'device_status_value.numeric' => Lang::get('Device status value must be numeric'),
                'device_status_value.required' => Lang::get('You need to input device status value')
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

        $device = new DeviceInfo();
        $device["device_floor_name"] = $request->session()->get("1752051_room_floor");
        $device["device_room_name"] = $request->session()->get("1752051_room_name");
        $device["device_building_name"] = $request->session()->get("1752051_room_building");
        $device["device_id"] = $request["device_id"];
        $device["device_name"] = $request["device_name"];
        $device["device_status_value"] = $request["device_status_value"];
        $device["device_kwh"] = $request["device_kwh"];
        $device["device_ip"] = $request["device_ip"];
        $device["device_port"] = $request["device_port"];
        $device["device_topic"] = $request["device_topic"];
        $device["device_username"] = $request["device_username"];
        $device["device_password"] = $request["device_password"];
        $device->save();

        $device = DeviceInfo::where("device_id", $request["device_id"])->first();

        $device_log = DeviceLogInfo::where("device_id", $request["device_id"])->orderBy('device_timestamp', 'DESC')->get();

        $request->session()->put("1752051_current_device",$device);

        $request->session()->put("1752051_current_device_log",$device_log);

        return redirect()->back()->with('msg_room', Lang::get("Successfully created !!!"))->with('msg_type_room', 'success');

    }

    /* Update device */

    public function update_device(Request $request){

        if ($request["btn-delete"] == 1){

            DeviceInfo::where("device_id", $request->session()->get("1752051_current_device")["device_id"])->delete();

            $request->session()->forget("1752051_current_device_log");

            $request->session()->forget("1752051_current_device");

            return redirect()->back()->with('msg_room', Lang::get("Successfully deleted !!!"))->with('msg_type_room', 'danger');

        }
        else{

            if ($request->session()->get("1752051_current_device")["device_id"] != $request["device_id"]){

                $validator = Validator::make($request->all(), [
                    'device_id' => 'required|unique:device|max:255',
                    'device_name' => 'required|max:255',
                    'device_ip' => 'required|max:255',
                    'device_port' => 'required|integer',
                    'device_topic' => 'required|max:255',
                    'device_username' => 'max:255',
                    'device_password' => 'max:255',
                    'device_auto_based_on_sensor_topic' => 'max:255',
                    'device_kwh' => 'required|numeric',
                    'device_status_value' => 'required|numeric',
                ],
                    [
                        'device_id.required' => Lang::get('You need to input device ID'),
                        'device_id.unique' => Lang::get('This device ID had already existed'),
                        'device_id.max' => Lang::get('Device ID has maximum 255 characters'),
                        'device_name.required' => Lang::get('You need to input device name'),
                        'device_name.max' => Lang::get('Device name has maximum 255 characters'),
                        'device_ip.required' => Lang::get('You need to input MQTT IP'),
                        'device_ip.max' => Lang::get('MQTT IP has maximum 255 characters'),
                        'device_ip.ip' => Lang::get('MQTT IP is not valid'),
                        'device_port.required' => Lang::get('You need to input MQTT port'),
                        'device_port.integer' => Lang::get('MQTT port must be integer'),
                        'device_topic.required' => Lang::get('You need to input MQTT topic'),
                        'device_topic.max' => Lang::get('MQTT topic has maximum 255 characters'),
                        'device_username.max' => Lang::get('MQTT username has maximum 255 characters'),
                        'device_password.max' => Lang::get('MQTT password has maximum 255 characters'),
                        'device_auto_based_on_sensor_topic.max' => Lang::get('Device auto based on sensor topic has maximum 255 characters'),
                        'device_kwh.numeric' => Lang::get('Device electrical consumption must be numeric'),
                        'device_kwh.required' => Lang::get('You need to input device electrical consumption'),
                        'device_status_value.numeric' => Lang::get('Device status value must be numeric'),
                        'device_status_value.required' => Lang::get('You need to input device status value')
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

            }

            else {

                $validator = Validator::make($request->all(), [
                    'device_id' => 'required|max:255',
                    'device_name' => 'required|max:255',
                    'device_ip' => 'required|max:255|ip',
                    'device_port' => 'required|integer',
                    'device_topic' => 'required|max:255',
                    'device_username' => 'max:255',
                    'device_password' => 'max:255',
                    'device_auto_based_on_sensor_topic' => 'max:255',
                    'device_kwh' => 'required|numeric',
                    'device_status_value' => 'required|numeric',
                    'device_lower_threshold' => 'numeric',
                    'device_upper_threshold' => 'numeric',
                ],
                    [
                        'device_id.required' => Lang::get('You need to input sensor ID'),
                        'device_id.max' => Lang::get('Device ID has maximum 255 characters'),
                        'device_name.required' => Lang::get('You need to input device name'),
                        'device_name.max' => Lang::get('Device name has maximum 255 characters'),
                        'device_ip.required' => Lang::get('You need to input MQTT IP'),
                        'device_ip.max' => Lang::get('MQTT IP has maximum 255 characters'),
                        'device_ip.ip' => Lang::get('MQTT IP is not valid'),
                        'device_port.required' => Lang::get('You need to input MQTT port'),
                        'device_port.integer' => Lang::get('MQTT port must be integer'),
                        'device_topic.required' => Lang::get('You need to input MQTT topic'),
                        'device_topic.max' => Lang::get('MQTT topic has maximum 255 characters'),
                        'device_username.max' => Lang::get('MQTT username has maximum 255 characters'),
                        'device_password.max' => Lang::get('MQTT password has maximum 255 characters'),
                        'device_auto_based_on_sensor_topic.max' => Lang::get('Device auto based on sensor topic has maximum 255 characters'),
                        'device_kwh.numeric' => Lang::get('Device electrical consumption must be numeric'),
                        'device_kwh.required' => Lang::get('You need to input device electrical consumption'),
                        'device_status_value.numeric' => Lang::get('Device status value must be numeric'),
                        'device_status_value.required' => Lang::get('You need to input device status value'),
                        'device_lower_threshold.numeric' => Lang::get('Device lower threshold must be numeric'),
                        'device_upper_threshold.numeric' => Lang::get('Device upper threshold must be numeric')
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

            }

            $device = DeviceInfo::where("device_id", $request->session()->get("1752051_current_device")["device_id"])->first();
            $device["device_floor_name"] = $request->session()->get("1752051_room_floor");
            $device["device_room_name"] = $request->session()->get("1752051_room_name");
            $device["device_building_name"] = $request->session()->get("1752051_room_building");
            $device["device_id"] = $request["device_id"];
            $device["device_name"] = $request["device_name"];

            $device["device_status_value"] = $request["device_status_value"];
            $device["device_kwh"] = $request["device_kwh"];
            $device["device_ip"] = $request["device_ip"];
            $device["device_port"] = $request["device_port"];
            $device["device_topic"] = $request["device_topic"];
            $device["device_username"] = $request["device_username"];
            $device["device_password"] = $request["device_password"];
            $device["device_lower_threshold"] = $request["device_lower_threshold"];
            $device["device_upper_threshold"] = $request["device_upper_threshold"];
            $device["device_auto_based_on_sensor_topic"] = $request["device_auto_based_on_sensor_topic"];
            $device->save();

            $device_log = DeviceLogInfo::where("device_id", $request->session()->get("1752051_current_device")["device_id"])->get();

            if (count($device_log) > 0){

                foreach ($device_log as $each){
                    $each["device_id"] = $request["device_id"];
                    $each->save();
                }

            }

            $device = DeviceInfo::where("device_id", $request["device_id"])->first();

            $device_log = DeviceLogInfo::where("device_id", $request["device_id"])->orderBy('device_timestamp', 'DESC')->get();

            $request->session()->put("1752051_current_device_log",$device_log);

            $request->session()->put("1752051_current_device",$device);

            return redirect()->back()->with('msg_room', Lang::get("Successfully updated !!!"))->with('msg_type_room', 'success');

        }

    }

    /* Refresh device */

    public function refresh_device(Request $request){

        $device = DeviceInfo::where("device_id", $request->session()->get("1752051_current_device")["device_id"])->first();

        $device_log = DeviceLogInfo::where("device_id", $request->session()->get("1752051_current_device")["device_id"])->orderBy('device_timestamp', 'DESC')->get();

        $request->session()->forget("1752051_device_start_datetime");

        $request->session()->forget("1752051_device_end_datetime");

        $request->session()->put("1752051_current_device_log",$device_log);

        $request->session()->put("1752051_current_device",$device);

        echo "Success";

    }

    /* Choose device */

    public function choose_device(Request $request){

        $device = DeviceInfo::where("device_id", $request["device_id"])->first();

        $device_log = DeviceLogInfo::where("device_id", $request["device_id"])->orderBy('device_timestamp', 'DESC')->get();

        $request->session()->put("1752051_current_device",$device);

        $request->session()->put("1752051_current_device_log",$device_log);

        /* Calculate hours usage and electrical usage */

        $enum = array(
            "device_kwh" => 4,
        );

        $hours_usage_plot = array();
        $electrical_consumption = array();

        $device_log_db = DeviceLogInfo::where("device_id", $request["device_id"])->orderBy('device_timestamp', 'DESC')->get();

        $hours_usage = 0;
        $electrical_consumption = 0;
        $current_timestamp = 0;

//        foreach($device_log_db as $device_log_each){
//            $status = explode(",",str_replace("[","",str_replace("]","",$device_log_each->device_status)));
//
//
//
////            if ($hours_usage_plot[])
//
//            if ($status[0] == '"1"'){
//                $current_timestamp = $device_log_each->device_timestamp;
//            }
//            else{
//                $past_hours = ($device_log_each->device_timestamp - $current_timestamp) / 3600;
//                $hours_usage += $past_hours;
//
//                $device_kwh = floatval(explode(",",str_replace("[","",str_replace("[","",$device_log_each->device_additional)))[$enum["device_kwh"]]);
//                $electrical_consumption +=  $past_hours * $device_kwh;
//                $current_timestamp = 0;
//            }
//        }
//
//        $hours_usage = round($hours_usage,2);
//        $electrical_consumption = round($electrical_consumption,2);

        $request->session()->put("1752051_device_hours_usage",$hours_usage);
        $request->session()->put("1752051_device_hours_usage",$electrical_consumption);

        echo "Success";

    }

    /* Run / Stop device */

    public function run_stop_device(Request $request){

        try {

            if ($request["button"] == 1){

//            echo 1;

                $process = new Process('python3 /Users/WhiteWolf21/Documents/Heroku/SCC/final/publish_real_device.py "'.session("1752051_current_device")["device_username"].'" "'.session("1752051_current_device")["device_password"].'" "'.session("1752051_current_device")["device_ip"].'" "'.session("1752051_current_device")["device_port"].'" "'.session("1752051_current_device")["device_topic"].'" ["0","0"] "'.session("1752051_current_device")["device_id"].'"');
                # python3 /Users/WhiteWolf21/Documents/Heroku/SCC/final/subscribe_temp_humid.py "BKvm2" "Hcmut_CSE_2020" "13.76.250.158" "1883" "Topic/TempHumi" "TEMP-HUD100"

//            echo 2;


                $process->run();

                if (!$process->isSuccessful()) {
//                echo 3;

                    throw new ProcessFailedException($process);
                }

                $device = DeviceInfo::where("device_id", $request->session()->get("1752051_current_device")["device_id"])->first();

                $process = new Process('kill -9 '.$device["device_pid"]);

                $process->run();

                $device["device_pid"] = null;

                $device->save();

                $device_log = DeviceLogInfo::where("device_id", $request->session()->get("1752051_current_device")["device_id"])->orderBy('device_timestamp', 'DESC')->first();

                if ($device_log["device_status"] == true) {

                    $device_kwh = DeviceInfo::where("device_id", $request->session()->get("1752051_current_device")["device_id"])->first(["device_kwh"])["device_kwh"];

                    $device_new_log = new DeviceLogInfo();

                    $device_new_log["device_id"] = $request->session()->get("1752051_current_device")["device_id"];
                    $device_new_log["device_status"] = false;

                    $timestamp_now = Carbon::now()->timestamp;

                    $device_new_log["device_timestamp"] = $timestamp_now;
                    $device_new_log["device_status_value"] = $request->session()->get("1752051_current_device")["device_status_value"];

                    $hours_duration = floatval($timestamp_now - intval($device_log["device_timestamp"])) / 3600.0;
                    $device_new_log["device_hours_usage"] = $hours_duration;

                    $device_new_log["device_electrical_consumption"] = $hours_duration * floatval($device_kwh);

                    $device_new_log->save();

                }

                $device_log = DeviceLogInfo::where("device_id", $request->session()->get("1752051_current_device")["device_id"])->orderBy('device_timestamp', 'DESC')->get();

                $device = DeviceInfo::where("device_id", $request->session()->get("1752051_current_device")["device_id"])->first();

                $request->session()->put("1752051_current_device",$device);

                $request->session()->put("1752051_current_device_log",$device_log);

            }
            else {

//            echo 1;

                $process = new Process('python3 /Users/WhiteWolf21/Documents/Heroku/SCC/final/publish_real_device.py "'.session("1752051_current_device")["device_username"].'" "'.session("1752051_current_device")["device_password"].'" "'.session("1752051_current_device")["device_ip"].'" "'.session("1752051_current_device")["device_port"].'" "'.session("1752051_current_device")["device_topic"].'" ["1",'.session("1752051_current_device")["device_status_value"].'] "'.session("1752051_current_device")["device_id"].'"');
                # python3 /Users/WhiteWolf21/Documents/Heroku/SCC/final/subscribe_temp_humid.py "BKvm2" "Hcmut_CSE_2020" "13.76.250.158" "1883" "Topic/TempHumi" "TEMP-HUD100"

                // waiting for process to finish

                $device_log = new DeviceLogInfo();

                $device_log["device_id"] = $request->session()->get("1752051_current_device")["device_id"];
                $device_log["device_status"] = true;

                $timestamp_now = Carbon::now()->timestamp;

                $device_log["device_timestamp"] = $timestamp_now;
                $device_log["device_status_value"] = $request->session()->get("1752051_current_device")["device_status_value"];
                $device_log->save();

                $device = DeviceInfo::where("device_id", $request->session()->get("1752051_current_device")["device_id"])->first();

                $process->start();

                $device["device_pid"] = $process->getPid();

                $process->wait();

                $device->save();

                $device_log = DeviceLogInfo::where("device_id", $request->session()->get("1752051_current_device")["device_id"])->orderBy('device_timestamp', 'DESC')->get();

                $device = DeviceInfo::where("device_id", $request->session()->get("1752051_current_device")["device_id"])->first();

                $request->session()->put("1752051_current_device", $device);

                $request->session()->put("1752051_current_device_log",$device_log);

            }

        } catch ( \Exception $e ) {
//            echo $e;
            abort(404);
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

    /* Sensor search time range */


    public function device_search_time_range(Request $request){

        $times = explode(" - ",$request["device_time_range"]);
        $time0 = Carbon::createFromFormat('d/m/Y H:i:s', $times[0])->timestamp;
        $time1 = Carbon::createFromFormat('d/m/Y H:i:s', $times[1])->timestamp;

        $device_log = DeviceLogInfo::where("device_id", $request["device_id"])->whereBetween("device_timestamp",[$time0,$time1])->orderBy('device_timestamp', 'DESC')->get();

        $request->session()->put("1752051_current_device_log",$device_log);

        $request->session()->put("1752051_device_start_datetime",$times[0]);
        $request->session()->put("1752051_device_end_datetime",$times[1]);

        return redirect("room");

    }

    /* Deactivate room */

    public function activate_deactivate_room(Request $request){
//        echo 1;
        if ($request["button"] == 1) {

            $sensors = SensorInfo::where("sensor_building_name", $request["building"])->where("sensor_floor_name", $request["current_floor"])->where("sensor_room_name", $request["current_room"])->get();

            if (count($sensors) > 0) {

                foreach ($sensors as $each_sensor) {
                    if ($each_sensor["sensor_pid"] != null) {
                        $request["sensor_id"] = $each_sensor["sensor_id"];
                        $this->choose_sensor($request);

                        $this->run_stop_sensor($request);
                    }
                }

            }

            $devices = DeviceInfo::where("device_building_name", $request["building"])->where("device_floor_name", $request["current_floor"])->where("device_room_name", $request["current_room"])->get();

            if (count($devices) > 0) {

                foreach ($devices as $each_device) {
                    if ($each_device["device_pid"] != null) {
                        $request["device_id"] = $each_device["device_id"];
                        $this->choose_device($request);

                        $this->run_stop_device($request);
                    }
                }

            }

            $room = RoomInfo::where("room_building", $request["building"])->where("room_floor", $request["current_floor"])->where("room_name", $request["current_room"])->first();

            $room["room_active"] = false;
            $room->save();

        }

        else {

            $sensors = SensorInfo::where("sensor_building_name", $request["building"])->where("sensor_floor_name", $request["current_floor"])->where("sensor_room_name", $request["current_room"])->get();

            if (count($sensors) > 0) {

                foreach ($sensors as $each_sensor) {
                    if ($each_sensor["sensor_pid"] == null) {
                        $request["sensor_id"] = $each_sensor["sensor_id"];
                        $this->choose_sensor($request);

                        $this->run_stop_sensor($request);
                    }
                }

            }

            $devices = DeviceInfo::where("device_building_name", $request["building"])->where("device_floor_name", $request["current_floor"])->where("device_room_name", $request["current_room"])->get();

            if (count($devices) > 0) {

                foreach ($devices as $each_device) {
                    if ($each_device["device_pid"] == null) {
                        $request["device_id"] = $each_device["device_id"];
                        $this->choose_device($request);

                        $this->run_stop_device($request);
                    }
                }

            }

            $room = RoomInfo::where("room_building", $request["building"])->where("room_floor", $request["current_floor"])->where("room_name", $request["current_room"])->first();

            $room["room_active"] = true;
            $room->save();

        }

        $this->choose_building($request);

        echo "Success";

    }

    /* Deactivate floor */

    public function activate_deactivate_floor(Request $request){

//        echo 1;

        if ($request["button"] == 1) {

            $sensors = SensorInfo::where("sensor_building_name", $request["building"])->where("sensor_floor_name", $request["current_floor"])->get();

            if (count($sensors) > 0) {

                foreach ($sensors as $each_sensor) {
                    if ($each_sensor["sensor_pid"] != null) {
                        $request["sensor_id"] = $each_sensor["sensor_id"];
                        $this->choose_sensor($request);

                        $this->run_stop_sensor($request);
                    }
                }

            }

            $devices = DeviceInfo::where("device_building_name", $request["building"])->where("device_floor_name", $request["current_floor"])->get();

            if (count($devices) > 0) {

                foreach ($devices as $each_device) {
                    if ($each_device["device_pid"] != null) {
                        $request["device_id"] = $each_device["device_id"];
                        $this->choose_device($request);

                        $this->run_stop_device($request);
                    }
                }

            }

            $floor = FloorInfo::where("floor_building", $request["building"])->where("floor_name", $request["current_floor"])->first();

            $floor["floor_active"] = false;
            $floor->save();

            $room = RoomInfo::where("room_building", $request["building"])->where("room_floor", $request["current_floor"])->get();

            if (count($room) > 0) {

                foreach ($room as $each) {
                    $each["room_active"] = false;
                    $each->save();
                }
            }

        }

        else {

            $sensors = SensorInfo::where("sensor_building_name", $request["building"])->where("sensor_floor_name", $request["current_floor"])->get();

            if (count($sensors) > 0) {

                foreach ($sensors as $each_sensor) {
                    if ($each_sensor["sensor_pid"] == null) {
                        $request["sensor_id"] = $each_sensor["sensor_id"];
                        $this->choose_sensor($request);

                        $this->run_stop_sensor($request);
                    }
                }

            }

            $devices = DeviceInfo::where("device_building_name", $request["building"])->where("device_floor_name", $request["current_floor"])->get();

            if (count($devices) > 0) {

                foreach ($devices as $each_device) {
                    if ($each_device["device_pid"] == null) {
                        $request["device_id"] = $each_device["device_id"];
                        $this->choose_device($request);

                        $this->run_stop_device($request);
                    }
                }

            }

            $floor = FloorInfo::where("floor_building", $request["building"])->where("floor_name", $request["current_floor"])->first();

            $floor["floor_active"] = true;
            $floor->save();

            $room = RoomInfo::where("room_building", $request["building"])->where("room_floor", $request["current_floor"])->get();

            if (count($room) > 0) {

                foreach ($room as $each) {
                    $each["room_active"] = true;
                    $each->save();
                }
            }

        }

        $this->choose_building($request);

        echo "Success";

    }

    /* Deactivate building */

    public function activate_deactivate_building(Request $request){

        echo 1;

        if ($request["button"] == 1) {

            $sensors = SensorInfo::where("sensor_building_name", $request["building"])->get();

            if (count($sensors) > 0) {

                foreach ($sensors as $each_sensor) {
                    if ($each_sensor["sensor_pid"] != null) {
                        $request["sensor_id"] = $each_sensor["sensor_id"];
                        $this->choose_sensor($request);

                        $this->run_stop_sensor($request);
                    }
                }

            }

            $devices = DeviceInfo::where("device_building_name", $request["building"])->get();

            if (count($devices) > 0) {

                foreach ($devices as $each_device) {
                    if ($each_device["device_pid"] != null) {
                        $request["device_id"] = $each_device["device_id"];
                        $this->choose_device($request);

                        $this->run_stop_device($request);
                    }
                }

            }

            $building = BuildingInfo::where("building_name", $request["building"])->first();

            $building["building_active"] = false;
            $building->save();

            $floor = FloorInfo::where("floor_building", $request["building"])->get();

            if (count($floor) > 0) {

                foreach ($floor as $each) {
                    $each["floor_active"] = false;
                    $each->save();
                }

            }

            $room = RoomInfo::where("room_building", $request["building"])->get();

            if (count($room) > 0) {

                foreach ($room as $each) {
                    $each["room_active"] = false;
                    $each->save();
                }

            }

        }

        else {

            $sensors = SensorInfo::where("sensor_building_name", $request["building"])->get();

            if (count($sensors) > 0) {

                foreach ($sensors as $each_sensor) {
                    if ($each_sensor["sensor_pid"] == null) {
                        $request["sensor_id"] = $each_sensor["sensor_id"];
                        $this->choose_sensor($request);

                        $this->run_stop_sensor($request);
                    }
                }

            }

            $devices = DeviceInfo::where("device_building_name", $request["building"])->get();

            if (count($devices) > 0) {

                foreach ($devices as $each_device) {
                    if ($each_device["device_pid"] == null) {
                        $request["device_id"] = $each_device["device_id"];
                        $this->choose_device($request);

                        $this->run_stop_device($request);
                    }
                }

            }

            $building = BuildingInfo::where("building_name", $request["building"])->first();

            $building["building_active"] = true;
            $building->save();

            $floor = FloorInfo::where("floor_building", $request["building"])->get();

            if (count($floor) > 0) {

                foreach ($floor as $each) {
                    $each["floor_active"] = true;
                    $each->save();
                }

            }

            $room = RoomInfo::where("room_building", $request["building"])->get();

            if (count($room) > 0) {

                foreach ($room as $each) {
                    $each["room_active"] = true;
                    $each->save();
                }

            }

        }

        $this->choose_building($request);

        echo "Success";

    }

}
