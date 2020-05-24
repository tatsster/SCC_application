import 'dart:convert';

class ItemModel {
  final lightStatus;
  final fanStatus;

  ItemModel({this.lightStatus, this.fanStatus});

  ItemModel.fromJson(Map<String, dynamic> parsedJson)
      : lightStatus = parsedJson['lightStatus'] ?? '',
        fanStatus = parsedJson['fanStatus'] ?? '';
}
