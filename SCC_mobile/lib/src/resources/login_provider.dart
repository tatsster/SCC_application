import 'dart:async';
import 'dart:convert';
import 'package:http/http.dart';

import '../model/login_data.dart';

class LoginProvider {
  Client client = Client();

  Future<LoginData> login(String email, String password) async {
    var url =
        'http//8c5c82899b6c.ngrok.io/api/sign-in?user_password=$password&user_email=$email';
    try {
      var response = await client.post(url);
      return LoginData.fromJson(json.decode(response.body));
    } on Exception catch (error) {
      print(error);
    }
  }
}
