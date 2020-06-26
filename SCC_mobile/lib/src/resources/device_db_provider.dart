import 'dart:async';
import 'dart:convert';
import 'package:http/http.dart';
import '../model/devices_db.dart';

class DeviceProvider {
  Client client = Client();

  Future<DeviceDB> fetchItem(String userId) async {
    var url = 'http://8c5c82899b6c.ngrok.io/' +
    'api/query?query=SELECT * FROM device&user_id=$userId';
    try {
      var response = await client.post(url);
      return DeviceDB.fromJson(json.decode(response.body));
    } on Exception catch (error) {
      var data = Data(
          deviceFloorName: "",
          deviceRoomName: "",
          deviceId: "",
          deviceName: "",
          deviceStatus: "",
          deviceAutomation: false,
          deviceAdditional: "",
          deviceUpdatedBy: "",
          deviceBuildingName: "");
      return DeviceDB(success: false, message: "", data: [data]);
    }
  }
}
