import 'package:flutter/material.dart';
import 'package:horizontal_data_table/horizontal_data_table.dart';
import 'package:intl/intl.dart';

import '../widgets/main_drawer.dart';
import '../model/temp_humid_log.dart';
import '../blocs/BlocProvider.dart';

// var data = generate();

class Report extends StatelessWidget {
  final GlobalKey<ScaffoldState> _scaffoldKey = new GlobalKey<ScaffoldState>();

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      key: _scaffoldKey,
      appBar: AppBar(
        title: Text(
          'Report',
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
      body: buildBody(context),
    );
  }

  Widget buildBody(BuildContext context) {
    final SSDbBloc = BlocProvider.of(context).ssDbBloc;

    return NotificationListener(
      child: buildDataLog(context),
      onNotification: (Notification notify) {
        if (notify is ScrollEndNotification) {
          SSDbBloc.fetchLog(SSDbBloc.limit + 20);
          return true;
        } else
          return false;
      },
    );
  }

  Widget buildDataLog(BuildContext context) {
    final SSDbBloc = BlocProvider.of(context).ssDbBloc;

    return StreamBuilder(
      stream: SSDbBloc.temphumidLog,
      builder: (context, AsyncSnapshot<TempHumidLog> snapshot) {
        if (snapshot.hasData)
          return Container(
            child: HorizontalDataTable(
              leftHandSideColumnWidth: 100,
              rightHandSideColumnWidth: 550,
              isFixedHeader: true,
              headerWidgets: _headersWidget(),
              leftSideItemBuilder: _generateFirstCol,
              rightSideItemBuilder: _generateRightCols,
              itemCount: snapshot.data.data.length,
              rowSeparatorWidget: Divider(
                color: Colors.black54,
                height: 1.0,
                thickness: 2.0,
              ),
              elevation: 10.0,
            ),
            height: MediaQuery.of(context).size.height,
          );
        else
          return Center(
            child: CircularProgressIndicator(),
          );
      },
    );
  }

  List<Widget> _headersWidget() {
    return [
      Container(
        child: Text(
          "Sensor ID",
          style: TextStyle(fontWeight: FontWeight.bold, fontSize: 23.0),
          textAlign: TextAlign.center,
        ),
        width: 100,
        height: 56,
        alignment: Alignment.center,
        color: Colors.blueAccent[100],
      ),
      Container(
        child: Text("Temperature",
            style: TextStyle(fontWeight: FontWeight.bold, fontSize: 23.0)),
        width: 150,
        height: 56,
        alignment: Alignment.center,
        color: Colors.blueAccent[100],
      ),
      Container(
        child: Text("Humidity",
            style: TextStyle(fontWeight: FontWeight.bold, fontSize: 23.0)),
        width: 100,
        height: 56,
        alignment: Alignment.center,
        color: Colors.blueAccent[100],
      ),
      Container(
        child: Text("Heat Index",
            style: TextStyle(fontWeight: FontWeight.bold, fontSize: 23.0)),
        width: 150,
        height: 56,
        alignment: Alignment.center,
        color: Colors.blueAccent[100],
      ),
      Container(
        child: Text("Date time",
            style: TextStyle(fontWeight: FontWeight.bold, fontSize: 23.0)),
        width: 150,
        height: 56,
        alignment: Alignment.center,
        color: Colors.blueAccent[100],
      ),
    ];
  }

  Widget _generateFirstCol(BuildContext context, int index) {
    final SSDbBloc = BlocProvider.of(context).ssDbBloc;

    return StreamBuilder(
      stream: SSDbBloc.temphumidLog,
      builder: (context, AsyncSnapshot<TempHumidLog> snapshot) {
        if (snapshot.hasData)
          return Container(
            child: Text(
              '${snapshot.data.data[index].sensorId}',
              style: TextStyle(
                fontSize: 18.0,
                fontWeight: FontWeight.w700,
              ),
              textAlign: TextAlign.center,
            ),
            width: 100,
            height: 52,
            alignment: Alignment.center,
            color: index % 2 == 0 ? Colors.grey : Colors.white,
          );
        else
          return Container();
      },
    );
  }

  Widget _generateRightCols(BuildContext context, int index) {
    final SSDbBloc = BlocProvider.of(context).ssDbBloc;

    return StreamBuilder(
      stream: SSDbBloc.temphumidLog,
      builder: (context, AsyncSnapshot<TempHumidLog> snapshot) {
        if (snapshot.hasData)
          return Row(
            children: <Widget>[
              Container(
                child: Text(
                  '${snapshot.data.data[index].sensorTemp}',
                  style: TextStyle(fontSize: 20.0, fontWeight: FontWeight.w500),
                ),
                width: 150,
                height: 52,
                alignment: Alignment.center,
                color: index % 2 == 0 ? Colors.grey : Colors.white,
              ),
              Container(
                child: Text(
                  '${snapshot.data.data[index].sensorHumid}',
                  style: TextStyle(fontSize: 20.0, fontWeight: FontWeight.w500),
                ),
                width: 100,
                height: 52,
                alignment: Alignment.center,
                color: index % 2 == 0 ? Colors.grey : Colors.white,
              ),
              Container(
                child: Text(
                  '${snapshot.data.data[index].sensorHeatIndex}',
                  style: TextStyle(fontSize: 20.0, fontWeight: FontWeight.w500),
                ),
                width: 150,
                height: 52,
                alignment: Alignment.center,
                color: index % 2 == 0 ? Colors.grey : Colors.white,
              ),
              Container(
                child: RichText(
                  text: TextSpan(
                    style: TextStyle(
                      fontSize: 18.0,
                      fontWeight: FontWeight.w500,
                      color: Colors.black,
                    ),
                    children: [
                      TextSpan(
                          text: DateFormat.yMMMMd().format(
                                  snapshot.data.data[index].sensorTimestamp) +
                              '\n'),
                      TextSpan(
                          text: DateFormat.jm().format(
                              snapshot.data.data[index].sensorTimestamp))
                    ],
                  ),
                  textAlign: TextAlign.center,
                ),
                width: 150,
                height: 52,
                alignment: Alignment.center,
                color: index % 2 == 0 ? Colors.grey : Colors.white,
              ),
            ],
          );
        else
          return Row(
            children: <Widget>[
              Container(),
              Container(),
              Container(),
              Container(),
              Container(),
            ],
          );
      },
    );
  }
}
