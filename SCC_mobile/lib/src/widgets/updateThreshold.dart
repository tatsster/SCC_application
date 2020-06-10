import 'package:flutter/material.dart';
import '../blocs/setting_bloc.dart';

void showInputDialog(BuildContext context, SettingBloc bloc, int type) {
  showDialog(
    context: context,
    barrierDismissible: false,
    builder: (BuildContext context) {
      return AlertDialog(
        title: Text(
          "Change Threshold",
          style: TextStyle(fontWeight: FontWeight.bold),
        ),
        content: Container(
          height: 40.0,
          child: StreamBuilder(
            stream: bloc.thresholdFetcher(type),
            builder: (context, snapshot) {
              return TextField(
                onChanged: (String value) {
                  bloc.updateThreshold(int.parse(value), type);
                },
                style: TextStyle(
                  fontSize: 25.0,
                  fontWeight: FontWeight.bold,
                ),
                textAlign: TextAlign.center,
                keyboardType: TextInputType.number,
                decoration: InputDecoration(
                  contentPadding: EdgeInsets.only(bottom: 5.0),
                  border: OutlineInputBorder(
                    borderRadius: BorderRadius.circular(32.0),
                  ),
                ),
              );
            },
          ),
        ),
        actions: <Widget>[
          StreamBuilder(
            stream: bloc.thresholdFetcher(type),
            builder: (context, snapshot) {
              return FlatButton(
                child: Text(
                  "Enter",
                  style: TextStyle(
                    fontSize: 20.0,
                  ),
                ),
                onPressed: () {
                  if (snapshot.hasData) {
                    bloc.sendThreshold(type);
                    Navigator.of(context).pop();
                  }
                },
              );
            },
          ),
          FlatButton(
            child: Text(
              "Auto",
              style: TextStyle(
                fontSize: 20.0,
              ),
            ),
            onPressed: () {
              bloc.autoThreshold(type);
              Navigator.of(context).pop();
            },
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
