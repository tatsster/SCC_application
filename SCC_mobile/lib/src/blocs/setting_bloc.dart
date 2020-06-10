import 'dart:async';
import 'package:rxdart/rxdart.dart';

import '../blocs/validator.dart';

class SettingBloc with Validator{
  final isAdmin = true;

  final List<BehaviorSubject<int>> _thresholdFetcher = [];
  final List<BehaviorSubject<int>> _threshold = [];
  final _backup = BehaviorSubject<bool>();
  final _maintance = BehaviorSubject<bool>();

  SettingBloc() {
    for (var i = 0; i < 2; i++) {
      _thresholdFetcher.add(BehaviorSubject<int>());
      _threshold.add(BehaviorSubject<int>());
    }
  }

  Stream<int> thresholdFetcher(int type) => _thresholdFetcher[type].stream.transform(thresholdValidator);
  Stream<int> getThreshold(int type) => _threshold[type].stream;
  Stream<bool> get statusBackup => _backup.stream;
  Stream<bool> get statusMaintance => _maintance.stream;

  void getBackup(bool value) {
    _backup.sink.add(value);
    // Push status to DB
  }

  void getMaintance(bool value) {
    _maintance.sink.add(value);
    // Push status to DB
  }

  updateThreshold(int value, int type) =>
      _thresholdFetcher[type].sink.add(value);

  sendThreshold(int type) {
    var threshold = _thresholdFetcher[type].value;
    _threshold[type].sink.add(threshold);
    // Push this threshold to DB
  }

  autoThreshold(int type) {
    _threshold[type].sink.add(-1);
    // Push Auto-threshold to DB
  }

  dispose() {
    for (var i = 0; i < 2; i++) {
      _thresholdFetcher[i].close();
      _threshold[i].close();
    }
    _backup.close();
    _maintance.close();
  }
}
