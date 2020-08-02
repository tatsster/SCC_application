import 'package:SCC_mobile/src/widgets/building.dart';
import 'package:flutter/material.dart';

import '../widgets/main_drawer.dart';
import '../blocs/BlocProvider.dart';

class Report extends StatelessWidget {
  final GlobalKey<ScaffoldState> _scaffoldKey = new GlobalKey<ScaffoldState>();
  List<String> building = <String>[];
  List<Widget> buildingWidget;

  @override
  Widget build(BuildContext context) {
    final roomProvider = BlocProvider.of(context).bloc.roomList;

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
      body: StreamBuilder(
        stream: roomProvider.roomInfo,
        builder: (context, snapshot) {
          if (!snapshot.hasData)
            return Center(
              child: CircularProgressIndicator(),
            );
          else {
            for (var room in roomProvider.getRoomInfo.data) {
              if (!this.building.contains(room.roomBuilding)) {
                this.building.add(room.roomBuilding);
              }
            }
            return buildBuilding(context);
          }
        },
      ),
    );
  }

  Widget buildBuilding(BuildContext context) {
    final roomProvider = BlocProvider.of(context).bloc.roomList;
    String dropdownValue = this.building[0];
    var buildingView = Building(
        allRoom: roomProvider.getRoomInfo.data, buildingName: dropdownValue);
    this.buildingWidget = buildingView.getView(context);

    return StreamBuilder(
      stream: roomProvider.building,
      builder: (context, AsyncSnapshot<String> snapshot) {
        return Column(
          mainAxisAlignment: MainAxisAlignment.start,
          crossAxisAlignment: CrossAxisAlignment.start,
          children: <Widget>[
            // ! Select building
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
                        'Building: ',
                        style: TextStyle(color: Colors.white, fontSize: 18.0),
                      ),
                    ),
                  ),
                ),

                // ! Dropdown Button
                Padding(
                  padding: const EdgeInsets.all(5.0),
                  child: DropdownButton<String>(
                    items: this
                        .building
                        .map<DropdownMenuItem<String>>((String value) {
                      return DropdownMenuItem<String>(
                        value: value,
                        child: Text(value),
                      );
                    }).toList(),
                    onChanged: (String value) {
                      dropdownValue = value;
                      roomProvider.getBuilding(value);
                      buildingView = Building(
                          allRoom: roomProvider.getRoomInfo.data,
                          buildingName: value);
                      this.buildingWidget = buildingView.getView(context);
                    },
                    value: dropdownValue,
                    style: TextStyle(color: Colors.blue[900], fontSize: 18.0),
                    elevation: 16,
                    underline: Container(
                      height: 2,
                      color: Colors.blue[900],
                    ),
                  ),
                ),
              ],
            ),

            // ! List all in building
            SingleChildScrollView(
              child: Column(
                mainAxisAlignment: MainAxisAlignment.start,
                crossAxisAlignment: CrossAxisAlignment.start,
                // TODO: building(building_name) return List<Widget>
                children: this.buildingWidget,
              ),
            ),
          ],
        );
      },
    );
  }
}
