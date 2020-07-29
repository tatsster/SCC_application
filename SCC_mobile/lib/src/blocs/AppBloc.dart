import 'package:SCC_mobile/src/blocs/roomlist.dart';

import 'login_bloc.dart';
import 'profile_bloc.dart';
import 'db_bloc.dart';
import 'device_bloc.dart';
import 'signup_bloc.dart';

class AppBloc {
  DbBloc _ssdbBloc;
  DeviceBloc _deviceBloc;
  ProfileBloc _profileBloc;
  LoginBloc _loginBloc;
  SignupBloc _signupBloc;
  RoomList _roomList;

  AppBloc()
      : _ssdbBloc = DbBloc(),
        _deviceBloc = DeviceBloc(),
        _profileBloc = ProfileBloc(),
        _loginBloc = LoginBloc(),
        _signupBloc = SignupBloc(),
        _roomList = RoomList();

  DbBloc get ssDbBloc => _ssdbBloc;
  DeviceBloc get deviceBloc => _deviceBloc;
  ProfileBloc get profileBloc => _profileBloc;
  LoginBloc get loginBloc => _loginBloc;
  SignupBloc get signupBloc => _signupBloc;
  RoomList get roomList => _roomList;
}
