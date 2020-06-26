import 'dart:async';
import 'dart:convert';
import 'package:http/http.dart';
import '../model/temp_humid_log.dart';

class LogProvider {
  Client client = Client();

  Future<TempHumidLog> fetchItem(String userId, int limit) async {
    var url = 'http://8c5c82899b6c.ngrok.io/' +
        'api/query?query=SELECT * FROM sensor_log ORDER BY sensor_timestamp DESC LIMIT $limit&user_id=$userId';

    final response = await client.post(url);
    return TempHumidLog.fromJson(json.decode(response.body));
  }
}
