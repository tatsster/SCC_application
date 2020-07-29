import 'package:flutter/material.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';

import '../model/room_info.dart';
import 'tile_floor.dart';

class Building {
  List<Data> allRoom;
  String buildingName;
  var floors = Map<String, List<Data>>();

  Building({this.allRoom, this.buildingName}) {
    for (var room in allRoom)
      if (room.roomBuilding == buildingName) {
        if (!floors.containsKey(room.roomFloor))
          floors[room.roomFloor] = List<Data>();
        floors[room.roomFloor].add(room);
      }
  }

  List<Widget> getView(BuildContext context) {
    List<Widget> _building = <Widget>[];

    // * Sort as higher floor on top
    List<String> floorNames = floors.keys.toList();
    floorNames.sort((a, b) => b.compareTo(a));
    for (var floorName in floorNames) {
      _building.add(buildFloor(context, floorName));
    }
    return _building;
  }

  Widget buildFloor(BuildContext context, String floorId) {
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
                itemCount: floors[floorId].length,
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

  Widget buildRoom(BuildContext context, String floorId, int index) {
    return Padding(
      padding: const EdgeInsets.only(right: 5.0),
      child: InkWell(
        child: Container(
          width: 80.0,
          padding: EdgeInsets.all(4.0),
          alignment: Alignment.centerLeft,
          child: Text(
            '${floors[floorId][index].roomName}',
            textAlign: TextAlign.center,
            style: TextStyle(
              color: Colors.white,
              fontSize: 14.0,
            ),
          ),
          decoration: BoxDecoration(
            borderRadius: BorderRadius.circular(8.0),
            color: floors[floorId][index].roomActive
                ? Colors.teal[700]
                : Colors.grey[800],
          ),
        ),
        onTap: () {
          if (floors[floorId][index].roomActive)
            Navigator.pushNamed(context,
                '/room/$buildingName-${floors[floorId][index].roomName}');
        },
      ),
    );
  }
}
