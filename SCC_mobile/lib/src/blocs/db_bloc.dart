import 'dart:async';
import 'package:flutter/material.dart';
import 'package:rxdart/rxdart.dart';

import '../model/temp_humid_log.dart';
import '../model/sensor_info.dart';
import '../resources/log_db_provider.dart';
import '../resources/sensor_db_provider.dart';

// TODO: fetch List<double> usage -> total usage

class DbBloc {
  int limit = 20;

  // DB fetching
  final _ssdb = SSDbProvider();
  final _logDB = LogProvider();

  final _sensorData = BehaviorSubject<TempHumidLog>();
  final _log = BehaviorSubject<TempHumidLog>();
  final _sensorInfo = BehaviorSubject<SensorInfo>();
  // * Turn sensor on off
  final _turnSensor = BehaviorSubject<bool>();

  // Stream getter
  Stream<TempHumidLog> get sensorData => _sensorData.stream;
  Stream<SensorInfo> get sensorInfo => _sensorInfo.stream;
  Stream<TempHumidLog> get temphumidLog => _log.stream;
  Stream<bool> get statusSensor => _turnSensor.stream;

  initSensorStatus(bool value) {
    _turnSensor.sink.add(value);
  }

  changeStatusSensor(BuildContext context, String sensorId, bool value) async {
    int status = value ? 0 : 1;
    await _ssdb.changeSensorStatus(context, sensorId, status);
    _turnSensor.sink.add(value);
  }

  fetchSensorData(BuildContext context, String sensor_id) async {
    final item = await _ssdb.fetchSensorData(context, sensor_id);
    _sensorData.sink.add(item);
  }

  fetchSensor(BuildContext context, String room, String building) async {
    final item = await _ssdb.fetchSensor(context, building, room);
    _sensorInfo.sink.add(item);
  }

  void fetchLog(BuildContext context, int limit) async {
    this.limit = limit;
    final item = await _logDB.fetchItem(context, limit);
    _log.sink.add(item);
  }

  dispose() {
    _sensorData.close();
    _sensorInfo.close();
    _turnSensor.close();
    _log.close();
  }
}
