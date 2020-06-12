class DeviceLog {
  bool success;
  List<Data> data;
  String message;

  DeviceLog({this.success, this.data, this.message});

  DeviceLog.fromJson(Map<String, dynamic> json) {
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
  int deviceOrder;
  String deviceId;
  bool deviceStatus;
  String deviceTimestamp;
  String deviceUpdatedBy;

  Data(
      {this.deviceOrder,
      this.deviceId,
      this.deviceStatus,
      this.deviceTimestamp,
      this.deviceUpdatedBy});

  Data.fromJson(Map<String, dynamic> json) {
    deviceOrder = json['device_order'];
    deviceId = json['device_id'];
    deviceStatus = json['device_status'];
    deviceTimestamp = json['device_timestamp'];
    deviceUpdatedBy = json['device_updated_by'];
  }

  Map<String, dynamic> toJson() {
    final Map<String, dynamic> data = new Map<String, dynamic>();
    data['device_order'] = this.deviceOrder;
    data['device_id'] = this.deviceId;
    data['device_status'] = this.deviceStatus;
    data['device_timestamp'] = this.deviceTimestamp;
    data['device_updated_by'] = this.deviceUpdatedBy;
    return data;
  }
}
