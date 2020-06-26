import 'package:flutter/material.dart';

class TileFloor extends StatelessWidget {
  final Widget floor;
  final Widget rooms;

  TileFloor({this.floor, this.rooms});

  @override
  Widget build(BuildContext context) {
    return Material(
      elevation: 14.0,
      borderRadius: BorderRadius.circular(12.0),
      shadowColor: Colors.blue[50],
      child: Padding(
        padding: const EdgeInsets.all(8.0),
        child: Column(
          mainAxisSize: MainAxisSize.min,
          mainAxisAlignment: MainAxisAlignment.start,
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            InkWell(
              child: floor,
            ),
            Divider(
              thickness: 0.5,
              color: Colors.black,
            ),
            SizedBox(
              height: 35.0,
              child: rooms,
            ),
          ],
        ),
      ),
    );
  }
}
