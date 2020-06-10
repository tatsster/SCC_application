import 'package:flutter/material.dart';

import 'blocs/BlocProvider.dart';

import 'screen/data_class.dart';
import 'screen/dashboard.dart';
import 'screen/report.dart';
import 'screen/setting.dart';

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
      return Dashboard();
    });
  else if (settings.name == '/report')
    return MaterialPageRoute(builder: (context) {
      return Report();
    });
  else if (settings.name == '/setting')
    return MaterialPageRoute(builder: (context) {
      return Setting();
    });
  else
    return MaterialPageRoute(builder: (context) {
      final classId = int.parse(settings.name.replaceFirst('/room/', ''));
      final db_bloc = BlocProvider.of(context).dbBloc;
      db_bloc.fetchItem();

      return DataClass(classId: classId);
    });
}
