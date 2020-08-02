import 'dart:async';
import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:http/http.dart';
import '../model/temp_humid_log.dart';
import '../blocs/BlocProvider.dart';

class LogProvider {
  Client client = Client();
  var url = 'http://4acdb62ac035.ngrok.io/';

  Future<TempHumidLog> fetchItem(BuildContext context, int limit) async {
    var userId = BlocProvider.of(context).user.data[0].user.userId;
    var request = url +
        'api/query?query=SELECT * FROM sensor_log ORDER BY sensor_timestamp DESC LIMIT $limit&user_id=$userId';

    final response = await client.post(request);
    return TempHumidLog.fromJson(json.decode(response.body));
  }
}
