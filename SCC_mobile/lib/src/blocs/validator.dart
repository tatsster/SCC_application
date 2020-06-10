import 'dart:async';

class Validator {
  final thresholdValidator = StreamTransformer<int, int>.fromHandlers(
    handleData: (threshold, sink) {
      if (threshold > 0)
        sink.add(threshold);
      else
        sink.addError('Enter a valide threshold');
    },
  );
}
