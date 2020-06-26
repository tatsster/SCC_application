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
  String deviceBuildingName;
  String deviceId;
  String deviceName;
  String deviceStatus;
  bool deviceAutomation;
  String deviceAdditional;
  String deviceUpdatedBy;
  // Threshold
  double tempThreshold;
  double humidThreshold;

  Data(
      {this.deviceFloorName,
      this.deviceRoomName,
      this.deviceId,
      this.deviceName,
      this.deviceStatus,
      this.deviceAutomation,
      this.deviceAdditional,
      this.deviceUpdatedBy,
      this.deviceBuildingName});

  Data.fromJson(Map<String, dynamic> json) {
    deviceFloorName = json['device_floor_name'];
    deviceRoomName = json['device_room_name'];
    deviceId = json['device_id'];
    deviceName = json['device_name'];
    deviceStatus = json['device_status'];
    deviceAutomation = json['device_automation'];
    deviceAdditional = json['device_additional'];
    deviceUpdatedBy = json['device_updated_by'];
    deviceBuildingName = json['device_building_name'];
    fetchThreshold();
  }

  Map<String, dynamic> toJson() {
    final Map<String, dynamic> data = new Map<String, dynamic>();
    data['device_floor_name'] = this.deviceFloorName;
    data['device_room_name'] = this.deviceRoomName;
    data['device_id'] = this.deviceId;
    data['device_name'] = this.deviceName;
    data['device_status'] = this.deviceStatus;
    data['device_automation'] = this.deviceAutomation;
    data['device_additional'] = this.deviceAdditional;
    data['device_updated_by'] = this.deviceUpdatedBy;
    data['temp_threshold'] = this.tempThreshold;
    data['humid_threshold'] = this.humidThreshold;
    data['device_building_name'] = this.deviceBuildingName;
    return data;
  }

  fetchThreshold() {
    if (this.deviceAdditional == '') {
      var value =
          this.deviceAdditional.substring(1, this.deviceAdditional.length - 1);
      var thresholds = value.split(',');
      this.tempThreshold = double.parse(thresholds[0]);
      this.humidThreshold = double.parse(thresholds[2]);
    } else {
      this.tempThreshold = 0.0;
      this.humidThreshold = 0.0;
    }
  }
}
