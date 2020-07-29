import 'dart:async';
import 'package:SCC_mobile/src/model/device_db.dart';
import 'package:flutter/material.dart';
import 'package:rxdart/rxdart.dart';

import '../blocs/validator.dart';
import '../resources/device_db_provider.dart';
import '../model/device_db.dart';

class DeviceBloc with Validator {
  final _deviceDb = DeviceProvider();

  final _device = BehaviorSubject<DeviceDB>();
  final _deviceID = BehaviorSubject<String>();
  final _deviceStatus = BehaviorSubject<bool>();

  Stream<DeviceDB> get deviceDB => _device.stream;
  Stream<String> get deviceID => _deviceID.stream;
  Stream<bool> get deviceStatus => _deviceStatus.stream;

  changeDevice(String id) {
    _deviceID.sink.add(id);
  }

  fetchDevice(BuildContext context, String building, String room) async {
    final item = await _deviceDb.fetchItem(context, building, room);
    _device.sink.add(item);
  }

  initDeviceStatus(bool value) {
    _deviceStatus.sink.add(value);
  }

  changeStatusDevice(BuildContext context, Data device, bool newValue) async {
    int status = newValue ? 0 : 1;
    var success = await _deviceDb.turnDevice(context, device, status);
    if (success)
      _deviceStatus.sink.add(newValue);
  }

  dispose() {
    _device.close();
    _deviceID.close();
    _deviceStatus.close();
  }
}
