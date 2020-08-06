import 'package:flutter/material.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';
import '../blocs/BlocProvider.dart';

class MainDrawer extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    var userInfo = BlocProvider.of(context).user.data[0].user;

    return Drawer(
      child: Container(
        color: Colors.black87,
        child: Column(
          children: <Widget>[
            // ! User Icon
            UserAccountsDrawerHeader(
              accountName: Text(
                userInfo.userEmail,
                style: TextStyle(fontSize: 20.0),
              ),
              accountEmail: Text(
                userInfo.userFullname,
                style: TextStyle(fontSize: 18.0),
              ),
              currentAccountPicture: CircleAvatar(
                child: CircleAvatar(
                  backgroundImage: AssetImage('assets/images/me.jpg'),
                  radius: 33.0,
                ),
              ),
            ),
            Padding(padding: EdgeInsets.only(top: 20.0)),
            // ! Tab Dashboard
            ListTile(
              leading: FaIcon(
                FontAwesomeIcons.tachometerAlt,
                size: 30.0,
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
                Navigator.pushNamed(context, '/dashboard');
              },
            ),
            // ! Tab Report
            ListTile(
              leading: Icon(
                Icons.assignment,
                size: 28.0,
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
            // ! Tab System log 
            ListTile(
              leading: Icon(
                Icons.settings,
                size: 30.0,
                color: Colors.white,
              ),
              title: Text(
                'System Log',
                style: TextStyle(
                  fontSize: 20.0,
                  color: Colors.white,
                ),
              ),
              onTap: () {
                Navigator.pushNamed(context, '/systemlog');
              },
            ),
            // ! Log out and profile
            Expanded(
              child: Container(
                padding: EdgeInsets.only(left: 3.0),
                alignment: Alignment.bottomLeft,
                child: Column(
                  mainAxisAlignment: MainAxisAlignment.end,
                  children: <Widget>[
                    Divider(
                      color: Colors.white60,
                      thickness: 0.5,
                    ),
                    ListTile(
                      leading: FaIcon(
                        FontAwesomeIcons.userCircle,
                        size: 26.0,
                        color: Colors.white,
                      ),
                      title: Text(
                        'Profile',
                        style: TextStyle(
                          fontSize: 22.0,
                          color: Colors.white,
                        ),
                      ),
                      onTap: () {
                        Navigator.pushNamed(context, '/profile');
                      },
                    ),
                    ListTile(
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
                      onTap: () {
                        BlocProvider.of(context).user = null;
                        Navigator.pushNamed(context, '/');
                      },
                    ),
                  ],
                ),
              ),
            ),
          ],
        ),
      ),
    );
  }
}
