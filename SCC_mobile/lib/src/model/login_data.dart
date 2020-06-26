class LoginData {
  bool success;
  List<dynamic> data;
  String message;

  LoginData({this.success, this.data, this.message});

  LoginData.fromJson(Map<String, dynamic> json) {
    success = json['success'];
    if (json['data'] != null && success == true) {
      data = new List<Data>();
      json['data'].forEach((v) {
        data.add(new Data.fromJson(v));
      });
    } else {
      data = new List<String>();
      json['data'].forEach((v) {
        data.add(v);
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
  String userId;
  String userFullname;
  String userMobile;
  String userEmail;
  String userAddress;
  String userRole;
  String userAbout;
  String userLang;
  String userAvatar;
  Null userTemporaryPassword;
  bool userActive;

  Data(
      {this.userId,
      this.userFullname,
      this.userMobile,
      this.userEmail,
      this.userAddress,
      this.userRole,
      this.userAbout,
      this.userLang,
      this.userAvatar,
      this.userTemporaryPassword,
      this.userActive});

  Data.fromJson(Map<String, dynamic> json) {
    userId = json['user_id'];
    userFullname = json['user_fullname'];
    userMobile = json['user_mobile'];
    userEmail = json['user_email'];
    userAddress = json['user_address'];
    userRole = json['user_role'];
    userAbout = json['user_about'];
    userLang = json['user_lang'];
    userAvatar = json['user_avatar'];
    userTemporaryPassword = json['user_temporary_password'];
    userActive = json['user_active'];
  }

  Map<String, dynamic> toJson() {
    final Map<String, dynamic> data = new Map<String, dynamic>();
    data['user_id'] = this.userId;
    data['user_fullname'] = this.userFullname;
    data['user_mobile'] = this.userMobile;
    data['user_email'] = this.userEmail;
    data['user_address'] = this.userAddress;
    data['user_role'] = this.userRole;
    data['user_about'] = this.userAbout;
    data['user_lang'] = this.userLang;
    data['user_avatar'] = this.userAvatar;
    data['user_temporary_password'] = this.userTemporaryPassword;
    data['user_active'] = this.userActive;
    return data;
  }
}
