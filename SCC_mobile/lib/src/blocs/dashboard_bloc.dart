import 'dart:async';

import 'package:flutter/cupertino.dart';
import 'package:rxdart/rxdart.dart';

import '../resources/dashboard_provider.dart';
import '../model/electrical.dart';
import '../model/weather.dart';

class DashboardBloc {
  final _dashboardProvider = DashBoardProvider();

  final _weather = BehaviorSubject<Weather>();
  final _electrical = BehaviorSubject<Electrical>();

  Stream<Weather> get weather => _weather.stream;
  Stream<Electrical> get electrical => _electrical.stream;

  fetchData(BuildContext context) async {
    // Get Weather
    final weather = await _dashboardProvider.fetchWeather(context);
    _weather.sink.add(weather);

    // Get Electrical
    final electric = await _dashboardProvider.fetchElectric(context);
    _electrical.sink.add(electric);
  }

  dispose() {
    _weather.close();
    _electrical.close();
  }
}
