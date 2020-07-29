import '../model/login_data.dart';
import 'package:flutter/material.dart';
import 'AppBloc.dart';
export 'AppBloc.dart';

class BlocProvider extends InheritedWidget {
  final AppBloc bloc;
  LoginData user;

  BlocProvider({Key key, Widget child})
      : bloc = AppBloc(),
        super(key: key, child: child);

  @override
  bool updateShouldNotify(InheritedWidget oldWidget) => true;

  static BlocProvider of(BuildContext context) {
    return context.dependOnInheritedWidgetOfExactType<BlocProvider>();
  }
}
