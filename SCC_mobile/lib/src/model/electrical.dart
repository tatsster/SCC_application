class Electrical {
  bool success;
  List<Data> data;
  String message;

  Electrical({this.success, this.data, this.message});

  Electrical.fromJson(Map<String, dynamic> json) {
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
  double hoursUsage;
  double electricalConsumption;

  Data({this.hoursUsage, this.electricalConsumption});

  Data.fromJson(Map<String, dynamic> json) {
    hoursUsage = json['hours_usage'];
    electricalConsumption = json['electrical_consumption'];
  }

  Map<String, dynamic> toJson() {
    final Map<String, dynamic> data = new Map<String, dynamic>();
    data['hours_usage'] = this.hoursUsage;
    data['electrical_consumption'] = this.electricalConsumption;
    return data;
  }
}