// TODO: This file is only used for Mockup
import 'dart:math';

class SensorInfo {
  final int room;
  // final String sensor;
  final int temp;
  final int humid;
  final bool exceed;
  final DateTime time;

  SensorInfo({this.room, this.temp, this.humid, this.exceed, this.time});
}

List<SensorInfo> generate() {
  List<SensorInfo> result = [];
  DateTime current = DateTime.now();
  var rng = Random();
  List<int> rooms = [101, 102, 103, 104, 105, 201, 202, 203, 204, 205];

  for (int i = 0; i < 10; i++) {
    var timeStamp = current.subtract(new Duration(minutes: 5 * i));
    for (var room in rooms) {
      int temper = 25 + rng.nextInt(10);
      var record = SensorInfo(
          room: room,
          temp: temper,
          humid: 10 + rng.nextInt(90),
          exceed: temper >= 29 ? true : false,
          time: timeStamp);

      result.add(record);
    }
  }

  return result;
}
