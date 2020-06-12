class UserInfo {
  bool success;
  Data data;
  String message;

  UserInfo({this.success, this.data, this.message});

  UserInfo.fromJson(Map<String, dynamic> json) {
    success = json['success'];
    data = json['data'] != null ? new Data.fromJson(json['data']) : null;
    message = json['message'];
  }

  Map<String, dynamic> toJson() {
    final Map<String, dynamic> data = new Map<String, dynamic>();
    data['success'] = this.success;
    if (this.data != null) {
      data['data'] = this.data.toJson();
    }
    data['message'] = this.message;
    return data;
  }
}

class Data {
  String userId;
  String userFullname;
  String userMobile;
  String userEmail;
  String userAddress;
  String userPosition;
  String userAbout;
  bool userAccessUserList;
  bool userAccessSettings;
  String userLang;

  Data(
      {this.userId,
      this.userFullname,
      this.userMobile,
      this.userEmail,
      this.userAddress,
      this.userPosition,
      this.userAbout,
      this.userAccessUserList,
      this.userAccessSettings,
      this.userLang});

  Data.fromJson(Map<String, dynamic> json) {
    userId = json['user_id'];
    userFullname = json['user_fullname'];
    userMobile = json['user_mobile'];
    userEmail = json['user_email'];
    userAddress = json['user_address'];
    userPosition = json['user_position'];
    userAbout = json['user_about'];
    userAccessUserList = json['user_access_user_list'];
    userAccessSettings = json['user_access_settings'];
    userLang = json['user_lang'];
  }

  Map<String, dynamic> toJson() {
    final Map<String, dynamic> data = new Map<String, dynamic>();
    data['user_id'] = this.userId;
    data['user_fullname'] = this.userFullname;
    data['user_mobile'] = this.userMobile;
    data['user_email'] = this.userEmail;
    data['user_address'] = this.userAddress;
    data['user_position'] = this.userPosition;
    data['user_about'] = this.userAbout;
    data['user_access_user_list'] = this.userAccessUserList;
    data['user_access_settings'] = this.userAccessSettings;
    data['user_lang'] = this.userLang;
    return data;
  }
}