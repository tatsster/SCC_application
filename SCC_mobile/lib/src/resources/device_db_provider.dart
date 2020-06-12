import 'dart:async';
import 'dart:convert';
import 'package:http/http.dart';
import '../model/devices_db.dart';

var url = 'http://9cc2a858feab.ngrok.io/' +
    'api/query?query=SELECT * FROM device&user_id=ep8SFLFSsveuXF0wIFUY';

class DeviceProvider {
  Client client = Client();

  Future<DeviceDB> fetchItem() async {
    final response = await client.post(url);
    return DeviceDB.fromJson(json.decode(response.body));
  }
}