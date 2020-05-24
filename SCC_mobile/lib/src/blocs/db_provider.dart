import 'package:flutter/material.dart';
import 'db_bloc.dart';
export 'db_bloc.dart';

class DbProvider extends InheritedWidget {
  final DbBloc bloc;

  DbProvider({Key key, Widget child})
      : bloc = DbBloc(),
        super(key: key, child: child);

  @override
  bool updateShouldNotify(InheritedWidget oldWidget) => true;

  static DbBloc of(BuildContext context) {
    return (context.dependOnInheritedWidgetOfExactType<DbProvider>()).bloc;
  }
}
