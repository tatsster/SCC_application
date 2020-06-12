import 'db_bloc.dart';
import 'setting_bloc.dart';

class AppBloc {
  DbBloc _ssdbBloc;
  SettingBloc _settingBloc;

  AppBloc()
      : _ssdbBloc = DbBloc(),
        _settingBloc = SettingBloc();

  DbBloc get ssDbBloc => _ssdbBloc;
  SettingBloc get settingBloc => _settingBloc;
}
