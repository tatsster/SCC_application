import 'login_bloc.dart';
import 'profile_bloc.dart';
import 'db_bloc.dart';
import 'setting_bloc.dart';

class AppBloc {
  DbBloc _ssdbBloc;
  SettingBloc _settingBloc;
  ProfileBloc _profileBloc;
  LoginBloc _loginBloc;

  AppBloc()
      : _ssdbBloc = DbBloc(),
        _settingBloc = SettingBloc(),
        _profileBloc = ProfileBloc(),
        _loginBloc = LoginBloc();

  DbBloc get ssDbBloc => _ssdbBloc;
  SettingBloc get settingBloc => _settingBloc;
  ProfileBloc get profileBloc => _profileBloc;
  LoginBloc get loginBloc => _loginBloc;

  void updateUserId() {
    var userId = _loginBloc.userId;
    _ssdbBloc.updateUserId(userId);
    _settingBloc.updateUserId(userId);
  }
}
