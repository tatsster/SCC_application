import 'package:flutter/material.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';

import '../model/class_info.dart';
import '../model/building.dart';
import '../widgets/main_drawer.dart';
import '../widgets/tile_floor.dart';

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
      body: buildBuilding(context),
    );
  }

  Widget buildBuilding(BuildContext context) {
    List<Widget> _building = <Widget>[];
    _building.add(buildingButton(context));
    for (int i = B4.floor.length; i > 0; i--)
      _building.add(buildFloor(context, i));

    return SingleChildScrollView(
      child: Column(
        mainAxisAlignment: MainAxisAlignment.start,
        crossAxisAlignment: CrossAxisAlignment.start,
        children: _building,
      ),
    );
  }

  Widget buildingButton(BuildContext context) {
    return Padding(
      padding: const EdgeInsets.all(10.0),
      child: Container(
        width: 115.0,
        padding: EdgeInsets.all(3.0),
        alignment: Alignment.center,
        child: Text(
          'Building: ${B4.name}',
          style: TextStyle(color: Colors.white, fontSize: 18.0),
        ),
        decoration: BoxDecoration(
            borderRadius: BorderRadius.circular(8.0), color: Colors.blue),
      ),
    );
  }

  Widget buildFloor(BuildContext context, int floorId) {
    return Padding(
      padding: EdgeInsets.only(left: 8.0, right: 8.0, bottom: 10.0),
      child: Row(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          // ! Floor Icon
          Container(
            width: 35,
            height: 35,
            alignment: Alignment.center,
            child: FaIcon(
              FontAwesomeIcons.building,
              size: 20.0,
              color: Colors.white,
            ),
            decoration: BoxDecoration(
              shape: BoxShape.circle,
              color: Colors.green[800],
            ),
          ),
          Padding(
            padding: EdgeInsets.only(right: 10.0),
          ),
          // ! Floor info tile
          Expanded(
            child: TileFloor(
              floor: Container(
                height: 25.0,
                alignment: Alignment.centerLeft,
                child: Text(
                  'Floor: $floorId',
                  style: TextStyle(
                    color: Colors.blue,
                    fontWeight: FontWeight.bold,
                    fontSize: 18.0,
                  ),
                ),
              ),
              rooms: ListView.builder(
                scrollDirection: Axis.horizontal,
                shrinkWrap: true,
                itemCount: B4.floor[floorId].length,
                itemBuilder: (context, index) {
                  return buildRoom(context, floorId, index);
                },
              ),
            ),
          ),
        ],
      ),
    );
  }

  Widget buildRoom(BuildContext context, int floorId, int index) {
    return Padding(
      padding: const EdgeInsets.only(right: 5.0),
      child: InkWell(
        child: Container(
          width: 80.0,
          padding: EdgeInsets.all(4.0),
          alignment: Alignment.centerLeft,
          child: Text(
            '${B4.floor[floorId][index]}',
            textAlign: TextAlign.center,
            style: TextStyle(
              color: Colors.white,
              fontSize: 14.0,
            ),
          ),
          decoration: BoxDecoration(
            borderRadius: BorderRadius.circular(8.0),
            color: Colors.teal[700],
          ),
        ),
        onTap: () {
          Navigator.pushNamed(context, '/room/${B4.floor[floorId][index]}');
        },
      ),
    );
  }
}
