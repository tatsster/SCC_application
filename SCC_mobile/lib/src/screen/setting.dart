import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:flutter_staggered_grid_view/flutter_staggered_grid_view.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';

import '../widgets/main_drawer.dart';
import '../widgets/tile_info.dart';
import '../widgets/updateThreshold.dart';
import '../widgets/refresh.dart';
import '../blocs/BlocProvider.dart';

class Setting extends StatelessWidget {
  final GlobalKey<ScaffoldState> _scaffoldKey = new GlobalKey<ScaffoldState>();

  Widget build(BuildContext context) {
    return Refresh(
      context: context,
      child: buildSettingPage(context),
    );
  }

  Widget buildSettingPage(BuildContext context) {
    final settingBloc = BlocProvider.of(context).settingBloc;

    return Scaffold(
      key: _scaffoldKey,
      appBar: AppBar(
        title: Text(
          'Setting',
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
      body: StaggeredGridView.count(
        crossAxisCount: 2,
        crossAxisSpacing: 12.0,
        mainAxisSpacing: 12.0,
        padding: EdgeInsets.symmetric(horizontal: 16.0, vertical: 8.0),
        children: <Widget>[
          // ! Temperature threshold
          TileInfo(
            child: Padding(
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
                        showInputDialog(context, settingBloc, 0);
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
                      child: displayThreshold(
                          context, 0, Colors.redAccent, '\u00B0C'),
                    ),
                  ),
                ],
              ),
            ),
          ),

          // ! Humidity threshold
          TileInfo(
            child: Padding(
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
                        showInputDialog(context, settingBloc, 1);
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
                      child:
                          displayThreshold(context, 1, Colors.blueAccent, '%'),
                    ),
                  ),
                ],
              ),
            ),
          ),

          // ! Backup log
          TileInfo(
            child: Padding(
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
                  backupButton(context),
                ],
              ),
            ),
          ),

          // ! Maintance mode
          settingBloc.isAdmin == true
              ? TileInfo(
                  child: Padding(
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
                        maintainButton(context),
                      ],
                    ),
                  ),
                )
              : Container(),
        ],
        staggeredTiles: [
          StaggeredTile.extent(2, 200.0),
          StaggeredTile.extent(2, 200.0),
          StaggeredTile.extent(2, 70.0),
          settingBloc.isAdmin == true
              ? StaggeredTile.extent(2, 70.0)
              : StaggeredTile.extent(2, 0.0),
        ],
      ),
    );
  }

  List<TextSpan> printThresholdHelper(
      AsyncSnapshot<int> snapshot, Color textColor, String measure) {
    if (snapshot.hasData == false) {
      return <TextSpan>[
        TextSpan(text: measure),
      ];
    } else if (snapshot.data >= 0) {
      return <TextSpan>[
        TextSpan(
          text: '${snapshot.data}',
          style: TextStyle(
            color: textColor,
            fontWeight: FontWeight.bold,
          ),
        ),
        TextSpan(text: measure),
      ];
    } else {
      return <TextSpan>[
        TextSpan(
          text: 'Auto',
          style: TextStyle(
            color: textColor,
            fontWeight: FontWeight.bold,
          ),
        ),
      ];
    }
  }

  Widget displayThreshold(
      BuildContext context, int type, Color textColor, String measure) {
    final settingBloc = BlocProvider.of(context).settingBloc;

    return StreamBuilder(
      stream: settingBloc.getThreshold(type),
      builder: (context, AsyncSnapshot<int> snapshot) {
        return RichText(
          text: TextSpan(
            style: TextStyle(
              fontSize: 55.0,
              color: Colors.black,
            ),
            children: printThresholdHelper(snapshot, textColor, measure),
          ),
        );
      },
    );
  }

  Widget backupButton(BuildContext context) {
    final settingBloc = BlocProvider.of(context).settingBloc;
    return StreamBuilder(
      stream: settingBloc.statusBackup,
      builder: (context, snapshot) {
        return Transform.scale(
          scale: 1.25,
          child: Switch.adaptive(
            value: snapshot.hasData == false ? false : snapshot.data,
            onChanged: settingBloc.getBackup,
          ),
        );
      },
    );
  }

  Widget maintainButton(BuildContext context) {
    final settingBloc = BlocProvider.of(context).settingBloc;
    return StreamBuilder(
      stream: settingBloc.statusMaintance,
      builder: (context, snapshot) {
        return Transform.scale(
          scale: 1.25,
          child: Switch.adaptive(
            value: snapshot.hasData == false ? false : snapshot.data,
            onChanged: settingBloc.getMaintance,
          ),
        );
      },
    );
  }
}
