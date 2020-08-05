import 'package:SCC_mobile/src/model/electrical.dart';
import 'package:SCC_mobile/src/model/weather.dart';
import 'package:flutter/material.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';

import '../widgets/main_drawer.dart';
import '../widgets/tile_info.dart';
import '../blocs/BlocProvider.dart';

class Dashboard extends StatelessWidget {
  final GlobalKey<ScaffoldState> _scaffoldKey = new GlobalKey<ScaffoldState>();

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      key: _scaffoldKey,
      appBar: AppBar(
        title: Text(
          'Dashboard',
          style: TextStyle(
            fontSize: 26.0,
            color: Colors.black,
          ),
        ),
        backgroundColor: Colors.white,
        elevation: 2.0,
        leading: IconButton(
          icon: const Icon(Icons.menu),
          color: Colors.black,
          iconSize: 28.0,
          onPressed: () {
            _scaffoldKey.currentState.openDrawer();
          },
        ),
      ),
      drawer: MainDrawer(),
      body: buildDashboard(context),
    );
  }

  Widget buildDashboard(BuildContext context) {
    return Center(
      child: Column(
        mainAxisAlignment: MainAxisAlignment.spaceAround,
        crossAxisAlignment: CrossAxisAlignment.center,
        children: <Widget>[
          buildWeather(context, "Temperature", Colors.red,
              FontAwesomeIcons.thermometer, true),
          buildWeather(context, "Humidity", Colors.blue[400],
              FontAwesomeIcons.cloud, false),
          buildElectric(context, "Hours Usage", Colors.greenAccent[700],
              FontAwesomeIcons.clock, true),
          buildElectric(context, "Electrical Consumption", Colors.yellow,
              FontAwesomeIcons.bolt, false),
        ],
      ),
    );
  }

  Widget buildWeather(BuildContext context, String title, Color color,
      IconData fontAwesomeIcon, bool isTemper) {
    final dashboardBloc = BlocProvider.of(context).bloc.dashboardBloc;

    return TileInfo(
      color: color,
      child: Container(
        width: MediaQuery.of(context).size.width - 40,
        height: 95,
        child: Padding(
          padding: EdgeInsets.all(15.0),
          child: Row(
            mainAxisAlignment: MainAxisAlignment.spaceBetween,
            crossAxisAlignment: CrossAxisAlignment.start,
            children: <Widget>[
              Column(
                mainAxisAlignment: MainAxisAlignment.start,
                crossAxisAlignment: CrossAxisAlignment.start,
                children: <Widget>[
                  Text(
                    title,
                    style: TextStyle(
                      color: Colors.white,
                      fontSize: 18,
                      fontWeight: FontWeight.w500,
                    ),
                  ),
                  StreamBuilder(
                    stream: dashboardBloc.weather,
                    builder: (context, AsyncSnapshot<Weather> snapshot) {
                      if (snapshot.hasData)
                        return Text(
                          isTemper
                              ? "${snapshot.data.data[0].currentTemperature}"
                              : "${snapshot.data.data[0].currentHumidity}",
                          style: TextStyle(
                              color: Colors.white,
                              fontSize: 36,
                              fontWeight: FontWeight.bold),
                        );
                      else
                        return Container();
                    },
                  ),
                ],
              ),
              Center(
                child: FaIcon(
                  fontAwesomeIcon,
                  color: Colors.black.withOpacity(0.3),
                  size: 36,
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }

  Widget buildElectric(BuildContext context, String title, Color color,
      IconData fontAwesomeIcon, bool isHours) {
    final dashboardBloc = BlocProvider.of(context).bloc.dashboardBloc;

    return TileInfo(
      color: color,
      child: Container(
        width: MediaQuery.of(context).size.width - 40,
        height: 95,
        child: Padding(
          padding: EdgeInsets.all(15.0),
          child: Row(
            mainAxisAlignment: MainAxisAlignment.spaceBetween,
            crossAxisAlignment: CrossAxisAlignment.start,
            children: <Widget>[
              Column(
                mainAxisAlignment: MainAxisAlignment.start,
                crossAxisAlignment: CrossAxisAlignment.start,
                children: <Widget>[
                  Text(
                    title,
                    style: TextStyle(
                      color: Colors.white,
                      fontSize: 18,
                      fontWeight: FontWeight.w500,
                    ),
                  ),
                  StreamBuilder(
                    stream: dashboardBloc.electrical,
                    builder: (context, AsyncSnapshot<Electrical> snapshot) {
                      if (snapshot.hasData)
                        return Text(
                          isHours
                              ? "${snapshot.data.data[0].hoursUsage}"
                              : "${snapshot.data.data[0].electricalConsumption}",
                          style: TextStyle(
                              color: Colors.white,
                              fontSize: 36,
                              fontWeight: FontWeight.bold),
                        );
                      else
                        return Container();
                    },
                  ),
                ],
              ),
              Center(
                child: FaIcon(
                  fontAwesomeIcon,
                  color: Colors.black.withOpacity(0.3),
                  size: 36,
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }
}
