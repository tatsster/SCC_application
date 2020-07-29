import 'package:flutter/material.dart';

import '../widgets/refresh.dart';
import '../widgets/sensorData.dart';
import '../blocs/BlocProvider.dart';
import '../model/temp_humid_log.dart';
import '../model/sensor_info.dart';

class DataClass extends StatelessWidget {
  String buildingName;
  String roomName;
  List<String> sensorIDs;
  final GlobalKey<ScaffoldState> _scaffoldKey = new GlobalKey<ScaffoldState>();

  DataClass({this.buildingName, this.roomName});

  @override
  Widget build(BuildContext context) {
    return Refresh(
      context: context,
      child: buildDataClassPage(context),
    );
  }

  Widget buildDataClassPage(BuildContext context) {
    return Scaffold(
      key: _scaffoldKey,
      appBar: AppBar(
        elevation: 2.0,
        backgroundColor: Colors.white,
        title: Text(
          'Sensor ${this.roomName}${this.buildingName}',
          style: TextStyle(
            color: Colors.black,
            fontSize: 18.0,
          ),
        ),
        leading: IconButton(
          icon: const Icon(
            Icons.arrow_back,
            color: Colors.black,
            size: 25.0,
          ),
          onPressed: () => Navigator.of(context).pop(),
        ),
        actions: <Widget>[
          Padding(
            padding: EdgeInsets.only(right: 20.0),
            child: GestureDetector(
              onTap: () {
                Navigator.pushNamed(
                    context, '/setting/${this.buildingName}-${this.roomName}');
              },
              child: Icon(
                Icons.arrow_forward,
                size: 25.0,
                color: Colors.black,
              ),
            ),
          ),
        ],
      ),
      body: loadSensor(context),
    );
  }

  Widget loadSensor(BuildContext context) {
    // * Wait to load all sensor id in this room
    final SSDbBloc = BlocProvider.of(context).bloc.ssDbBloc;
    return StreamBuilder(
      stream: SSDbBloc.sensorInfo,
      builder: (context, AsyncSnapshot<SensorInfo> snapshot) {
        if (!snapshot.hasData)
          return Center(child: CircularProgressIndicator());
        else
          return loadSensorInfo(context, snapshot.data);
      },
    );
  }

  Widget loadSensorInfo(BuildContext context, SensorInfo sensorInfo) {
    this.sensorIDs = List<String>();
    for (var item in sensorInfo.data) this.sensorIDs.add(item.sensorId);

    // ! If No data
    if (this.sensorIDs.length == 0) return buildNoData(context);

    // * Fetch sensor data with SENSOR_ID
    final SSDbBloc = BlocProvider.of(context).bloc.ssDbBloc;
    SSDbBloc.fetchSensorData(context, this.sensorIDs[0]);

    String dropdownValue = this.sensorIDs[0];

    return StreamBuilder(
      stream: SSDbBloc.sensorData,
      builder: (context, AsyncSnapshot<TempHumidLog> snapshot) {
        return Column(
          mainAxisAlignment: MainAxisAlignment.start,
          crossAxisAlignment: CrossAxisAlignment.start,
          children: <Widget>[
            Row(
              mainAxisAlignment: MainAxisAlignment.start,
              crossAxisAlignment: CrossAxisAlignment.start,
              children: <Widget>[
                Padding(
                  padding: EdgeInsets.only(
                      left: 15.0, right: 5, top: 15.0, bottom: 15.0),
                  child: Container(
                    decoration: BoxDecoration(
                      color: Colors.blue[900],
                      borderRadius: BorderRadius.circular(8.0),
                    ),
                    child: Padding(
                      padding: const EdgeInsets.all(8.0),
                      child: Text(
                        'Sensor: ',
                        style: TextStyle(color: Colors.white, fontSize: 18.0),
                      ),
                    ),
                  ),
                ),

                // ! Select sensorID
                Padding(
                  padding: const EdgeInsets.all(10.0),
                  child: DropdownButton<String>(
                    items: this
                        .sensorIDs
                        .map<DropdownMenuItem<String>>((String value) {
                      return DropdownMenuItem<String>(
                        value: value,
                        child: Text(value),
                      );
                    }).toList(),
                    onChanged: (String value) {
                      dropdownValue = value;
                      // ! Fetch new data with sensorID = value
                      SSDbBloc.fetchSensorData(context, value);
                    },
                    value: dropdownValue,
                    style: TextStyle(color: Colors.blue[900], fontSize: 16.0),
                    elevation: 16,
                    underline: Container(
                      height: 2,
                      color: Colors.blue[900],
                    ),
                  ),
                ),
              ],
            ),

            // ! View data from this Sensor which is from latest TempHumidLog
            // * Get sensorPid by find its indexOf sensorIDs == indexOf sensorInfo
            snapshot.hasData
                ? SensorData(
                    sensorData: snapshot.data,
                    sensorId: dropdownValue,
                    sensorPid: sensorInfo
                        .data[this.sensorIDs.indexOf(dropdownValue)].sensorPid,
                  )
                : Center(child: CircularProgressIndicator()),
          ],
        );
      },
    );
  }

  Widget buildNoData(BuildContext context) {
    this.sensorIDs = <String>[];
    var dropdownValue = '';

    return Column(
      mainAxisAlignment: MainAxisAlignment.start,
      crossAxisAlignment: CrossAxisAlignment.start,
      children: <Widget>[
        Row(
          mainAxisAlignment: MainAxisAlignment.start,
          crossAxisAlignment: CrossAxisAlignment.start,
          children: <Widget>[
            Padding(
              padding: EdgeInsets.only(
                  left: 15.0, right: 5, top: 15.0, bottom: 15.0),
              child: Container(
                decoration: BoxDecoration(
                  color: Colors.blue[900],
                  borderRadius: BorderRadius.circular(8.0),
                ),
                child: Padding(
                  padding: const EdgeInsets.all(8.0),
                  child: Text(
                    'Sensor: ',
                    style: TextStyle(color: Colors.white, fontSize: 18.0),
                  ),
                ),
              ),
            ),

            // ! Select sensorID
            Padding(
              padding: const EdgeInsets.all(10.0),
              child: DropdownButton<String>(
                items: this
                    .sensorIDs
                    .map<DropdownMenuItem<String>>((String value) {
                  return DropdownMenuItem<String>(
                    value: value,
                    child: Text(value),
                  );
                }).toList(),
                onChanged: (String value) {
                  dropdownValue = value;
                },
                value: dropdownValue,
                style: TextStyle(color: Colors.blue[900], fontSize: 16.0),
                elevation: 16,
                underline: Container(
                  height: 2,
                  color: Colors.blue[900],
                ),
              ),
            ),
          ],
        ),

        // ! No data
        Center(child: CircularProgressIndicator()),
      ],
    );
  }
}
