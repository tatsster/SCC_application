class Weather {
  bool success;
  List<Data> data;
  String message;

  Weather({this.success, this.data, this.message});

  Weather.fromJson(Map<String, dynamic> json) {
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
  int currentHumid;
  int currentTemp;
  int timestamp;

  Data({this.currentHumid, this.currentTemp, this.timestamp});

  Data.fromJson(Map<String, dynamic> json) {
    currentHumid = json['current_humid'];
    currentTemp = json['current_temp'];
    timestamp = json['timestamp'];
  }

  Map<String, dynamic> toJson() {
    final Map<String, dynamic> data = new Map<String, dynamic>();
    data['current_humid'] = this.currentHumid;
    data['current_temp'] = this.currentTemp;
    data['timestamp'] = this.timestamp;
    return data;
  }
}