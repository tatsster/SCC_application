import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';

import '../blocs/BlocProvider.dart';

class LoginPage extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Container(
        padding: EdgeInsets.symmetric(horizontal: 20),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.center,
          mainAxisAlignment: MainAxisAlignment.center,
          children: <Widget>[
            // ! Title of app
            Padding(
              padding: const EdgeInsets.only(top: 100),
              child: title(context),
            ),

            // ! Login form
            Padding(
              padding: const EdgeInsets.only(top: 50),
              child: emailPasswordWidget(context),
            ),

            // ! Submit button
            Padding(
              padding: const EdgeInsets.only(top: 20),
              child: submitButton(context),
            ),

            // ! Forgot password
            Container(
              padding: EdgeInsets.only(top: 10),
              alignment: Alignment.centerRight,
              child: Text(
                'Forgot Password ?',
                style: TextStyle(
                  fontSize: 14,
                  fontWeight: FontWeight.w500,
                ),
              ),
            ),
            divider(),

            // ! SignUp account
            Expanded(
              child: Container(
                alignment: Alignment.bottomCenter,
                child: createAccountLabel(context),
              ),
            ),
          ],
        ),
      ),
    );
  }

  Widget entryField(BuildContext context, String title,
      {bool isPassword = false}) {
    final loginBloc = BlocProvider.of(context).loginBloc;

    return Container(
      margin: EdgeInsets.symmetric(vertical: 10),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Text(
            title,
            style: TextStyle(
              fontWeight: FontWeight.bold,
              fontSize: 15,
            ),
          ),
          SizedBox(height: 10),
          StreamBuilder(
            stream: isPassword ? loginBloc.password : loginBloc.email,
            builder: (context, snapshot) {
              return TextField(
                obscureText: isPassword,
                onChanged:
                    isPassword ? loginBloc.getPassword : loginBloc.getEmail,
                decoration: InputDecoration(
                  border: InputBorder.none,
                  fillColor: Color(0xfff3f3f4),
                  filled: true,
                ),
              );
            },
          ),
        ],
      ),
    );
  }

  Widget submitButton(BuildContext context) {
    final loginBloc = BlocProvider.of(context).loginBloc;

    return StreamBuilder(
      stream: loginBloc.submitValid,
      builder: (context, snapshot) {
        return InkWell(
          onTap: () {
            if (snapshot.hasData && loginBloc.submit()) {
              BlocProvider.updateUserId(context);
              Navigator.pushNamed(context, '/dashboard');
            }
          },
          child: Container(
            width: MediaQuery.of(context).size.width,
            padding: EdgeInsets.symmetric(vertical: 15),
            alignment: Alignment.center,
            decoration: BoxDecoration(
              borderRadius: BorderRadius.all(Radius.circular(5)),
              boxShadow: <BoxShadow>[
                BoxShadow(
                  color: Colors.grey.shade200,
                  offset: Offset(2, 4),
                  blurRadius: 5,
                  spreadRadius: 2,
                )
              ],
              gradient: LinearGradient(
                begin: Alignment.centerLeft,
                end: Alignment.centerRight,
                colors: [Color(0xfffbb448), Color(0xfff7892b)],
              ),
            ),
            child: Text(
              'Login',
              style: TextStyle(fontSize: 20, color: Colors.white),
            ),
          ),
        );
      },
    );
  }

  Widget divider() {
    return Container(
      margin: EdgeInsets.symmetric(vertical: 10),
      child: Row(
        children: <Widget>[
          SizedBox(width: 20),
          Expanded(
            child: Padding(
              padding: EdgeInsets.symmetric(horizontal: 10),
              child: Divider(thickness: 1),
            ),
          ),
          Text('or'),
          Expanded(
            child: Padding(
              padding: EdgeInsets.symmetric(horizontal: 10),
              child: Divider(thickness: 1),
            ),
          ),
          SizedBox(width: 20),
        ],
      ),
    );
  }

  Widget createAccountLabel(BuildContext context) {
    return Container(
      // margin: EdgeInsets.symmetric(vertical: 20),
      padding: EdgeInsets.all(15),
      alignment: Alignment.bottomCenter,
      child: Row(
        mainAxisAlignment: MainAxisAlignment.center,
        children: <Widget>[
          Text(
            'Don\'t have an account ?',
            style: TextStyle(fontSize: 15, fontWeight: FontWeight.w600),
          ),
          Padding(padding: EdgeInsets.only(right: 10)),
          InkWell(
            onTap: () {},
            child: Text(
              'Register',
              style: TextStyle(
                color: Color(0xfff79c4f),
                fontSize: 15,
                fontWeight: FontWeight.w600,
              ),
            ),
          ),
        ],
      ),
    );
  }

  Widget title(BuildContext context) {
    return RichText(
      textAlign: TextAlign.center,
      text: TextSpan(
        children: [
          TextSpan(
            text: 'SCC',
            style: GoogleFonts.portLligatSans(
              textStyle: Theme.of(context).textTheme.headline4,
              fontSize: 30,
              fontWeight: FontWeight.w700,
              color: Color(0xffe46b10),
            ),
          ),
          TextSpan(
            text: ' Mobile',
            style: TextStyle(color: Color(0xffe46b10), fontSize: 30),
          ),
        ],
      ),
    );
  }

  Widget emailPasswordWidget(BuildContext context) {
    return Column(
      children: <Widget>[
        entryField(context, "Email"),
        entryField(context, "Password", isPassword: true),
      ],
    );
  }
}
