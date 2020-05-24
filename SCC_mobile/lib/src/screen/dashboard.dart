import 'package:flutter/material.dart';
import '../model/class_info.dart';
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
      body: buildClass(context),
    );
  }

  Widget buildClass(BuildContext context) {
    return Center(
      child: SingleChildScrollView(
        scrollDirection: Axis.vertical,
        child: DataTable(
          sortAscending: true,
          showCheckboxColumn: false,
          dividerThickness: 5.0,
          columns: [
            DataColumn(
              label: Text(
                'Room',
                style: TextStyle(
                  fontWeight: FontWeight.bold,
                  fontSize: 25,
                  color: Colors.black,
                ),
                textAlign: TextAlign.center,
              ),
            ),
            DataColumn(
              label: Text(
                'Floor',
                style: TextStyle(
                  fontWeight: FontWeight.bold,
                  fontSize: 25,
                  color: Colors.black,
                ),
                textAlign: TextAlign.center,
              ),
            ),
            DataColumn(
              label: Text(
                'Building',
                style: TextStyle(
                  fontWeight: FontWeight.bold,
                  fontSize: 25,
                  color: Colors.black,
                ),
                textAlign: TextAlign.center,
              ),
            ),
          ],
          rows: classes
              .map(
                (row) => DataRow(
                    cells: [
                      DataCell(
                        Container(
                          child: Text(
                            '${row.room}',
                            style: TextStyle(
                              fontSize: 20.0,
                            ),
                          ),
                          alignment: Alignment.center,
                        ),
                        placeholder: false,
                      ),
                      DataCell(
                        Container(
                          child: Text(
                            row.floor,
                            style: TextStyle(
                              fontSize: 20.0,
                            ),
                          ),
                          alignment: Alignment.center,
                        ),
                        placeholder: false,
                      ),
                      DataCell(
                        Container(
                          child: Text(
                            row.building,
                            style: TextStyle(
                              fontSize: 20.0,
                            ),
                          ),
                          alignment: Alignment.center,
                        ),
                        placeholder: false,
                      ),
                    ],
                    onSelectChanged: (bool selected) {
                      if (selected)
                        Navigator.pushNamed(context, '/room/${row.room}');
                    }),
              )
              .toList(),
        ),
      ),
    );
  }
}
