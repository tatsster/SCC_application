import 'dart:async';
import 'package:rxdart/rxdart.dart';

import 'validator.dart';
import '../model/login_data.dart';
import '../resources/login_provider.dart';

class LoginBloc with Validator {
  final _email = BehaviorSubject<String>();
  final _password = BehaviorSubject<String>();
  final _login = LoginProvider();
  LoginData userLogin;

  // * Getter for stream
  Stream<String> get email => _email.stream.transform(emailValidator);
  // Stream<String> get password => _password.stream.transform(pwdValidator);
  Stream<String> get password => _password.stream;

  // * Getter for sink add
  Function(String) get getEmail => _email.sink.add;
  Function(String) get getPassword => _password.sink.add;

  Stream<bool> get submitValid =>
      CombineLatestStream.combine2(email, password, (a, b) => true);

  Future<LoginData> submit() async {
    final validEmail = _email.value;
    final validPassword = _password.value;
    userLogin = await _login.login(validEmail, validPassword);
    return userLogin;
  }

  loginFail(String errorMessage) {
    _password.sink.addError(errorMessage);
  }

  dispose() {
    _email.close();
    _password.close();
  }
}
