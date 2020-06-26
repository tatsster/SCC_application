import 'package:SCC_mobile/src/widgets/refresh.dart';
import 'package:flutter/material.dart';
import 'package:flutter_sparkline/flutter_sparkline.dart';
import 'package:flutter_staggered_grid_view/flutter_staggered_grid_view.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';

import '../widgets/tile_info.dart';
import '../blocs/BlocProvider.dart';
import '../model/sensor_info.dart';

class DataClass extends StatelessWidget {
  final int classId;
  final GlobalKey<ScaffoldState> _scaffoldKey = new GlobalKey<ScaffoldState>();
  final List<double> chart = [];

  DataClass({this.classId});

  @override
  Widget build(BuildContext context) {
    return Refresh(
      context: context,
      child: buildDataClassPage(context),
    );
  }

  Widget buildDataClassPage(BuildContext context) {
    final SSDbBloc = BlocProvider.of(context).ssDbBloc;

    return Scaffold(
      key: _scaffoldKey,
      appBar: AppBar(
        elevation: 2.0,
        backgroundColor: Colors.white,
        title: Text(
          'Room ${this.classId}',
          style: TextStyle(
            color: Colors.black,
            fontSize: 22.0,
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
      ),
      body: StaggeredGridView.count(
        crossAxisCount: 2,
        crossAxisSpacing: 12.0,
        mainAxisSpacing: 12.0,
        padding: EdgeInsets.symmetric(horizontal: 16.0, vertical: 8.0),

        // ! Temperature
        children: <Widget>[
          TileInfo(
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
                          child: temperatureValue(context),
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

          // ! Humidity
          TileInfo(
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
                          child: humidityValue(context),
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

          // ! Electricity usage
          // buildElectricGraph(context),

          // ! Turn Fan
          TileInfo(
            child: Padding(
              padding: EdgeInsets.all(20.0),
              child: Row(
                mainAxisAlignment: MainAxisAlignment.spaceBetween,
                crossAxisAlignment: CrossAxisAlignment.center,
                children: <Widget>[
                  Text(
                    'Air Conditioner',
                    style: TextStyle(
                      fontSize: 25.0,
                      fontWeight: FontWeight.w700,
                    ),
                  ),

                  // ! Use DB Bloc here
                  airButton(context),
                ],
              ),
            ),
          ),

          // ! Turn light
          TileInfo(
            child: Padding(
              padding: EdgeInsets.all(20.0),
              child: Row(
                mainAxisAlignment: MainAxisAlignment.spaceBetween,
                crossAxisAlignment: CrossAxisAlignment.center,
                children: <Widget>[
                  Text(
                    'Light',
                    style: TextStyle(
                      fontSize: 25.0,
                      fontWeight: FontWeight.w700,
                    ),
                  ),

                  // ! Use DB Bloc here
                  lightButton(context),
                ],
              ),
            ),
          ),
        ],

        staggeredTiles: [
          StaggeredTile.extent(1, 150.0),
          StaggeredTile.extent(1, 150.0),
          // StaggeredTile.extent(2, 250.0),
          StaggeredTile.extent(2, 70.0),
          StaggeredTile.extent(2, 70.0),
        ],
      ),
    );
  }

  Widget temperatureValue(BuildContext context) {
    final SSDbBloc = BlocProvider.of(context).ssDbBloc;
    return StreamBuilder(
      stream: SSDbBloc.sensorInfo,
      builder: (BuildContext context, AsyncSnapshot<SensorInfo> snapshot) {
        if (snapshot.hasData && snapshot.data.data[0].sensorTemp != null)
          return Text(
            '${snapshot.data.data[0].sensorTemp}\n\u00B0C',
            style: TextStyle(
              fontSize: 30.0,
              fontWeight: FontWeight.w700,
            ),
            textAlign: TextAlign.right,
          );
        else
          return Container();
      },
    );
  }

  Widget humidityValue(BuildContext context) {
    final SSDbBloc = BlocProvider.of(context).ssDbBloc;
    return StreamBuilder(
      stream: SSDbBloc.sensorInfo,
      builder: (context, AsyncSnapshot<SensorInfo> snapshot) {
        if (snapshot.hasData && snapshot.data.data[0].sensorHumid != null)
          return Text(
            '${snapshot.data.data[0].sensorHumid}\n%',
            style: TextStyle(
              fontSize: 30.0,
              fontWeight: FontWeight.w700,
            ),
            textAlign: TextAlign.right,
          );
        else
          return Container();
      },
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
              data: chart,
              lineWidth: 5.0,
              lineColor: Colors.greenAccent,
            ),
          ],
        ),
      ),
    );
  }

  Widget airButton(BuildContext context) {
    final SSDbBloc = BlocProvider.of(context).ssDbBloc;
    return StreamBuilder(
      stream: SSDbBloc.statusAir,
      builder: (context, snapshot) {
        return Transform.scale(
          scale: 1.25,
          child: Switch.adaptive(
            value: snapshot.hasData == false ? false : snapshot.data,
            onChanged: SSDbBloc.getAirStatus,
          ),
        );
      },
    );
  }

  Widget lightButton(BuildContext context) {
    final SSDbBloc = BlocProvider.of(context).ssDbBloc;
    return StreamBuilder(
      stream: SSDbBloc.statusLight,
      builder: (context, snapshot) {
        return Transform.scale(
          scale: 1.25,
          child: Switch.adaptive(
            value: snapshot.hasData == false ? false : snapshot.data,
            onChanged: SSDbBloc.getLightStatus,
          ),
        );
      },
    );
  }
}
