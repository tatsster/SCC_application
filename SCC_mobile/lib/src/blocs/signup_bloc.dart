import 'dart:async';
import 'package:rxdart/rxdart.dart';

import 'validator.dart';

class SignupBloc with Validator {
  final _email = BehaviorSubject<String>();
  final _password = BehaviorSubject<String>();
  final _passconfirm = BehaviorSubject<String>();
  final _mobile = BehaviorSubject<String>();
  final _name = BehaviorSubject<String>();
  final _address = BehaviorSubject<String>();
  final _about = BehaviorSubject<String>();
  // final _signup = SignupProvider();

  // * Getter for stream
  Stream<String> get email => _email.stream.transform(emailValidator);
  Stream<String> get password => _password.stream.transform(pwdValidator);
  Stream<String> get passconfirm {
    if (_password.value != _passconfirm.value)
      _passconfirm.sink.addError("Incorrect Password Confirm !!!");
    else
      _passconfirm.sink.add(_passconfirm.value);
    return _passconfirm.stream;
  }

  Stream<String> get mobile => _mobile.stream;
  Stream<String> get name => _name.stream;
  Stream<String> get address => _address.stream;
  Stream<String> get about => _about.stream;

  // * Getter for sink add
  Function(String) get getEmail => _email.sink.add;
  Function(String) get getPassword => _password.sink.add;
  Function(String) get getPassConfirm => _passconfirm.sink.add;
  Function(String) get getMobile => _mobile.sink.add;
  Function(String) get getName => _name.sink.add;
  Function(String) get getAddress => _address.sink.add;
  Function(String) get getAbout => _about.sink.add;

  dispose() {
    _email.close();
    _password.close();
    _passconfirm.close();
    _mobile.close();
    _name.close();
    _address.close();
    _about.close();
  }
}
