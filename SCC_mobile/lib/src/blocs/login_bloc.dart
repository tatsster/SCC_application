import 'dart:async';
import 'package:SCC_mobile/src/resources/login_provider.dart';
import 'package:rxdart/rxdart.dart';

import 'validator.dart';

class LoginBloc with Validator {
  final _email = BehaviorSubject<String>();
  final _password = BehaviorSubject<String>();
  final _login = LoginProvider();
  var userLogin;

  // * Getter for stream
  Stream<String> get email => _email.stream.transform(emailValidator);
  Stream<String> get password => _password.stream.transform(pwdValidator);

  // * Getter for sink add
  Function(String) get getEmail => _email.sink.add;
  Function(String) get getPassword => _password.sink.add;

  Stream<bool> get submitValid => CombineLatestStream.combine2(email, password, (a, b) => true);

  submit() async {
    final validEmail =_email.value;
    final validePassword = _password.value;
    userLogin = await _login.login(validEmail, validePassword);
    return userLogin.success;
  }

  String get userId => userLogin.data[0].userId;

  dispose() {
    _email.close();
    _password.close();
  }
}