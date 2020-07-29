class RoomInfo {
  bool success;
  List<Data> data;
  String message;

  RoomInfo({this.success, this.data, this.message});

  RoomInfo.fromJson(Map<String, dynamic> json) {
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
  int roomOrder;
  String roomBuilding;
  String roomFloor;
  String roomName;
  bool roomActive;

  Data(
      {this.roomOrder,
      this.roomBuilding,
      this.roomFloor,
      this.roomName,
      this.roomActive});

  Data.fromJson(Map<String, dynamic> json) {
    roomOrder = json['room_order'];
    roomBuilding = json['room_building'];
    roomFloor = json['room_floor'];
    roomName = json['room_name'];
    roomActive = json['room_active'];
  }

  Map<String, dynamic> toJson() {
    final Map<String, dynamic> data = new Map<String, dynamic>();
    data['room_order'] = this.roomOrder;
    data['room_building'] = this.roomBuilding;
    data['room_floor'] = this.roomFloor;
    data['room_name'] = this.roomName;
    data['room_active'] = this.roomActive;
    return data;
  }
}
