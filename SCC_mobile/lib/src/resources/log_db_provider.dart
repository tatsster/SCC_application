import 'dart:async';
import 'dart:convert';
import 'package:http/http.dart';
import '../model/temp_humid_log.dart';

var url = 'http://9cc2a858feab.ngrok.io/' +
    'api/query?query=SELECT * FROM temp_humid_log&user_id=ep8SFLFSsveuXF0wIFUY';

class LogProvider {
  Client client = Client();

  Future<TempHumidLog> fetchItem() async {
    final response = await client.post(url);
    return TempHumidLog.fromJson(json.decode(response.body));
  }
}
