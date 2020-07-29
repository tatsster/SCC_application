class DeviceDB {
  bool success;
  List<Data> data;
  String message;

  DeviceDB({this.success, this.data, this.message});

  DeviceDB.fromJson(Map<String, dynamic> json) {
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
  String deviceFloorName;
  String deviceRoomName;
  String deviceId;
  String deviceName;
  String deviceBuildingName;
  String deviceIp;
  String deviceTopic;
  String deviceUsername;
  String devicePassword;
  String devicePid;
  int devicePort;
  String deviceKwh;
  String deviceLowerThreshold;
  String deviceUpperThreshold;
  String deviceStatusValue;
  String deviceAutoBasedOnSensorTopic;

  Data(
      {this.deviceFloorName,
      this.deviceRoomName,
      this.deviceId,
      this.deviceName,
      this.deviceBuildingName,
      this.deviceIp,
      this.deviceTopic,
      this.deviceUsername,
      this.devicePassword,
      this.devicePid,
      this.devicePort,
      this.deviceKwh,
      this.deviceLowerThreshold,
      this.deviceUpperThreshold,
      this.deviceStatusValue,
      this.deviceAutoBasedOnSensorTopic});

  Data.fromJson(Map<String, dynamic> json) {
    deviceFloorName = json['device_floor_name'];
    deviceRoomName = json['device_room_name'];
    deviceId = json['device_id'];
    deviceName = json['device_name'];
    deviceBuildingName = json['device_building_name'];
    deviceIp = json['device_ip'];
    deviceTopic = json['device_topic'];
    deviceUsername = json['device_username'];
    devicePassword = json['device_password'];
    devicePid = json['device_pid'];
    devicePort = json['device_port'];
    deviceKwh = json['device_kwh'];
    deviceLowerThreshold = json['device_lower_threshold'];
    deviceUpperThreshold = json['device_upper_threshold'];
    deviceStatusValue = json['device_status_value'];
    deviceAutoBasedOnSensorTopic = json['device_auto_based_on_sensor_topic'];
  }

  Map<String, dynamic> toJson() {
    final Map<String, dynamic> data = new Map<String, dynamic>();
    data['device_floor_name'] = this.deviceFloorName;
    data['device_room_name'] = this.deviceRoomName;
    data['device_id'] = this.deviceId;
    data['device_name'] = this.deviceName;
    data['device_building_name'] = this.deviceBuildingName;
    data['device_ip'] = this.deviceIp;
    data['device_topic'] = this.deviceTopic;
    data['device_username'] = this.deviceUsername;
    data['device_password'] = this.devicePassword;
    data['device_pid'] = this.devicePid;
    data['device_port'] = this.devicePort;
    data['device_kwh'] = this.deviceKwh;
    data['device_lower_threshold'] = this.deviceLowerThreshold;
    data['device_upper_threshold'] = this.deviceUpperThreshold;
    data['device_status_value'] = this.deviceStatusValue;
    data['device_auto_based_on_sensor_topic'] =
        this.deviceAutoBasedOnSensorTopic;
    return data;
  }
}
