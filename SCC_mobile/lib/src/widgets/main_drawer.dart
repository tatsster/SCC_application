import 'package:flutter/material.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';

class MainDrawer extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Drawer(
      child: Container(
        color: Colors.black87,
        child: Column(
          children: <Widget>[
            // Container(
            //   width: MediaQuery.of(context).size.width,
            //   height: 250,
            //   decoration: BoxDecoration(
            //     image: DecorationImage(
            //       image: AssetImage('assets/images/logo-Placeholder.png'),
            //       fit: BoxFit.fitWidth,
            //     ),
            //   ),
            // ),
            UserAccountsDrawerHeader(
              accountName: Text(
                'my_email@email.com',
                style: TextStyle(fontSize: 20.0),
              ),
              accountEmail: Text(
                'My Name',
                style: TextStyle(fontSize: 18.0),
              ),
              currentAccountPicture: CircleAvatar(
                child: Text(
                  'M',
                  style: TextStyle(fontSize: 35.0),
                ),
              ),
            ),
            Padding(padding: EdgeInsets.only(top: 20.0)),
            ListTile(
              leading: FaIcon(
                FontAwesomeIcons.tachometerAlt,
                size: 28.0,
                color: Colors.white,
              ),
              title: Text(
                'Dashboard',
                style: TextStyle(
                  fontSize: 20.0,
                  color: Colors.white,
                ),
              ),
              onTap: () {
                Navigator.pushNamed(context, '/');
              },
            ),
            ListTile(
              leading: Icon(
                Icons.assignment,
                size: 30.0,
                color: Colors.white,
              ),
              title: Text(
                'Report',
                style: TextStyle(
                  fontSize: 20.0,
                  color: Colors.white,
                ),
              ),
              onTap: () {
                Navigator.pushNamed(context, '/report');
              },
            ),
            ListTile(
              leading: Icon(
                Icons.settings,
                size: 30.0,
                color: Colors.white,
              ),
              title: Text(
                'Setting',
                style: TextStyle(
                  fontSize: 20.0,
                  color: Colors.white,
                ),
              ),
              onTap: () {
                Navigator.pushNamed(context, '/setting');
              },
            ),
            Divider(),
            Expanded(
              child: Container(
                padding: EdgeInsets.only(left: 3.0),
                alignment: Alignment.bottomLeft,
                child: ListTile(
                  leading: FaIcon(
                    FontAwesomeIcons.signOutAlt,
                    size: 26.0,
                    color: Colors.white,
                  ),
                  title: Text(
                    'Logout',
                    style: TextStyle(
                      fontSize: 22.0,
                      color: Colors.white,
                    ),
                  ),
                ),
              ),
            ),
          ],
        ),
      ),
    );
  }
}
