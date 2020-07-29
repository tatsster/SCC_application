class LoginData {
  bool success;
  var data;
  String message;

  LoginData({this.success, this.data, this.message});

  LoginData.fromJson(Map<String, dynamic> json) {
    success = json['success'];
    if (success && json['data'] != null) {
      data = new List<Data>();
      json['data'].forEach((v) {
        data.add(new Data.fromJson(v));
      });
    } else {
      data = json['data'];
    }
    message = json['message'];
  }

  Map<String, dynamic> toJson() {
    final Map<String, dynamic> data = new Map<String, dynamic>();
    data['success'] = this.success;
    if (this.success && this.data != null) {
      data['data'] = this.data.map((v) => v.toJson()).toList();
    } else {
      data['data'] = this.data;
    }
    data['message'] = this.message;
    return data;
  }
}

class Data {
  User user;
  UserRole userRole;

  Data({this.user, this.userRole});

  Data.fromJson(Map<String, dynamic> json) {
    user = json['user'] != null ? new User.fromJson(json['user']) : null;
    userRole = json['user_role'] != null
        ? new UserRole.fromJson(json['user_role'])
        : null;
  }

  Map<String, dynamic> toJson() {
    final Map<String, dynamic> data = new Map<String, dynamic>();
    if (this.user != null) {
      data['user'] = this.user.toJson();
    }
    if (this.userRole != null) {
      data['user_role'] = this.userRole.toJson();
    }
    return data;
  }
}

class User {
  String userId;
  String userFullname;
  String userMobile;
  String userEmail;
  String userAddress;
  String userRole;
  Null userAbout;
  String userLang;
  String userAvatar;
  Null userTemporaryPassword;
  bool userActive;
  String userConfirmationCode;
  String userSessionTimeout;

  User(
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
      this.userActive,
      this.userConfirmationCode,
      this.userSessionTimeout});

  User.fromJson(Map<String, dynamic> json) {
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
    userConfirmationCode = json['user_confirmation_code'];
    userSessionTimeout = json['user_session_timeout'];
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
    data['user_confirmation_code'] = this.userConfirmationCode;
    data['user_session_timeout'] = this.userSessionTimeout;
    return data;
  }
}

class UserRole {
  int permissionId;
  String permissionRole;
  bool permissionReport;
  bool permissionProfile;
  bool permissionUserList;
  bool permissionCreateUser;
  bool permissionEditUser;
  bool permissionSystemSettings;
  bool permissionDashboardSettings;
  bool permissionCreateRole;
  bool permissionEditRole;
  bool permissionDashboard;
  bool permissionSettings;
  bool permissionTabPermission;
  bool permissionCreateBuildingFloorRoom;
  bool permissionEditBuildingFloorRoom;
  bool permissionCreateDeviceSensor;
  bool permissionEditDeviceSensor;

  UserRole(
      {this.permissionId,
      this.permissionRole,
      this.permissionReport,
      this.permissionProfile,
      this.permissionUserList,
      this.permissionCreateUser,
      this.permissionEditUser,
      this.permissionSystemSettings,
      this.permissionDashboardSettings,
      this.permissionCreateRole,
      this.permissionEditRole,
      this.permissionDashboard,
      this.permissionSettings,
      this.permissionTabPermission,
      this.permissionCreateBuildingFloorRoom,
      this.permissionEditBuildingFloorRoom,
      this.permissionCreateDeviceSensor,
      this.permissionEditDeviceSensor});

  UserRole.fromJson(Map<String, dynamic> json) {
    permissionId = json['permission_id'];
    permissionRole = json['permission_role'];
    permissionReport = json['permission_report'];
    permissionProfile = json['permission_profile'];
    permissionUserList = json['permission_user_list'];
    permissionCreateUser = json['permission_create_user'];
    permissionEditUser = json['permission_edit_user'];
    permissionSystemSettings = json['permission_system_settings'];
    permissionDashboardSettings = json['permission_dashboard_settings'];
    permissionCreateRole = json['permission_create_role'];
    permissionEditRole = json['permission_edit_role'];
    permissionDashboard = json['permission_dashboard'];
    permissionSettings = json['permission_settings'];
    permissionTabPermission = json['permission_tab_permission'];
    permissionCreateBuildingFloorRoom =
        json['permission_create_building_floor_room'];
    permissionEditBuildingFloorRoom =
        json['permission_edit_building_floor_room'];
    permissionCreateDeviceSensor = json['permission_create_device_sensor'];
    permissionEditDeviceSensor = json['permission_edit_device_sensor'];
  }

  Map<String, dynamic> toJson() {
    final Map<String, dynamic> data = new Map<String, dynamic>();
    data['permission_id'] = this.permissionId;
    data['permission_role'] = this.permissionRole;
    data['permission_report'] = this.permissionReport;
    data['permission_profile'] = this.permissionProfile;
    data['permission_user_list'] = this.permissionUserList;
    data['permission_create_user'] = this.permissionCreateUser;
    data['permission_edit_user'] = this.permissionEditUser;
    data['permission_system_settings'] = this.permissionSystemSettings;
    data['permission_dashboard_settings'] = this.permissionDashboardSettings;
    data['permission_create_role'] = this.permissionCreateRole;
    data['permission_edit_role'] = this.permissionEditRole;
    data['permission_dashboard'] = this.permissionDashboard;
    data['permission_settings'] = this.permissionSettings;
    data['permission_tab_permission'] = this.permissionTabPermission;
    data['permission_create_building_floor_room'] =
        this.permissionCreateBuildingFloorRoom;
    data['permission_edit_building_floor_room'] =
        this.permissionEditBuildingFloorRoom;
    data['permission_create_device_sensor'] = this.permissionCreateDeviceSensor;
    data['permission_edit_device_sensor'] = this.permissionEditDeviceSensor;
    return data;
  }
}
