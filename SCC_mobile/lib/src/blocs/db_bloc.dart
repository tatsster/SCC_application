import 'dart:async';
import 'package:rxdart/rxdart.dart';
import '../model/item_model.dart';
import '../resources/sensor_db_provider.dart';

// TODO: fetch List<double> usage -> total usage

class DbBloc {
  // isAdmin then render Maintain mode - List User
  final isAdmin = true;

  // DB fetching
  final _db = SensorDbProvider();
  final _dbFetcher = PublishSubject<int>();
  final _dbOutput = BehaviorSubject<Future<ItemModel>>();

  // Stream - value of turn device
  final _airc = BehaviorSubject<bool>();
  final _light = BehaviorSubject<bool>();
  final _backup = BehaviorSubject<bool>();
  final _maintain = BehaviorSubject<bool>();

  DbBloc() {
    _dbFetcher.stream.transform(_dbTransformer()).pipe(_dbOutput);
  }

  // Stream getter
  Stream<Future<ItemModel>> get db => _dbOutput.stream;
  // devices
  Stream<bool> get statusAir => _airc.stream;
  Stream<bool> get statusLight => _light.stream;
  Stream<bool> get statusBackup => _backup.stream;
  Stream<bool> get statusMaintenance => _maintain.stream;

  // Sink for Fetcher
  Function(int) get fetchDb => _dbFetcher.sink.add;
  // devices
  Function(bool) get getAirStatus => _airc.sink.add;
  Function(bool) get getLightStatus => _light.sink.add;
  Function(bool) get getBackup => _backup.sink.add;
  Function(bool) get getMaintenance => _maintain.sink.add;

  // Transformer
  _dbTransformer() {
    Future<ItemModel> result;
    return ScanStreamTransformer(
      (Future<ItemModel> cache, int id, _) {
        cache = _db.fetchItem(id);
        return cache;
      },
      result,
    );
  }

  dispose() {
    _dbFetcher.close();
    _dbOutput.close();
    // ! Devices
    _airc.close();
    _light.close();
    _backup.close();
    _maintain.close();
  }
}
