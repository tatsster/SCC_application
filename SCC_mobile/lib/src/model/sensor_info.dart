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
  String sensorFloorName;
  String sensorRoomName;
  String sensorId;
  String sensorName;
  String sensorBuildingName;
  String sensorValue;
  String sensorIp;
  String sensorPort;
  String sensorTopic;
  String sensorUsername;
  String sensorPassword;
  String sensorPid;
  // Important
  int sensorTemp;
  int sensorHumid;

  Data(
      {this.sensorFloorName,
      this.sensorRoomName,
      this.sensorId,
      this.sensorName,
      this.sensorBuildingName,
      this.sensorValue,
      this.sensorIp,
      this.sensorPort,
      this.sensorTopic,
      this.sensorUsername,
      this.sensorPassword,
      this.sensorPid});

  Data.fromJson(Map<String, dynamic> json) {
    sensorFloorName = json['sensor_floor_name'];
    sensorRoomName = json['sensor_room_name'];
    sensorId = json['sensor_id'];
    sensorName = json['sensor_name'];
    sensorBuildingName = json['sensor_building_name'];
    sensorValue = json['sensor_value'];
    sensorIp = json['sensor_ip'];
    sensorPort = json['sensor_port'];
    sensorTopic = json['sensor_topic'];
    sensorUsername = json['sensor_username'];
    sensorPassword = json['sensor_password'];
    sensorPid = json['sensor_pid'];
    getCurrentValue();
  }

  Map<String, dynamic> toJson() {
    final Map<String, dynamic> data = new Map<String, dynamic>();
    data['sensor_floor_name'] = this.sensorFloorName;
    data['sensor_room_name'] = this.sensorRoomName;
    data['sensor_id'] = this.sensorId;
    data['sensor_name'] = this.sensorName;
    data['sensor_building_name'] = this.sensorBuildingName;
    data['sensor_value'] = this.sensorValue;
    data['sensor_ip'] = this.sensorIp;
    data['sensor_port'] = this.sensorPort;
    data['sensor_topic'] = this.sensorTopic;
    data['sensor_username'] = this.sensorUsername;
    data['sensor_password'] = this.sensorPassword;
    data['sensor_pid'] = this.sensorPid;
    // Current sensor value
    data['sensor_temp'] = this.sensorTemp;
    data['sensor_humid'] = this.sensorHumid;
    return data;
  }

  getCurrentValue() {
    if (this.sensorValue != null) {
      var value = this.sensorValue.substring(1, this.sensorValue.length - 1);
      var values = value.split(',');
      this.sensorTemp = int.parse(values[0]);
      this.sensorHumid = int.parse(values[1]);
    }
  }
}
