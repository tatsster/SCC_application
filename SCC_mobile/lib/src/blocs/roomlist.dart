import 'package:SCC_mobile/src/widgets/building.dart';
import 'package:flutter/material.dart';
import 'package:rxdart/rxdart.dart';

import '../model/room_info.dart';
import '../resources/room_provider.dart';

class RoomList {
  final _roomDB = RoomProvider();
  final _building = BehaviorSubject<String>();
  final _roomInfo = BehaviorSubject<RoomInfo>();

  Stream<String> get building => _building.stream;
  Stream<RoomInfo> get roomInfo => _roomInfo.stream;

  RoomInfo get getRoomInfo => _roomInfo.value;

  getBuilding(String value) {
    _building.sink.add(value);
  }

  fetchItem(BuildContext context) async {
    var item = await _roomDB.fetchItem(context);
    _roomInfo.sink.add(item);
  }

  dispose() {
    _building.close();
  }
}
