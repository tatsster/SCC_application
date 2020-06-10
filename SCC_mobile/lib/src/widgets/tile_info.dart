import 'package:flutter/material.dart';

class TileInfo extends StatelessWidget {
  final Widget child;

  TileInfo({this.child});

  @override
  Widget build(BuildContext context) {
    return Material(
      elevation: 14.0,
      borderRadius: BorderRadius.circular(12.0),
      shadowColor: Colors.blue[50],
      child: InkWell(
        child: child,
      ),
    );
  }

}