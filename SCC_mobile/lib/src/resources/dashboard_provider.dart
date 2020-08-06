import 'dart:async';
import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:http/http.dart';

import '../model/weather.dart';
import '../model/electrical.dart';
import '../blocs/BlocProvider.dart';

class DashBoardProvider {
  Client client = Client();
  var url = 'http://192.168.1.111:8000/';

  Future<Weather> fetchWeather(BuildContext context) async {
    var userId = BlocProvider.of(context).user.data[0].user.userId;
    var request = url + 'api/get-current-weather?user_id=$userId';

    final response = await client.post(request);
    print(response.body);
    return Weather.fromJson(json.decode(response.body));
  }

  Future<Electrical> fetchElectric(BuildContext context) async {
    var userId = BlocProvider.of(context).user.data[0].user.userId;
    var request =
        url + 'api/hours-usage-electrical-consumption?user_id=$userId';

    final response = await client.post(request);
    return Electrical.fromJson(json.decode(response.body));
  }
}
