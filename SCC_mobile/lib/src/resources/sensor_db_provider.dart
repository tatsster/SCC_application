import 'package:postgres/postgres.dart';
import 'dart:async';
import 'dart:convert';
import '../model/item_model.dart';

class SSDbProvider {
  final String db_host = "ec2-34-194-198-176.compute-1.amazonaws.com";
  final String db_user = "ahnqlwzmzmptqv";
  final String db_password =
      "65008320a3546ddd4f3ad0ef7e0bc1ac390f9c59e700c17bd6fd8ab4a7b470bc";
  final String db_name = "dbss9sqf9cctjl";
  final int db_port = 5432;

  PostgreSQLConnection connection;

  init() async {
    this.connection = PostgreSQLConnection(
        this.db_host, this.db_port, this.db_name,
        username: this.db_user, password: this.db_password);

    await connection.open();
  }

  Future<List<dynamic>> latestItem() async {
    // Future<List<ItemModel>> fetchItems() async {
    List<dynamic> results =
        await connection.query('SELECT * FROM temp_humid_log');
    return results[0];
  }
}
