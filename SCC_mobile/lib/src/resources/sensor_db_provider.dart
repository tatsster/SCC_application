import 'dart:async';
import 'dart:convert';
import 'package:http/http.dart';
import '../model/sensor_info.dart';

var url = 'http://9cc2a858feab.ngrok.io/' +
    'api/query?query=SELECT * FROM sensor&user_id=ep8SFLFSsveuXF0wIFUY';

class SSDbProvider {
  Client client = Client();

  Future<SensorInfo> fetchItem() async {
    final response = await client.post(url);
    return SensorInfo.fromJson(json.decode(response.body));
  }
}
