import QtQuick 2.0
import QtQuick.Controls 2.13

Rectangle {
    id: loginView
    color: "#343a40"
    width: 1600
    height: 900
    anchors.fill: parent

    Rectangle {
        id: loginBox
        x: 684
        y: 437
        width: 564
        height: 340
        color: "#f5f5f7"
        anchors.horizontalCenterOffset: 0
        anchors.horizontalCenter: parent.horizontalCenter

        TextField {
            id: usernameInput
            y: 52
            height: 54
            anchors.left: userIcon.right
            anchors.leftMargin: 30
            anchors.right: parent.right
            anchors.rightMargin: 30
            font.pointSize: 9
            font.family: "Verdana"
            placeholderText: "Enter your username"
            selectByMouse: true

            background: Rectangle {
                color: "#d8d8da"
                implicitWidth: 200
                implicitHeight: 40
                border.color: usernameInput.enabled ? "#1488db" : "transparent"
            }
        }

        TextField {
            id: passwordInput
            y: 143
            height: 54
            anchors.left: passwordIcon.right
            anchors.leftMargin: 30
            anchors.right: parent.right
            anchors.rightMargin: 30
            font.family: "Verdana"
            font.pointSize: 9
            placeholderText: qsTr("Password")
            selectByMouse: true
            echoMode: TextInput.Password

            background: Rectangle {
                color: "#d8d8da"
                implicitHeight: 40
                border.color: passwordInput.enabled ? "#1488db" : "transparent"
                implicitWidth: 200
            }
        }

        Rectangle {
            id: loginButton
            color: "#1488db"
            anchors.top: passwordInput.bottom
            anchors.topMargin: 52
            anchors.right: parent.right
            anchors.rightMargin: 0
            anchors.left: parent.left
            anchors.leftMargin: 0
            anchors.bottom: parent.bottom
            anchors.bottomMargin: 0

            Label {
                id: label
                x: 267
                y: 37
                color: "#ffffff"
                text: qsTr("LOGIN")
                font.pointSize: 13
                font.family: "Verdana"
                font.bold: true
                anchors.verticalCenter: parent.verticalCenter
                anchors.horizontalCenter: parent.horizontalCenter
            }

            MouseArea {
                anchors.fill: parent
                onPressed: {
                    parent.color = "#1068a6"
                }
                onReleased: {
                    parent.color = "#1488db"
                    if (con.checkValidLogin(usernameInput.text, passwordInput.text)) {
                        appLoader.source = "AppView.qml"
                    } else {
                        loginFailedLabel.text = "Login failed. Please try again!"
                    }
                }
            }
        }

        Image {
            id: userIcon
            y: 52
            width: 45
            height: 40
            anchors.verticalCenterOffset: 0
            anchors.verticalCenter: usernameInput.verticalCenter
            anchors.left: parent.left
            anchors.leftMargin: 30
            source: "icons/user.png"
            fillMode: Image.PreserveAspectFit
        }

        Image {
            id: passwordIcon
            y: 149
            width: 45
            height: 42
            anchors.verticalCenter: passwordInput.verticalCenter
            anchors.left: parent.left
            anchors.leftMargin: 30
            source: "icons/password.png"
            fillMode: Image.PreserveAspectFit
        }

        Label {
            id: loginFailedLabel
            x: 145
            y: 211
            color: "#f61515"
            text: ""
            anchors.horizontalCenter: parent.horizontalCenter
            font.pointSize: 11
            font.family: "Verdana"
        }

    }

    Label {
        id: sccLabel
        x: 446
        y: 321
        color: "#ffffff"
        text: "SCC - Smart Classroom Controller"
        anchors.bottom: loginBox.top
        anchors.bottomMargin: 55
        anchors.horizontalCenterOffset: 0
        anchors.horizontalCenter: parent.horizontalCenter
        wrapMode: Text.NoWrap
        font.bold: true
        font.pointSize: 25
        font.family: "Verdana"
    }

    Image {
        id: image
        x: 694
        y: 53
        width: 233
        height: 213
        anchors.bottom: sccLabel.top
        anchors.bottomMargin: 55
        anchors.horizontalCenter: parent.horizontalCenter
        source: "icons/logoBK.png"
        fillMode: Image.PreserveAspectFit
    }
}



/*##^##
Designer {
    D{i:2;anchors_width:408;anchors_x:102;anchors_y:52}D{i:4;anchors_width:408;anchors_x:102}
D{i:8;anchors_x:22}D{i:6;anchors_height:90;anchors_width:200;anchors_x:63;anchors_y:250}
D{i:9;anchors_x:29}D{i:1;anchors_height:340;anchors_width:564;anchors_x:684;anchors_y:427}
}
##^##*/
