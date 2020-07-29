import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:http/http.dart';
import '../model/room_info.dart';
import '../blocs/BlocProvider.dart';

class RoomProvider {
  Client client = Client();
  var url = 'http://213d94a7b2e0.ngrok.io/';

  Future<RoomInfo> fetchItem(BuildContext context) async {
    var userId = BlocProvider.of(context).user.data[0].user.userId;
    var request = url + 'api/query?query=SELECT * FROM room&user_id=$userId';

    final response = await client.post(request);
    return RoomInfo.fromJson(json.decode(response.body));
  }
}
