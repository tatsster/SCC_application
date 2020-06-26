import 'dart:async';

class Validator {
  final thresholdValidator = StreamTransformer<int, int>.fromHandlers(
    handleData: (threshold, sink) {
      if (threshold > 0 && threshold <= 100)
        sink.add(threshold);
      else
        sink.addError('Enter a valide threshold');
    },
  );

  final emailValidator = StreamTransformer<String, String>.fromHandlers(
    handleData: (email, sink) {
      if (email.contains('@'))
        sink.add(email);
      else
        sink.addError('Enter a valid email');
    },
  );

  final pwdValidator = StreamTransformer<String, String>.fromHandlers(
      handleData: (password, sink) {
    if (password.length >= 8 &&
        password.contains(new RegExp('r[a-z]')) &&
        password.contains(new RegExp('r[0-9]')))
      sink.add(password);
    else
      sink.addError('Your password is not secured');
  });
}
