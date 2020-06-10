import 'package:flutter/material.dart';
import 'AppBloc.dart';
export 'AppBloc.dart';

class BlocProvider extends InheritedWidget {
  final AppBloc bloc;

  BlocProvider({Key key, Widget child})
      : bloc = AppBloc(),
        super(key: key, child: child);

  @override
  bool updateShouldNotify(InheritedWidget oldWidget) => true;

  static AppBloc of(BuildContext context) {
    return (context.dependOnInheritedWidgetOfExactType<BlocProvider>()).bloc;
  }
}