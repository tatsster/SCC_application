import 'package:SCC_mobile/src/blocs/db_provider.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:flutter_staggered_grid_view/flutter_staggered_grid_view.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';

import '../widgets/main_drawer.dart';
import '../widgets/tile_info.dart';

class Setting extends StatelessWidget {
  final GlobalKey<ScaffoldState> _scaffoldKey = new GlobalKey<ScaffoldState>();

  // ! Enter button will use BLOC Stream sink to change value
  // @param: Stream sink to sink.add() right
  showAlertDialog(BuildContext context) {
    showDialog(
      context: context,
      builder: (BuildContext context) {
        return CupertinoAlertDialog(
          title: Text(
            "Change Threshold",
            style: TextStyle(fontWeight: FontWeight.bold),
          ),
          content: CupertinoTextField(
            style: TextStyle(
              fontSize: 25.0,
              fontWeight: FontWeight.bold,
            ),
            textAlign: TextAlign.center,
            padding: EdgeInsets.only(
              left: 15.0,
              right: 15.0,
            ),
            keyboardType: TextInputType.number,
            decoration: BoxDecoration(
              border: Border.all(color: Colors.black),
              borderRadius: BorderRadius.circular(32.0),
            ),
          ),
          actions: <Widget>[
            FlatButton(
              child: Text(
                "Enter",
                style: TextStyle(
                  fontSize: 20.0,
                ),
              ),
              onPressed: () {},
            ),
            FlatButton(
              child: Text(
                "Cancel",
                style: TextStyle(
                  fontSize: 20.0,
                ),
              ),
              onPressed: () {
                Navigator.of(context).pop();
              },
            ),
          ],
        );
      },
    );
  }

