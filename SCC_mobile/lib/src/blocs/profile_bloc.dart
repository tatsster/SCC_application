import 'package:flutter/material.dart';
import 'dart:async';
import 'package:SCC_mobile/src/model/login_data.dart';
import 'package:rxdart/rxdart.dart';

import 'validator.dart';

class ProfileBloc with Validator {
  final _name = BehaviorSubject<String>();
  final _email = BehaviorSubject<String>.seeded(null);
  final _phone = BehaviorSubject<String>();
  final _address = BehaviorSubject<String>();
  final _pwd = BehaviorSubject<String>.seeded(null);
  final _rePwd = BehaviorSubject<String>.seeded(null);

  Function(String) get changeName => _name.sink.add;
  Function(String) get changeEmail => _email.sink.add;
  Function(String) get changePhone => _phone.sink.add;
  Function(String) get changeAddress => _address.sink.add;
  Function(String) get changePwd => _pwd.sink.add;
  Function(String) get changeRePwd => _rePwd.sink.add;

  Stream<String> get name => _name.stream;
  Stream<String> get email => _email.stream;
  Stream<String> get phone => _phone.stream;
  Stream<String> get address => _address.stream;
  Stream<String> get pwd => _pwd.stream.transform(pwdValidator);
  Stream<String> get rePwd => _rePwd.stream.transform(pwdValidator);

  Stream<bool> get submitValid => CombineLatestStream.combine4(
      email, name, phone, address, (a, b, c, d) => true);
  //     {
  //   print(a);
  //   if (a != null) {
  //     if (!a.contains('@')) return false;
  //   }

  //   if (a == null && b == null && c == null && d == null && e == null)
  //     return false;
  //   return true;
  // }

  void update(BuildContext context, User userInfo) {
    print(_name.value);
    print(_email.value);
    print(_phone.value);
    print(_address.value);
    if (_pwd.value != _rePwd.value) {
      _rePwd.sink.addError("Please check your confirm password !!!");
      return;
    }

    if (_email.value != null) {
      if (_email.value.split("@").length == 2) {
        userInfo.userEmail = _email.value;
      }
    }

    if (_phone.value != null) userInfo.userMobile = _phone.value;
    if (_address.value != null) userInfo.userAddress = _address.value;
    if (_name.value != null) userInfo.userFullname = _name.value;
    Navigator.pushNamed(context, '/profile');
  }

  dispose() {
    _name.close();
    _email.close();
    _phone.close();
    _address.close();
    _pwd.close();
    _rePwd.close();
  }
}
