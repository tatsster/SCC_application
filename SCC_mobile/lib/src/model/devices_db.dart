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
  String floorId;
  String roomId;
  String deviceId;
  String deviceName;
  bool deviceStatus;
  bool deviceAutomation;
  String deviceAdditional;
  String deviceUpdatedBy;
  // Threshold
  double tempThreshold;
  double humidThreshold;

  Data(
      {this.floorId,
      this.roomId,
      this.deviceId,
      this.deviceName,
      this.deviceStatus,
      this.deviceAutomation,
      this.deviceAdditional,
      this.deviceUpdatedBy});

  Data.fromJson(Map<String, dynamic> json) {
    floorId = json['floor_id'];
    roomId = json['room_id'];
    deviceId = json['device_id'];
    deviceName = json['device_name'];
    deviceStatus = json['device_status'];
    deviceAutomation = json['device_automation'];
    deviceAdditional = json['device_additional'];
    deviceUpdatedBy = json['device_updated_by'];
    fetchThreshold();
  }

  Map<String, dynamic> toJson() {
    final Map<String, dynamic> data = new Map<String, dynamic>();
    data['floor_id'] = this.floorId;
    data['room_id'] = this.roomId;
    data['device_id'] = this.deviceId;
    data['device_name'] = this.deviceName;
    data['device_status'] = this.deviceStatus;
    data['device_automation'] = this.deviceAutomation;
    data['device_additional'] = this.deviceAdditional;
    data['device_updated_by'] = this.deviceUpdatedBy;
    data['temp_threshold'] = this.tempThreshold;
    data['humid_threshold'] = this.humidThreshold;
    return data;
  }

  fetchThreshold() {
    var value =
        this.deviceAdditional.substring(1, this.deviceAdditional.length - 1);
    var thresholds = value.split(',');
    this.tempThreshold = double.parse(thresholds[0]);
    this.humidThreshold = double.parse(thresholds[2]);
  }
}
