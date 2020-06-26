import 'dart:async';
import 'package:rxdart/rxdart.dart';

import '../model/sensor_info.dart';
import '../model/temp_humid_log.dart';
import '../resources/log_db_provider.dart';
import '../resources/sensor_db_provider.dart';

// TODO: fetch List<double> usage -> total usage

class DbBloc {
  // isAdmin then render Maintain mode - List User
  final isAdmin = true;
  String userId;
  int limit = 20;

  // DB fetching
  final _ssdb = SSDbProvider();
  final _logDB = LogProvider();

  void updateUserId(String userId) {
    this.userId = userId;
  }

  // final _dbFetcher = PublishSubject<int>();
  final _sensorInfo = BehaviorSubject<SensorInfo>();
  final _log = BehaviorSubject<TempHumidLog>();

  // Stream - value of turn device
  final _airc = BehaviorSubject<bool>();
  final _light = BehaviorSubject<bool>();

  // Stream getter
  Stream<SensorInfo> get sensorInfo => _sensorInfo.stream;
  Stream<TempHumidLog> get temphumidLog => _log.stream;
  // devices
  Stream<bool> get statusAir => _airc.stream;
  Stream<bool> get statusLight => _light.stream;

  // devices
  void getAirStatus(bool value) {
    _airc.sink.add(value);
    // Send status to DB
  }

  void getLightStatus(bool value) {
    _light.sink.add(value);
    // Send status to DB
  }

  fetchItem() async {
    final item = await _ssdb.fetchItem(this.userId);
    _sensorInfo.sink.add(item);
  }

  void fetchLog(int limit) async {
    this.limit = limit;
    final item = await _logDB.fetchItem(this.userId, limit);
    _log.sink.add(item);
  }

  dispose() {
    // _dbFetcher.close();
    _sensorInfo.close();
    _log.close();
    _airc.close();
    _light.close();
  }
}
