import 'package:flutter/material.dart';
import 'package:path/path.dart';
import '../blocs/BlocProvider.dart';

class Refresh extends StatelessWidget {
  final Widget child;
  final BuildContext context;

  Refresh({this.context, this.child});

  @override
  Widget build(BuildContext context) {
    var path = ModalRoute.of(context).settings.name;
    if (path.contains('/setting/')) {
      var classId = path.replaceFirst('/setting/', '');
      var room = classId.split('-');
      var buildingName = room[0];
      var roomName = room[1];

      return RefreshIndicator(
        child: child,
        onRefresh: () async {
          final SettingBloc = BlocProvider.of(context).bloc.deviceBloc;
          SettingBloc.fetchDevice(context, buildingName, roomName);
        },
      );
    } else {
      // * path = /room/
      var classId = path.replaceFirst('/room/', '');
      var room = classId.split('-');
      var buildingName = room[0];
      var roomName = room[1];

      return RefreshIndicator(
        child: child,
        onRefresh: () async {
          final SSDbBloc = BlocProvider.of(context).bloc.ssDbBloc;
          SSDbBloc.fetchSensor(context, roomName, buildingName);
        },
      );
    }
  }
}
