import 'package:SCC_mobile/src/screen/system_log.dart';
import 'package:flutter/material.dart';

import 'blocs/BlocProvider.dart';

import 'screen/data_class.dart';
import 'screen/dashboard.dart';
import 'screen/report.dart';
import 'screen/system_log.dart';
import 'screen/room_device.dart';
import 'screen/profile.dart';
import 'screen/login.dart';
import 'screen/signup.dart';

class App extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return BlocProvider(
      child: MaterialApp(
        debugShowCheckedModeBanner: false,
        title: "SCC",
        theme: ThemeData(primarySwatch: Colors.blue),
        onGenerateRoute: routes,
      ),
    );
  }
}

Route routes(RouteSettings settings) {
  if (settings.name == '/')
    return MaterialPageRoute(
      settings: settings,
      builder: (context) {
        return LoginPage();
      },
    );
  else if (settings.name == '/signup')
    return MaterialPageRoute(
      settings: settings,
      builder: (context) {
        return SignUpPage();
      },
    );
  else if (settings.name == '/dashboard')
    return MaterialPageRoute(
      settings: settings,
      builder: (context) {
        // TODO: Fetch Weather & Electricity
        final dashboardProvider = BlocProvider.of(context).bloc.dashboardBloc;
        dashboardProvider.fetchData(context);

        return Dashboard();
      },
    );
  else if (settings.name == '/report')
    return MaterialPageRoute(
      settings: settings,
      builder: (context) {
        // TODO: Fetch all building name, floor, room from DB room
        final RoomProvider = BlocProvider.of(context).bloc.roomList;
        RoomProvider.fetchItem(context);

        return Report();
      },
    );
  else if (settings.name == '/systemlog')
    return MaterialPageRoute(
      settings: settings,
      builder: (context) {
        final SSDbProvider = BlocProvider.of(context).bloc.ssDbBloc;
        SSDbProvider.fetchLog(context, 20);

        return SystemLog();
      },
    );
  else if (settings.name.contains('/setting'))
    return MaterialPageRoute(
      settings: settings,
      builder: (context) {
        final classId = settings.name.replaceFirst('/setting/', '');
        var room = classId.split('-');
        var buildingName = room[0];
        var roomName = room[1];

        final DeviceProvider = BlocProvider.of(context).bloc.deviceBloc;
        DeviceProvider.fetchDevice(context, buildingName, roomName);

        return RoomDevice(buildingName: buildingName, roomName: roomName);
      },
    );
  else if (settings.name == '/profile')
    return MaterialPageRoute(
      settings: settings,
      builder: (context) {
        final SSDbProvider = BlocProvider.of(context).bloc.ssDbBloc;
        return Profile();
      },
    );
  else if (settings.name.contains('/room'))
    return MaterialPageRoute(
      settings: settings,
      builder: (context) {
        // Get building name - room name from URL
        final classId = settings.name.replaceFirst('/room/', '');
        var room = classId.split('-');
        var buildingName = room[0];
        var roomName = room[1];

        final SSDbProvider = BlocProvider.of(context).bloc.ssDbBloc;
        SSDbProvider.fetchSensor(context, roomName, buildingName);
        // TODO: Fetch from sensor_info to get all sensor_id for this room
        // * In DataClass view, option to choose what sensor
        // * Fetch info from latest data from DB sensor_log

        return DataClass(buildingName: buildingName, roomName: roomName);
      },
    );
}
