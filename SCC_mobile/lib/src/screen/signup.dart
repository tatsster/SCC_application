import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import '../widgets/bezierShape.dart';
import '../blocs/BlocProvider.dart';

class SignUpPage extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Stack(
        children: <Widget>[
          // ! Decorate
          Positioned(
            top: -MediaQuery.of(context).size.height * .15,
            right: -MediaQuery.of(context).size.width * .4,
            child: BezierContainer(),
          ),

          // ! Main
          Container(
            padding: EdgeInsets.symmetric(horizontal: 20),
            child: SingleChildScrollView(
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.center,
                mainAxisAlignment: MainAxisAlignment.center,
                mainAxisSize: MainAxisSize.min,
                children: [
                  // ! Title of app
                  Padding(
                    padding: const EdgeInsets.only(top: 100),
                    child: title(context),
                  ),

                  // ! Signup form
                  Padding(
                    padding: const EdgeInsets.only(top: 50),
                    child: signupForm(context),
                  ),

                  // ! Submit button
                  Padding(
                    padding: const EdgeInsets.only(top: 20),
                    child: submitButton(context),
                  ),

                  // ! Login account
                  Flexible(
                    fit: FlexFit.loose,
                    child: Container(
                      alignment: Alignment.bottomCenter,
                      child: loginAccountLabel(context),
                    ),
                  ),
                ],
              ),
            ),
          ),
        ],
      ),
    );
  }

  Widget entryField(String title, Stream<String> fieldStream,
      Function(String) getField, bool isPassword) {
    return Container(
      margin: EdgeInsets.symmetric(vertical: 10),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: <Widget>[
          Text(
            title,
            style: TextStyle(
              fontWeight: FontWeight.bold,
              fontSize: 15,
            ),
          ),
          SizedBox(height: 10),
          StreamBuilder(
            stream: fieldStream,
            builder: (context, snapshot) {
              return TextField(
                onChanged: getField,
                obscureText: isPassword,
                decoration: InputDecoration(
                  border: InputBorder.none,
                  fillColor: Color(0xfff3f3f4),
                  filled: true,
                  errorText: isPassword ? snapshot.error : null,
                ),
              );
            },
          ),
        ],
      ),
    );
  }

  Widget signupForm(BuildContext context) {
    final signupBloc = BlocProvider.of(context).bloc.signupBloc;

    return Column(
      children: [
        entryField("Full Name", signupBloc.name, signupBloc.getName, false),
        entryField("Email", signupBloc.email, signupBloc.getEmail, false),
        entryField("Mobile", signupBloc.mobile, signupBloc.getMobile, false),
        entryField("Address", signupBloc.address, signupBloc.getAddress, false),
        entryField("About", signupBloc.about, signupBloc.getAbout, false),
        entryField(
            "Password", signupBloc.password, signupBloc.getPassword, true),
        entryField("Password Confirm", signupBloc.passconfirm,
            signupBloc.getPassConfirm, true),
      ],
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

  Widget loginAccountLabel(BuildContext context) {
    return Container(
      padding: EdgeInsets.all(15),
      alignment: Alignment.bottomCenter,
      child: Row(
        mainAxisAlignment: MainAxisAlignment.center,
        children: <Widget>[
          Text(
            'Already have an account ?',
            style: TextStyle(fontSize: 15, fontWeight: FontWeight.w600),
          ),
          Padding(padding: EdgeInsets.only(right: 10)),
          InkWell(
            onTap: () {
              Navigator.pop(context);
            },
            child: Text(
              'Login',
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

  Widget submitButton(BuildContext context) {
    return StreamBuilder(
      stream: null,
      builder: (context, snapshot) {
        return InkWell(
          onTap: () {},
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
              'Sign Up',
              style: TextStyle(fontSize: 20, color: Colors.white),
            ),
          ),
        );
      },
    );
  }
}