  @override
  Widget build(BuildContext context) {
    final db_bloc = DbProvider.of(context);

    return Scaffold(
      key: _scaffoldKey,
      appBar: AppBar(
        title: Text(
          'Setting',
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
      body: StaggeredGridView.count(
        crossAxisCount: 2,
        crossAxisSpacing: 12.0,
        mainAxisSpacing: 12.0,
        padding: EdgeInsets.symmetric(horizontal: 16.0, vertical: 8.0),
        children: <Widget>[
          // ! Temperature threshold
          TileInfo(Padding(
            padding: EdgeInsets.fromLTRB(20.0, 0.0, 0.0, 5.0),
            child: Column(
              mainAxisAlignment: MainAxisAlignment.start,
              crossAxisAlignment: CrossAxisAlignment.start,
              children: <Widget>[
                Align(
                  alignment: FractionalOffset.topRight,
                  child: IconButton(
                    icon: Icon(Icons.edit),
                    onPressed: () {
                      // ! Change show dialog here
                      showAlertDialog(context);
                    },
                  ),
                ),
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
                    Expanded(
                      child: Align(
                        alignment: FractionalOffset.topCenter,
                        child: Text(
                          'Temperature Threshold',
                          style: TextStyle(
                            fontSize: 35.0,
                            fontWeight: FontWeight.w700,
                          ),
                          textAlign: TextAlign.center,
                        ),
                      ),
                    ),
                  ],
                ),
                Expanded(
                  child: Align(
                    alignment: FractionalOffset.center,
                    child: RichText(
                      text: TextSpan(
                        style: TextStyle(
                          fontSize: 55.0,
                          color: Colors.black,
                        ),
                        children: <TextSpan>[
                          TextSpan(
                            text: '28',
                            style: TextStyle(
                              color: Colors.redAccent,
                              fontWeight: FontWeight.bold,
                            ),
                          ),
                          TextSpan(text: '\u00B0C'),
                        ],
                      ),
                    ),
                  ),
                ),
              ],
            ),
          )),

          // ! Brightness threshold
          TileInfo(Padding(
            padding: EdgeInsets.fromLTRB(20.0, 0.0, 0.0, 5.0),
            child: Column(
              mainAxisAlignment: MainAxisAlignment.start,
              crossAxisAlignment: CrossAxisAlignment.start,
              children: <Widget>[
                Align(
                  alignment: FractionalOffset.topRight,
                  child: IconButton(
                    icon: Icon(Icons.edit),
                    onPressed: () {
                      // ! Change show dialog here
                      showAlertDialog(context);
                    },
                  ),
                ),
                Row(
                  crossAxisAlignment: CrossAxisAlignment.center,
                  children: <Widget>[
                    Material(
                      color: Colors.blueAccent,
                      shape: CircleBorder(),
                      child: Padding(
                        padding: EdgeInsets.all(12.0),
                        child: FaIcon(
                          FontAwesomeIcons.sun,
                          color: Colors.white,
                          size: 30.0,
                        ),
                      ),
                    ),
                    Expanded(
                      child: Align(
                        alignment: FractionalOffset.topCenter,
                        child: Text(
                          'Humidity Threshold',
                          style: TextStyle(
                            fontSize: 35.0,
                            fontWeight: FontWeight.w700,
                          ),
                          textAlign: TextAlign.center,
                        ),
                      ),
                    ),
                  ],
                ),
                Expanded(
                  child: Align(
                    alignment: FractionalOffset.center,
                    child: RichText(
                      text: TextSpan(
                        style: TextStyle(
                          fontSize: 55.0,
                          color: Colors.black,
                        ),
                        children: <TextSpan>[
                          TextSpan(
                            text: '50',
                            style: TextStyle(
                              color: Colors.blueAccent,
                              fontWeight: FontWeight.bold,
                            ),
                          ),
                          TextSpan(text: '%'),
                        ],
                      ),
                    ),
                  ),
                ),
              ],
            ),
          )),

          // ! Backup log
          TileInfo(Padding(
            padding: EdgeInsets.all(20.0),
            child: Row(
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              crossAxisAlignment: CrossAxisAlignment.center,
              children: <Widget>[
                Text(
                  'Backup log',
                  style: TextStyle(
                    fontSize: 25.0,
                    fontWeight: FontWeight.w700,
                  ),
                ),

                // ! Use DB Bloc here
                StreamBuilder(
                  stream: db_bloc.statusBackup,
                  builder: (context, snapshot) {
                    return Transform.scale(
                      scale: 1.25,
                      child: Switch.adaptive(
                        value:
                            snapshot.hasData == false ? false : snapshot.data,
                        onChanged: db_bloc.getBackup,
                      ),
                    );
                  },
                ),
              ],
            ),
          )),

          // ! Maintance mode
          db_bloc.isAdmin == true
              ? TileInfo(Padding(
                  padding: EdgeInsets.all(20.0),
                  child: Row(
                    mainAxisAlignment: MainAxisAlignment.spaceBetween,
                    crossAxisAlignment: CrossAxisAlignment.center,
                    children: <Widget>[
                      Text(
                        'Maintenance mode',
                        style: TextStyle(
                          fontSize: 25.0,
                          fontWeight: FontWeight.w700,
                        ),
                      ),

                      // ! Use DB Bloc here
                      StreamBuilder(
                        stream: db_bloc.statusMaintenance,
                        builder: (context, snapshot) {
                          return Transform.scale(
                            scale: 1.25,
                            child: Switch.adaptive(
                              value: snapshot.hasData == false
                                  ? false
                                  : snapshot.data,
                              onChanged: db_bloc.getMaintenance,
                            ),
                          );
                        },
                      ),
                    ],
                  ),
                ))
              : Container(),
        ],
        staggeredTiles: [
          StaggeredTile.extent(2, 200.0),
          StaggeredTile.extent(2, 200.0),
          StaggeredTile.extent(2, 70.0),
          db_bloc.isAdmin == true
              ? StaggeredTile.extent(2, 70.0)
              : StaggeredTile.extent(2, 0.0),
        ],
      ),
    );
  }
}
