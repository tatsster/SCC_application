class TempHumidLog {
  bool success;
  List<Data> data;
  String message;

  TempHumidLog({this.success, this.data, this.message});

  TempHumidLog.fromJson(Map<String, dynamic> json) {
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
  int sensorOrder;
  String sensorId;
  String sensorTemp;
  String sensorHumid;
  String sensorHeatIndex;
  DateTime sensorTimestamp;

  Data(
      {this.sensorOrder,
      this.sensorId,
      this.sensorTemp,
      this.sensorHumid,
      this.sensorHeatIndex,
      this.sensorTimestamp});

  Data.fromJson(Map<String, dynamic> json) {
    sensorOrder = json['sensor_order'];
    sensorId = json['sensor_id'];
    sensorTemp = json['sensor_temp'];
    sensorHumid = json['sensor_humid'];
    sensorHeatIndex = json['sensor_heat_index'];
    sensorTimestamp = DateTime.fromMillisecondsSinceEpoch(
        int.parse(json['sensor_timestamp']) * 1000);
  }

  Map<String, dynamic> toJson() {
    final Map<String, dynamic> data = new Map<String, dynamic>();
    data['sensor_order'] = this.sensorOrder;
    data['sensor_id'] = this.sensorId;
    data['sensor_temp'] = this.sensorTemp;
    data['sensor_humid'] = this.sensorHumid;
    data['sensor_heat_index'] = this.sensorHeatIndex;
    data['sensor_timestamp'] = this.sensorTimestamp;
    return data;
  }
}
