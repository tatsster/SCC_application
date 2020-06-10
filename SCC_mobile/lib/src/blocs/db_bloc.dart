import 'dart:async';
import 'package:rxdart/rxdart.dart';
import '../model/item_model.dart';
import '../resources/sensor_db_provider.dart';

// TODO: fetch List<double> usage -> total usage

class DbBloc {
  // isAdmin then render Maintain mode - List User
  final isAdmin = true;

  // DB fetching
  final _db = SSDbProvider();
  // final _dbFetcher = PublishSubject<int>();
  final _dbLatest = BehaviorSubject<List<dynamic>>();

  // Stream - value of turn device
  final _airc = BehaviorSubject<bool>();
  final _light = BehaviorSubject<bool>();

  DbBloc() {
    _db.init();
    // _dbFetcher.stream.transform(_dbTransformer()).pipe(_dbOutput);
  }

  // Stream getter
  Stream<List<dynamic>> get dbLatest => _dbLatest.stream;
  // devices
  Stream<bool> get statusAir => _airc.stream;
  Stream<bool> get statusLight => _light.stream;

  // devices
  void getAirStatus(bool value) {
    _airc.sink.add(value);
    // Send status to DB
  }

  void getLightStatus(bool value) {
    _light.sink.add(value);
    // Send status to DB
  }
  // Function(bool) get getAirStatus => _airc.sink.add;
  // Function(bool) get getLightStatus => _light.sink.add;

  fetchItem() async {
    final item = await _db.latestItem();
    _dbLatest.sink.add(item);
  }

  dispose() {
    // _dbFetcher.close();
    _dbLatest.close();
    _airc.close();
    _light.close();
  }
}
