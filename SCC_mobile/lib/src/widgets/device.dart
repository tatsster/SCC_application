import 'package:flutter/material.dart';

import 'tile_info.dart';
import '../model/device_db.dart';
import '../blocs/BlocProvider.dart';

class Device {
  List<Data> deviceList;
  String deviceId;
  String devicePid;
  Data device;

  Device({this.deviceList});

  Widget getView(BuildContext context, String deviceId, String devicePid) {
    this.deviceId = deviceId;
    for (var item in this.deviceList)
      if (item.deviceId == this.deviceId) {
        this.device = item;
        this.devicePid = item.devicePid;
      }

    return Column(
      mainAxisAlignment: MainAxisAlignment.start,
      children: <Widget>[
        Row(
          mainAxisAlignment: MainAxisAlignment.spaceAround,
          crossAxisAlignment: CrossAxisAlignment.start,
          children: <Widget>[
            buildThreshold('Lower Threshold', this.device.deviceLowerThreshold,
                Icons.arrow_downward),
            buildThreshold('Upper Threshold', this.device.deviceUpperThreshold,
                Icons.arrow_upward),
          ],
        ),

        // ! Turn device
        Padding(
          padding: EdgeInsets.only(top: 8.0, left: 10.0, right: 10.0),
          child: buildTurnDevice(context, this.devicePid),
        ),
      ],
    );
  }

  // ! Show Threshold
  Widget buildThreshold(String title, String threshold, IconData icon) {
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
                      padding: EdgeInsets.all(10.0),
                      child: Icon(
                        icon,
                        color: Colors.white,
                        size: 30.0,
                      ),
                    ),
                  ),

                  // ! Get threshold data
                  Expanded(
                    child: Container(
                      alignment: Alignment.centerRight,
                      child: showThreshold(threshold),
                    ),
                  ),
                ],
              ),
              Expanded(
                child: Container(
                  alignment: Alignment.bottomLeft,
                  padding: EdgeInsets.only(bottom: 8.0),
                  child: Text(
                    title,
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

  Widget showThreshold(String threshold) {
    return Text(
      '$threshold\n\u00B0C',
      style: TextStyle(
        fontSize: 30.0,
        fontWeight: FontWeight.w700,
      ),
      textAlign: TextAlign.right,
    );
  }

  Widget buildTurnDevice(BuildContext context, String devicePid) {
    return TileInfo(
      child: Padding(
        padding:
            EdgeInsets.only(left: 20.0, right: 20.0, top: 10.0, bottom: 10.0),
        child: Row(
          mainAxisAlignment: MainAxisAlignment.spaceBetween,
          crossAxisAlignment: CrossAxisAlignment.center,
          children: <Widget>[
            Text(
              'Turn Device',
              style: TextStyle(
                fontSize: 25.0,
                fontWeight: FontWeight.w700,
              ),
            ),

            // ! Use DB Bloc here
            buttonTurnDevice(context, devicePid),
          ],
        ),
      ),
    );
  }

  Widget buttonTurnDevice(BuildContext context, String devicePid) {
    final deviceBloc = BlocProvider.of(context).bloc.deviceBloc;
    deviceBloc.initDeviceStatus(devicePid != null ? true : false);

    return StreamBuilder(
      stream: deviceBloc.deviceStatus,
      builder: (context, AsyncSnapshot<bool> snapshot) {
        if (snapshot.hasData)
          return Transform.scale(
            scale: 1.25,
            child: Switch.adaptive(
              value: snapshot.data,
              onChanged: (bool newValue) {
                deviceBloc.changeStatusDevice(context, this.device, newValue);
              },
            ),
          );
        else
          return Container(height: 0, width: 0);
      },
    );
  }
}
