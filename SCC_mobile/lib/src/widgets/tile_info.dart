import 'package:flutter/material.dart';

class TileInfo extends StatelessWidget {
  final Widget child;
  final Color color;

  TileInfo({this.child, this.color = Colors.white});

  @override
  Widget build(BuildContext context) {
    return Material(
      elevation: 14.0,
      color: this.color,
      borderRadius: BorderRadius.circular(12.0),
      shadowColor: Colors.blue[50],
      child: InkWell(
        child: child,
      ),
    );
  }
}
