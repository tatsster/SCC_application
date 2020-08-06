import 'dart:async';
import 'dart:convert';
import 'package:SCC_mobile/src/blocs/BlocProvider.dart';
import 'package:flutter/material.dart';
import 'package:http/http.dart';

import '../model/device_db.dart';

class DeviceProvider {
  Client client = Client();
  var url = 'http://192.168.1.111:8000/';

  Future<DeviceDB> fetchItem(
      BuildContext context, String building, String room) async {
    var userId = BlocProvider.of(context).user.data[0].user.userId;
    var request = url +
        "api/query?query=SELECT * FROM device WHERE device_room_name='$room' AND device_building_name='$building'&user_id=$userId";
    try {
      var response = await client.post(request);
      return DeviceDB.fromJson(json.decode(response.body));
    } on Exception catch (error) {
      print(error);
    }
  }

  Future<bool> turnDevice(BuildContext context, Data device, int status) async {
    var userId = BlocProvider.of(context).user.data[0].user.userId;
    var request = url +
        "api/run-stop-device?device_id=${device.deviceId}&device_username=${device.deviceUsername}&device_password=${device.devicePassword}&device_ip=${device.deviceIp}&device_port=${device.devicePort}&device_topic=${device.deviceTopic}&button=$status&device_status_value=${device.deviceStatusValue}&user_id=$userId";
    try {
      var response = await client.post(request);
      return DeviceDB.fromJson(json.decode(response.body)).success;
    } on Exception catch (error) {
      print(error);
    }
  }
}
