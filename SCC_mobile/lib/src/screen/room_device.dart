import 'package:flutter/material.dart';

import '../model/device_db.dart';
import '../widgets/device.dart';
import '../widgets/main_drawer.dart';
import '../widgets/refresh.dart';
import '../blocs/BlocProvider.dart';

class RoomDevice extends StatelessWidget {
  String buildingName;
  String roomName;
  List<String> deviceID;
  var deviceWidget;
  final GlobalKey<ScaffoldState> _scaffoldKey = new GlobalKey<ScaffoldState>();

  RoomDevice({this.buildingName, this.roomName});

  Widget build(BuildContext context) {
    return Refresh(
      context: context,
      child: buildSettingPage(context),
    );
  }

  Widget buildSettingPage(BuildContext context) {
    return Scaffold(
      key: _scaffoldKey,
      appBar: AppBar(
        title: Text(
          'Device ${this.roomName}${this.buildingName}',
          style: TextStyle(
            color: Colors.black,
            fontSize: 18.0,
          ),
        ),
        backgroundColor: Colors.white,
        elevation: 2.0,
        leading: IconButton(
          icon: const Icon(
            Icons.arrow_back,
            color: Colors.black,
            size: 25.0,
          ),
          onPressed: () => Navigator.of(context).pop(),
        ),
      ),
      body: buildSettingBody(context),
    );
  }

  Widget buildSettingBody(BuildContext context) {
    final deviceBloc = BlocProvider.of(context).bloc.deviceBloc;

    return StreamBuilder(
      stream: deviceBloc.deviceDB,
      builder: (context, AsyncSnapshot<DeviceDB> snapshot) {
        if (!snapshot.hasData)
          return Center(child: CircularProgressIndicator());
        else
          return buildSettingDevice(context, snapshot.data);
      },
    );
  }

  Widget buildSettingDevice(BuildContext context, DeviceDB devices) {
    this.deviceID = List<String>();
    for (var item in devices.data) this.deviceID.add(item.deviceId);

    // ! If no device for room
    if (this.deviceID.length == 0) return Container();

    // ! Get default device widget
    final deviceBloc = BlocProvider.of(context).bloc.deviceBloc;
    String dropdownValue = this.deviceID[0];
    var deviceView = Device(deviceList: devices.data);
    this.deviceWidget =
        deviceView.getView(context, dropdownValue, devices.data[0].devicePid);

    return StreamBuilder(
      stream: deviceBloc.deviceID,
      builder: (context, AsyncSnapshot<String> snapshot) {
        return Column(
          mainAxisAlignment: MainAxisAlignment.start,
          crossAxisAlignment: CrossAxisAlignment.start,
          children: <Widget>[
            // ! Select device
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
                      padding: EdgeInsets.all(8.0),
                      child: Text(
                        'Device: ',
                        style: TextStyle(color: Colors.white, fontSize: 18.0),
                      ),
                    ),
                  ),
                ),

                // ! Dropdown button
                Padding(
                  padding: EdgeInsets.all(5.0),
                  child: DropdownButton<String>(
                    items: this
                        .deviceID
                        .map<DropdownMenuItem<String>>((String value) {
                      return DropdownMenuItem<String>(
                        value: value,
                        child: Text(value),
                      );
                    }).toList(),
                    onChanged: (String value) {
                      dropdownValue = value;
                      deviceBloc.changeDevice(value);
                      this.deviceWidget = deviceView.getView(context, value,
                          devices.data[this.deviceID.indexOf(value)].devicePid);
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

            // ! List all threshold
            snapshot.hasData
                ? this.deviceWidget
                : Center(child: CircularProgressIndicator()),
          ],
        );
      },
    );
  }
}
