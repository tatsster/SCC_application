import 'package:SCC_mobile/src/screen/profile.dart';
import 'package:flutter/material.dart';

import 'blocs/BlocProvider.dart';

import 'screen/data_class.dart';
import 'screen/dashboard.dart';
import 'screen/report.dart';
import 'screen/setting.dart';
import 'screen/profile.dart';
import 'screen/login.dart';

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
    return MaterialPageRoute(builder: (context) {
      return LoginPage();
    });
  else if (settings.name == '/dashboard')
    return MaterialPageRoute(builder: (context) {
      return Dashboard();
    });
  else if (settings.name == '/report')
    return MaterialPageRoute(builder: (context) {
      final SSDbProvider = BlocProvider.of(context).ssDbBloc;
      SSDbProvider.fetchLog(20);

      return Report();
    });
  else if (settings.name == '/setting')
    return MaterialPageRoute(builder: (context) {
      final SettingProvider = BlocProvider.of(context).settingBloc;
      SettingProvider.fetchThreshold();

      return Setting();
    });
  else if (settings.name == '/profile')
    return MaterialPageRoute(builder: (context) {
      final SSDbProvider = BlocProvider.of(context).ssDbBloc;
      return Profile();
    });
  else
    return MaterialPageRoute(builder: (context) {
      final classId = int.parse(settings.name.replaceFirst('/room/', ''));
      final SSDbProvider = BlocProvider.of(context).ssDbBloc;
      SSDbProvider.fetchItem();

      return DataClass(classId: classId);
    });
}
