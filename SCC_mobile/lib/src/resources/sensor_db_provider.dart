import 'dart:async';
import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:http/http.dart';
import '../model/temp_humid_log.dart';
import '../model/sensor_info.dart';
import '../blocs/BlocProvider.dart';

class SSDbProvider {
  Client client = Client();
  var url = 'http://213d94a7b2e0.ngrok.io/';

  Future<TempHumidLog> fetchSensorData(
      BuildContext context, String sensor_id) async {
    var userId = BlocProvider.of(context).user.data[0].user.userId;
    var request = url +
        "api/query?query=SELECT * FROM sensor_log WHERE sensor_id='$sensor_id' ORDER BY sensor_timestamp DESC LIMIT 1&user_id=$userId";
    try {
      var response = await client.post(request);
      return TempHumidLog.fromJson(json.decode(response.body));
    } on Exception catch (error) {
      print(error);
    }
  }

  Future<SensorInfo> fetchSensor(
      BuildContext context, String building, String room) async {
    var userId = BlocProvider.of(context).user.data[0].user.userId;
    var request = url +
        "api/query?query=SELECT * FROM sensor WHERE sensor_room_name='$room' AND sensor_building_name='$building'&user_id=$userId";
    try {
      var response = await client.post(request);
      return SensorInfo.fromJson(json.decode(response.body));
    } on Exception catch (error) {
      print(error);
    }
  }

  Future<void> changeSensorStatus(
      BuildContext context, String sensorId, int value) async {
    var userId = BlocProvider.of(context).user.data[0].user.userId;
    var requestTurn = url +
        "api/run-stop-sensor?button=$value&sensor_id=$sensorId&user_id=$userId";
    var request = url +
        "api/query?query=SELECT * FROM sensor WHERE sensor_id='$sensorId'&user_id=$userId";
    try {
      await client.post(requestTurn);
      // * Get new sensor pid
      // var response = await client.post(request);
      // print(response.body);
      // return SensorInfo.fromJson(json.decode(response.body));
    } on Exception catch (error) {
      print(error);
    }
  }
}
