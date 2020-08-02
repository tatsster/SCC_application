import 'package:flutter/material.dart';
import '../widgets/main_drawer.dart';

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
      body: buildDashboard(context),
    );
  }

  Widget buildDashboard(BuildContext context) {
    return Container();
  }
}
