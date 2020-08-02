import 'dart:async';
import 'dart:convert';
import 'package:http/http.dart';

import '../model/login_data.dart';

class LoginProvider {
  Client client = Client();
  var url = 'http://4acdb62ac035.ngrok.io/';

  Future<LoginData> login(String email, String password) async {
    var request = url + 'api/sign-in?user_password=$password&user_email=$email';
    try {
      var response = await client.post(request);
      return LoginData.fromJson(json.decode(response.body));
    } on Exception catch (error) {
      print(error);
    }
  }
}
