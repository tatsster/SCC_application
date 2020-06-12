class SensorInfo {
  bool success;
  List<Data> data;
  String message;

  SensorInfo({this.success, this.data, this.message});

  SensorInfo.fromJson(Map<String, dynamic> json) {
    success = json['success'];
    if (json['data'] != null) {
      data = new List<Data>();
      json['data'].forEach((v) {
        data.add(new Data.fromJson(v));
      });
    }
    message = json['message'];
  }

  Map<String, dynamic> toJson() {
    final Map<String, dynamic> data = new Map<String, dynamic>();
    data['success'] = this.success;
    if (this.data != null) {
      data['data'] = this.data.map((v) => v.toJson()).toList();
    }
    data['message'] = this.message;
    return data;
  }
}

class Data {
  String floorId;
  String roomId;
  String sensorId;
  String sensorName;
  String sensorTemp;
  String sensorHumid;

  Data(
      {this.floorId,
      this.roomId,
      this.sensorId,
      this.sensorName,
      this.sensorTemp,
      this.sensorHumid});

  Data.fromJson(Map<String, dynamic> json) {
    floorId = json['floor_id'];
    roomId = json['room_id'];
    sensorId = json['sensor_id'];
    sensorName = json['sensor_name'];
    sensorTemp = json['sensor_temp'];
    sensorHumid = json['sensor_humid'];
  }

  Map<String, dynamic> toJson() {
    final Map<String, dynamic> data = new Map<String, dynamic>();
    data['floor_id'] = this.floorId;
    data['room_id'] = this.roomId;
    data['sensor_id'] = this.sensorId;
    data['sensor_name'] = this.sensorName;
    data['sensor_temp'] = this.sensorTemp;
    data['sensor_humid'] = this.sensorHumid;
    return data;
  }
}