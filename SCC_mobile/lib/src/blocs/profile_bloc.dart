import 'dart:async';
import 'package:rxdart/rxdart.dart';

import 'validator.dart';

class ProfileBloc with Validator {
  final _name = BehaviorSubject<String>();
  final _email = BehaviorSubject<String>.seeded(null);
  final _phone = BehaviorSubject<String>();
  final _position = BehaviorSubject<String>();
  final _address = BehaviorSubject<String>();
  final _pwd = BehaviorSubject<String>.seeded(null);
  final _rePwd = BehaviorSubject<String>.seeded(null);

  Function(String) get changeName => _name.sink.add;
  Function(String) get changeEmail => _email.sink.add;
  Function(String) get changePhone => _phone.sink.add;
  Function(String) get changePosition => _position.sink.add;
  Function(String) get changeAddress => _address.sink.add;
  Function(String) get changePwd => _pwd.sink.add;
  Function(String) get changeRePwd => _rePwd.sink.add;

  Stream<String> get name => _name.stream;
  Stream<String> get email => _email.stream;
  Stream<String> get phone => _phone.stream;
  Stream<String> get position => _position.stream;
  Stream<String> get address => _address.stream;
  Stream<String> get pwd => _pwd.stream.transform(pwdValidator);
  Stream<String> get rePwd => _rePwd.stream.transform(pwdValidator);

  Stream<bool> get submitValid =>
      CombineLatestStream.combine3(_email, _pwd, _rePwd, (a, b, c) {
        if (a != null)
          if (!a.contains('@'))
            return false;

        if (b != null) {
          if (b.length < 8 ||
              !b.contains(new RegExp('r[a-z]')) ||
              !b.contains(new RegExp('r[0-9]'))) return false;
        }

        if (b != c) return false;
        return true;
      });

  update() {
    print(_name.value);
    print(_email.value);
    print(_phone.value);
    print(_position.value);
    print(_address.value);
  }

  dispose() {
    _name.close();
    _email.close();
    _phone.close();
    _position.close();
    _address.close();
    _pwd.close();
    _rePwd.close();
  }
}
