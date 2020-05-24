import 'package:http/http.dart' show Client;
import 'dart:async';
import 'dart:convert';
import '../model/item_model.dart';

class SensorDbProvider {
  Client client = Client();

  // id: classroom ID
  Future<ItemModel> fetchItem(int id) async {
    final response = await client.get('');
    return ItemModel.fromJson(json.decode(response.body));
  }
}
