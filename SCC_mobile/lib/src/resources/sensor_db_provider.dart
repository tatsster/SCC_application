import 'dart:async';
import 'dart:convert';
import 'package:http/http.dart';
import '../model/sensor_info.dart';

class SSDbProvider {
  Client client = Client();

  Future<SensorInfo> fetchItem(String userId) async {
    var url = 'http://8c5c82899b6c.ngrok.io/' +
    'api/query?query=SELECT * FROM sensor&user_id=$userId';
    try {
      var response = await client.post(url);
      return SensorInfo.fromJson(json.decode(response.body));
    } on Exception catch (error) {
      var data = Data(
          sensorFloorName: "",
          sensorRoomName: "",
          sensorId: "",
          sensorName: "",
          sensorBuildingName: "",
          sensorValue: null,
          sensorIp: "",
          sensorPort: "",
          sensorTopic: "",
          sensorUsername: "",
          sensorPassword: "",
          sensorPid: "");
      return SensorInfo(
        success: true,
        message: "OK",
        data: [data],
      );
    }
  }
}
