import 'package:flutter/material.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';

import '../widgets/tile_info.dart';
import '../blocs/BlocProvider.dart';
import '../widgets/main_drawer.dart';

class Profile extends StatelessWidget {
  final GlobalKey<ScaffoldState> _scaffoldKey = new GlobalKey<ScaffoldState>();
  var userInfo;

  @override
  Widget build(BuildContext context) {
    this.userInfo = BlocProvider.of(context).user.data[0].user;

    return Scaffold(
      key: _scaffoldKey,
      appBar: AppBar(
        title: Text(
          'Profile',
          style: TextStyle(
            color: Colors.black,
            fontSize: 26.0,
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
      body: SingleChildScrollView(
        padding: EdgeInsets.only(bottom: 10.0),
        child: Column(
          children: [
            buildProfile(context),
            buildAbout(context),
            buildEdit(context),
          ],
        ),
      ),
    );
  }

  Widget buildProfile(BuildContext context) {
    return Container(
      height: 238,
      padding: EdgeInsets.all(10.0),
      alignment: Alignment.topCenter,
      child: TileInfo(
        child: Padding(
          padding: EdgeInsets.all(12.0),
          child: Column(
            mainAxisAlignment: MainAxisAlignment.start,
            crossAxisAlignment: CrossAxisAlignment.center,
            children: <Widget>[
              CircleAvatar(
                backgroundImage: AssetImage('assets/images/me.jpg'),
                radius: 40.0,
              ),
              Padding(
                padding: EdgeInsets.symmetric(vertical: 15, horizontal: 4),
                child: Text(
                  userInfo.userFullname,
                  style: TextStyle(
                    fontSize: 18,
                    fontWeight: FontWeight.bold,
                  ),
                ),
              ),
              Padding(
                padding: EdgeInsets.symmetric(horizontal: 4),
                child: Text(
                  userInfo.userEmail,
                  style: TextStyle(fontSize: 14),
                ),
              ),
              Padding(
                padding: EdgeInsets.symmetric(vertical: 15, horizontal: 4),
                child: Text(
                  userInfo.userMobile,
                  style: TextStyle(fontSize: 14),
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }

  Widget buildAbout(BuildContext context) {
    return Container(
      decoration: BoxDecoration(
        color: Colors.white,
        borderRadius: BorderRadius.circular(8.0),
        boxShadow: [
          BoxShadow(
            color: Colors.grey,
            spreadRadius: 5,
            blurRadius: 7,
            offset: Offset(0, 3),
          ),
        ],
      ),
      width: 330,
      alignment: Alignment.topCenter,
      child: Column(
        mainAxisAlignment: MainAxisAlignment.start,
        crossAxisAlignment: CrossAxisAlignment.center,
        children: [
          Container(
            padding: EdgeInsets.all(8.0),
            alignment: Alignment.center,
            child: Text(
              'About Me',
              style: TextStyle(
                color: Colors.white,
                fontWeight: FontWeight.bold,
                fontSize: 16,
              ),
            ),
            decoration: BoxDecoration(
              color: Colors.blue[800],
              borderRadius: BorderRadius.circular(8.0),
            ),
          ),
          ListTile(
            leading: FaIcon(
              FontAwesomeIcons.pen,
              color: Colors.black,
              size: 16,
            ),
            title: Align(
              alignment: Alignment(-1.3, 0),
              child: Text(
                'Position',
                style: TextStyle(fontWeight: FontWeight.bold, fontSize: 17),
              ),
            ),
            subtitle: Align(
              alignment: Alignment(-1.4, 0),
              child: Text(
                userInfo.userRole,
                style: TextStyle(fontSize: 15, color: Colors.black),
              ),
            ),
            dense: true,
          ),
          Divider(color: Colors.black),
          ListTile(
            leading: FaIcon(
              FontAwesomeIcons.mapMarkerAlt,
              color: Colors.black,
              size: 16,
            ),
            title: Align(
              alignment: Alignment(-1.3, 0),
              child: Text(
                'Address',
                style: TextStyle(fontWeight: FontWeight.bold, fontSize: 17),
              ),
            ),
            subtitle: Align(
              alignment: Alignment(-1.4, 0),
              child: Text(
                userInfo.userAddress,
                style: TextStyle(fontSize: 15, color: Colors.black),
              ),
            ),
            dense: true,
          ),
        ],
      ),
    );
  }

  Widget buildEdit(BuildContext context) {
    return Container(
      padding: EdgeInsets.all(10.0),
      alignment: Alignment.topLeft,
      child: TileInfo(
        child: Padding(
          padding: EdgeInsets.all(12.0),
          child: Column(
            mainAxisAlignment: MainAxisAlignment.start,
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Container(
                width: 100,
                padding: EdgeInsets.all(8.0),
                alignment: Alignment.center,
                child: Text(
                  'Edit Profile',
                  style: TextStyle(
                    color: Colors.white,
                    fontSize: 16,
                    fontWeight: FontWeight.bold,
                  ),
                ),
                decoration: BoxDecoration(
                  color: Colors.blue,
                  borderRadius: BorderRadius.circular(8.0),
                ),
              ),
              // ! Name
              Container(
                height: 45,
                padding: const EdgeInsets.only(top: 8.0),
                child: Row(
                  mainAxisAlignment: MainAxisAlignment.start,
                  children: [
                    Container(
                      width: 65,
                      child: Text(
                        'Name',
                        style: TextStyle(
                          fontWeight: FontWeight.bold,
                          fontSize: 16,
                        ),
                      ),
                    ),
                    nameField(context),
                  ],
                ),
              ),
              // ! Email
              Container(
                height: 45,
                padding: const EdgeInsets.only(top: 8.0),
                child: Row(
                  mainAxisAlignment: MainAxisAlignment.start,
                  children: [
                    Container(
                      width: 65,
                      child: Text(
                        'Email',
                        style: TextStyle(
                          fontWeight: FontWeight.bold,
                          fontSize: 16,
                        ),
                      ),
                    ),
                    emailField(context),
                  ],
                ),
              ),
              // ! Phone
              Container(
                height: 45,
                padding: const EdgeInsets.only(top: 8.0),
                child: Row(
                  mainAxisAlignment: MainAxisAlignment.start,
                  children: [
                    Container(
                      width: 65,
                      child: Text(
                        'Phone',
                        style: TextStyle(
                          fontWeight: FontWeight.bold,
                          fontSize: 16,
                        ),
                      ),
                    ),
                    phoneField(context),
                  ],
                ),
              ),
              // ! Address
              Container(
                height: 45,
                padding: const EdgeInsets.only(top: 8.0),
                child: Row(
                  mainAxisAlignment: MainAxisAlignment.start,
                  children: [
                    Container(
                      width: 65,
                      child: Text(
                        'Address',
                        style: TextStyle(
                          fontWeight: FontWeight.bold,
                          fontSize: 16,
                        ),
                      ),
                    ),
                    addressField(context),
                  ],
                ),
              ),
              Padding(padding: EdgeInsets.only(top: 15)),
              Divider(thickness: 2),
              Padding(padding: EdgeInsets.only(top: 15)),
              // ! Password
              Container(
                height: 65,
                padding: const EdgeInsets.only(top: 8.0),
                child: Row(
                  mainAxisAlignment: MainAxisAlignment.start,
                  children: [
                    Container(
                      width: 65,
                      alignment: Alignment.centerLeft,
                      child: Text(
                        'Password',
                        style: TextStyle(
                          fontWeight: FontWeight.bold,
                          fontSize: 14,
                        ),
                      ),
                    ),
                    pwdField(context),
                  ],
                ),
              ),
              // ! Confirm password
              Container(
                height: 65,
                padding: const EdgeInsets.only(top: 8.0),
                child: Row(
                  mainAxisAlignment: MainAxisAlignment.start,
                  children: [
                    Container(
                      width: 65,
                      alignment: Alignment.centerLeft,
                      child: Text(
                        'Password Confirm',
                        style: TextStyle(
                          fontWeight: FontWeight.bold,
                          fontSize: 14,
                        ),
                      ),
                    ),
                    rePwdField(context),
                  ],
                ),
              ),
              // ! Edit button
              editButton(context),
            ],
          ),
        ),
      ),
    );
  }

  Widget nameField(BuildContext context) {
    final profileBloc = BlocProvider.of(context).bloc.profileBloc;

    return Flexible(
      child: StreamBuilder(
        stream: profileBloc.name,
        builder: (context, snapshot) {
          return TextField(
            onChanged: profileBloc.changeName,
            decoration: InputDecoration(
              hintText: userInfo.userFullname,
              hintStyle: TextStyle(fontSize: 14),
              border: OutlineInputBorder(
                borderSide: BorderSide(color: Colors.grey[300]),
              ),
            ),
          );
        },
      ),
    );
  }

  Widget emailField(BuildContext context) {
    final profileBloc = BlocProvider.of(context).bloc.profileBloc;

    return Flexible(
      child: StreamBuilder(
        stream: profileBloc.email,
        builder: (context, snapshot) {
          return TextField(
            keyboardType: TextInputType.emailAddress,
            onChanged: profileBloc.changeEmail,
            decoration: InputDecoration(
              hintText: userInfo.userEmail,
              hintStyle: TextStyle(fontSize: 14),
              // errorText: snapshot.error,
              border: OutlineInputBorder(
                borderSide: BorderSide(color: Colors.grey[300]),
              ),
            ),
          );
        },
      ),
    );
  }

  Widget phoneField(BuildContext context) {
    final profileBloc = BlocProvider.of(context).bloc.profileBloc;

    return Flexible(
      child: StreamBuilder(
        stream: profileBloc.phone,
        builder: (context, snapshot) {
          return TextField(
            keyboardType: TextInputType.phone,
            onChanged: profileBloc.changePhone,
            decoration: InputDecoration(
              hintText: userInfo.userMobile,
              hintStyle: TextStyle(fontSize: 14),
              border: OutlineInputBorder(
                borderSide: BorderSide(color: Colors.grey[300]),
              ),
            ),
          );
        },
      ),
    );
  }

  Widget pwdField(BuildContext context) {
    final profileBloc = BlocProvider.of(context).bloc.profileBloc;

    return Flexible(
      child: StreamBuilder(
        stream: profileBloc.pwd,
        builder: (context, AsyncSnapshot<String> snapshot) {
          return TextField(
            onChanged: profileBloc.changePwd,
            obscureText: true,
            decoration: InputDecoration(
              helperText: ' ',
              hintStyle: TextStyle(fontSize: 14),
              errorText: snapshot.error,
              border: OutlineInputBorder(
                borderSide: BorderSide(color: Colors.grey[300]),
              ),
            ),
          );
        },
      ),
    );
  }

  Widget rePwdField(BuildContext context) {
    final profileBloc = BlocProvider.of(context).bloc.profileBloc;

    return Flexible(
      child: StreamBuilder(
        stream: profileBloc.rePwd,
        builder: (context, snapshot) {
          return TextField(
            onChanged: profileBloc.changeRePwd,
            obscureText: true,
            decoration: InputDecoration(
              helperText: ' ',
              hintStyle: TextStyle(fontSize: 14),
              errorText: snapshot.error,
              border: OutlineInputBorder(
                borderSide: BorderSide(color: Colors.grey[300]),
              ),
            ),
          );
        },
      ),
    );
  }

  Widget addressField(BuildContext context) {
    final profileBloc = BlocProvider.of(context).bloc.profileBloc;

    return Flexible(
      child: StreamBuilder(
        stream: profileBloc.address,
        builder: (context, snapshot) {
          return TextField(
            onChanged: profileBloc.changeAddress,
            decoration: InputDecoration(
              hintText: userInfo.userAddress,
              hintStyle: TextStyle(fontSize: 14),
              border: OutlineInputBorder(
                borderSide: BorderSide(color: Colors.grey[300]),
              ),
            ),
          );
        },
      ),
    );
  }

  Widget editButton(BuildContext context) {
    final profileBloc = BlocProvider.of(context).bloc.profileBloc;
    // return StreamBuilder(
    //   stream: profileBloc.submitValid,
    //   builder: (context, snapshot) {
    //   },
    // );
    return Container(
      alignment: Alignment.bottomRight,
      child: RaisedButton(
        child: Text('Update'),
        color: Colors.red,
        shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(8.0)),
        onPressed: () {
          profileBloc.update(context, this.userInfo);
        },
      ),
    );
  }
}
