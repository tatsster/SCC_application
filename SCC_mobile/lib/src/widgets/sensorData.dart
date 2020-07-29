import 'package:flutter/material.dart';
import 'package:flutter_sparkline/flutter_sparkline.dart';
import 'package:flutter_staggered_grid_view/flutter_staggered_grid_view.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';

import '../widgets/tile_info.dart';
import '../model/temp_humid_log.dart';
import '../blocs/BlocProvider.dart';

class SensorData extends StatelessWidget {
  TempHumidLog sensorData;
  String sensorPid;
  String sensorId;

  SensorData({this.sensorId, this.sensorData, this.sensorPid});

  @override
  Widget build(BuildContext context) {
    return Column(
      mainAxisAlignment: MainAxisAlignment.start,
      children: <Widget>[
        Row(
          mainAxisAlignment: MainAxisAlignment.spaceAround,
          crossAxisAlignment: CrossAxisAlignment.start,
          children: <Widget>[
            buildTemp(),
            buildHumid(),
          ],
        ),
        Padding(
          padding: EdgeInsets.only(top: 8.0, left: 10.0, right: 10.0),
          child: buildTurnSensor(context),
        ),
      ],
    );
  }

  // ! Temperature
  Widget buildTemp() {
    return TileInfo(
      child: Container(
        width: 150,
        height: 150,
        child: Padding(
          padding: EdgeInsets.all(15.0),
          child: Column(
            mainAxisAlignment: MainAxisAlignment.start,
            crossAxisAlignment: CrossAxisAlignment.start,
            children: <Widget>[
              Row(
                crossAxisAlignment: CrossAxisAlignment.center,
                children: <Widget>[
                  Material(
                    color: Colors.redAccent,
                    shape: CircleBorder(),
                    child: Padding(
                      padding: EdgeInsets.all(18.0),
                      child: FaIcon(
                        FontAwesomeIcons.thermometerEmpty,
                        color: Colors.white,
                        size: 30.0,
                      ),
                    ),
                  ),

                  // ! Get temperature from sensor BLOC to here
                  Expanded(
                    child: Container(
                      alignment: Alignment.centerRight,
                      child: temperatureValue(),
                    ),
                  ),
                ],
              ),
              Expanded(
                child: Container(
                  alignment: Alignment.bottomLeft,
                  padding: EdgeInsets.only(bottom: 8.0),
                  child: Text(
                    'Temperature',
                    style: TextStyle(
                      fontSize: 20.0,
                      fontWeight: FontWeight.bold,
                    ),
                  ),
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }

  // ! Humidity
  Widget buildHumid() {
    return TileInfo(
      child: Container(
        width: 150,
        height: 150,
        child: Padding(
          padding: EdgeInsets.all(15.0),
          child: Column(
            mainAxisAlignment: MainAxisAlignment.start,
            crossAxisAlignment: CrossAxisAlignment.start,
            children: <Widget>[
              Row(
                crossAxisAlignment: CrossAxisAlignment.center,
                children: <Widget>[
                  Material(
                    color: Colors.blue,
                    shape: CircleBorder(),
                    child: Padding(
                      padding: EdgeInsets.all(12.0),
                      child: FaIcon(
                        FontAwesomeIcons.snowflake,
                        color: Colors.white,
                        size: 30.0,
                      ),
                    ),
                  ),

                  // ! Get humidity from sensor BLOC to here
                  Expanded(
                    child: Container(
                      alignment: Alignment.centerRight,
                      child: humidityValue(),
                    ),
                  ),
                ],
              ),
              Expanded(
                child: Container(
                  alignment: Alignment.bottomLeft,
                  padding: EdgeInsets.only(bottom: 8.0),
                  child: Text(
                    'Humidity',
                    style: TextStyle(
                      fontSize: 20.0,
                      fontWeight: FontWeight.bold,
                    ),
                  ),
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }

  Widget temperatureValue() {
    return Text(
      this.sensorData.data.length != 0
          ? '${this.sensorData.data[0].sensorTemp}\n\u00B0C'
          : '\n\u00B0C',
      style: TextStyle(
        fontSize: 30.0,
        fontWeight: FontWeight.w700,
      ),
      textAlign: TextAlign.right,
    );
  }

  Widget humidityValue() {
    return Text(
      this.sensorData.data.length != 0
          ? '${this.sensorData.data[0].sensorHumid}\n%'
          : '\n%',
      style: TextStyle(
        fontSize: 30.0,
        fontWeight: FontWeight.w700,
      ),
      textAlign: TextAlign.right,
    );
  }

  Widget buttonTurnSensor(BuildContext context) {
    final SSDbBloc = BlocProvider.of(context).bloc.ssDbBloc;
    // * Init status
    SSDbBloc.initSensorStatus(this.sensorPid != null ? true : false);

    return StreamBuilder(
      stream: SSDbBloc.statusSensor,
      builder: (context, AsyncSnapshot<bool> snapshot) {
        if (snapshot.hasData)
          return Transform.scale(
            scale: 1.25,
            child: Switch.adaptive(
              value: snapshot.data,
              onChanged: (bool newValue) {
                SSDbBloc.changeStatusSensor(context, this.sensorId, newValue);
              },
            ),
          );
        else
          return Container(height: 0, width: 0);
      },
    );
  }

  Widget buildTurnSensor(BuildContext context) {
    return TileInfo(
      child: Padding(
        padding:
            EdgeInsets.only(left: 20.0, right: 20.0, top: 10.0, bottom: 10.0),
        child: Row(
          mainAxisAlignment: MainAxisAlignment.spaceBetween,
          crossAxisAlignment: CrossAxisAlignment.center,
          children: <Widget>[
            Text(
              'Turn Sensor',
              style: TextStyle(
                fontSize: 25.0,
                fontWeight: FontWeight.w700,
              ),
            ),

            // ! Use DB Bloc here
            buttonTurnSensor(context),
          ],
        ),
      ),
    );
  }

  Widget buildElectricGraph(BuildContext context) {
    return TileInfo(
      child: Padding(
        padding: EdgeInsets.all(20.0),
        child: Column(
          mainAxisAlignment: MainAxisAlignment.start,
          crossAxisAlignment: CrossAxisAlignment.start,
          children: <Widget>[
            // * Result usage
            Row(
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              crossAxisAlignment: CrossAxisAlignment.center,
              children: <Widget>[
                Column(
                  mainAxisAlignment: MainAxisAlignment.center,
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: <Widget>[
                    Text(
                      'Total Usage',
                      style:
                          TextStyle(color: Colors.blueAccent, fontSize: 20.0),
                    ),
                    // TODO: Insert data from DB BLOC
                    Text(
                      '3.6 kWh',
                      style: TextStyle(
                        color: Colors.black,
                        fontWeight: FontWeight.w700,
                        fontSize: 32.0,
                      ),
                    ),
                  ],
                ),
                Material(
                  color: Colors.yellowAccent[400],
                  borderRadius: BorderRadius.circular(24.0),
                  child: Padding(
                    padding: EdgeInsets.all(16.0),
                    child: Icon(
                      Icons.timeline,
                      color: Colors.white,
                      size: 28.0,
                    ),
                  ),
                ),
              ],
            ),

            // * Graph usage
            Padding(
              padding: EdgeInsets.only(
                top: 20.0,
              ),
            ),
            Sparkline(
              data: [],
              lineWidth: 5.0,
              lineColor: Colors.greenAccent,
            ),
          ],
        ),
      ),
    );
  }
}
