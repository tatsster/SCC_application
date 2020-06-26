import 'package:SCC_mobile/src/blocs/setting_bloc.dart';
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
    if (path == '/settings') {
      return RefreshIndicator(
        child: child,
        onRefresh: () async {
          final SettingBloc = BlocProvider.of(context).settingBloc;
          SettingBloc.fetchThreshold();
        },
      );
    } else {
      return RefreshIndicator(
        child: child,
        onRefresh: () async {
          final SSDbBloc = BlocProvider.of(context).ssDbBloc;
          SSDbBloc.fetchItem();
        },
      );
    }
  }
}
