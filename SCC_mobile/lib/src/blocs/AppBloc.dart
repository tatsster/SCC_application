import 'db_bloc.dart';
import 'setting_bloc.dart';

class AppBloc {
  DbBloc _dbBloc;
  SettingBloc _settingBloc;

  AppBloc()
      : _dbBloc = DbBloc(),
        _settingBloc = SettingBloc();

  DbBloc get dbBloc => _dbBloc;
  SettingBloc get settingBloc => _settingBloc;
}
