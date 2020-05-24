import 'package:flutter/material.dart';
import 'package:horizontal_data_table/horizontal_data_table.dart';
import 'package:intl/intl.dart';

import '../widgets/main_drawer.dart';
import '../model/sensor_info.dart';

var data = generate();

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
            fontSize: 30.0,
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
    return Container(
      child: HorizontalDataTable(
        leftHandSideColumnWidth: 100,
        rightHandSideColumnWidth: 550,
        isFixedHeader: true,
        headerWidgets: _headersWidget(),
        leftSideItemBuilder: _generateFirstCol,
        rightSideItemBuilder: _generateRightCols,
        itemCount: data.length,
        rowSeparatorWidget: Divider(
          color: Colors.black54,
          height: 1.0,
          thickness: 2.0,
        ),
        elevation: 10.0,
      ),
      height: MediaQuery.of(context).size.height,
    );
  }

  List<Widget> _headersWidget() {
    return [
      Container(
        child: Text("Room",
            style: TextStyle(fontWeight: FontWeight.bold, fontSize: 23.0)),
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
        child: RichText(
          text: TextSpan(
            style: TextStyle(
                fontSize: 20.0,
                color: Colors.black,
                fontWeight: FontWeight.bold),
            children: [TextSpan(text: 'Exceed '), TextSpan(text: 'Threshold')],
          ),
          textAlign: TextAlign.center,
        ),
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
    return Container(
      child: Text(
        '${data[index].room}',
        style: TextStyle(fontSize: 23.0, fontWeight: FontWeight.bold),
      ),
      width: 100,
      height: 52,
      alignment: Alignment.center,
      color: index % 2 == 0 ? Colors.grey : Colors.white,
    );
  }

  Widget _generateRightCols(BuildContext context, int index) {
    return Row(
      children: <Widget>[
        Container(
          child: Text(
            '${data[index].temp}',
            style: TextStyle(fontSize: 20.0, fontWeight: FontWeight.w500),
          ),
          width: 150,
          height: 52,
          alignment: Alignment.center,
          color: index % 2 == 0 ? Colors.grey : Colors.white,
        ),
        Container(
          child: Text(
            '${data[index].humid}',
            style: TextStyle(fontSize: 20.0, fontWeight: FontWeight.w500),
          ),
          width: 100,
          height: 52,
          alignment: Alignment.center,
          color: index % 2 == 0 ? Colors.grey : Colors.white,
        ),
        Container(
          child: Text(
            data[index].exceed == true ? 'X' : '',
            style:
                TextStyle(color: Colors.redAccent, fontWeight: FontWeight.bold, fontSize: 20.0),
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
                    text: '${DateFormat.yMMMMd().format(data[index].time)}\n'),
                TextSpan(text: DateFormat.jm().format(data[index].time))
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
  }
}
