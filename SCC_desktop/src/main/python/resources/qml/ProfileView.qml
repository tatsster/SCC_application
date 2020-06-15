import QtQuick 2.0
import QtQuick.Controls 2.13
import QtQuick.Layouts 1.3
import QtGraphicalEffects 1.0

Rectangle{
    id: settingsView
    width: 1200
    height: 900
    color: "#f4f6f9"
    border.width: 0
    border.color: "#007bff"

    anchors.fill: parent

    Label {
        id: profileLabel
        x: 21
        y: 20
        width: 132
        height: 32
        text: "Profile"
        font.family: "Verdana"
        font.pointSize: 14
    }

    Rectangle {
        id: avatarBox
        y: 94
        width: 432
        height: 354
        color: "#ffffff"
        radius: 10
        border.color: "#007bff"
        border.width: 1
        anchors.left: parent.left
        anchors.leftMargin: 20

        Image {
            id: userAvatar
            property bool rounded: true
            property bool adapt: true
            x: 15
            width: 150
            height: 150
            anchors.top: parent.top
            anchors.topMargin: 35
            anchors.horizontalCenterOffset: 0
            anchors.horizontalCenter: parent.horizontalCenter
            source: 'ava.png'
            layer.enabled: rounded
            layer.effect: OpacityMask {
                maskSource: Item {
                    width: userAvatar.width
                    height: userAvatar.height
                    Rectangle {
                        anchors.centerIn: parent
                        width: userAvatar.adapt ? userAvatar.width : Math.min(userAvatar.width, userAvatar.height)
                        height: userAvatar.adapt ? userAvatar.height : width
                        radius: Math.min(width, height)
                    }
                }
            }
        }

        Label {
            id: userNameLabel
            x: 91
            width: 290
            height: 42
            text: "TRAN TRUNG QUAN"
            anchors.top: userAvatar.bottom
            anchors.topMargin: 20
            anchors.horizontalCenterOffset: 0
            anchors.horizontalCenter: parent.horizontalCenter
            font.pointSize: 11
            font.bold: true
            font.family: "Verdana"
            verticalAlignment: Text.AlignVCenter
            horizontalAlignment: Text.AlignHCenter
        }

        Text {
            id: userEmailLabel
            x: 93
            width: 247
            height: 36
            text: "quan.tran.itbk@hcmut.edu.vn"
            anchors.top: userNameLabel.bottom
            anchors.topMargin: 5
            anchors.horizontalCenterOffset: 1
            anchors.horizontalCenter: parent.horizontalCenter
            verticalAlignment: Text.AlignVCenter
            horizontalAlignment: Text.AlignHCenter
            font.family: "Verdana"
            font.pixelSize: 16
        }

        Text {
            id: userPhoneLabel
            x: 93
            width: 247
            height: 36
            text: "0855791231"
            anchors.top: userEmailLabel.bottom
            anchors.topMargin: 5
            horizontalAlignment: Text.AlignHCenter
            anchors.horizontalCenter: parent.horizontalCenter
            verticalAlignment: Text.AlignVCenter
            font.family: "Verdana"
            font.pixelSize: 16
            anchors.horizontalCenterOffset: 1
        }

    }

    Rectangle {
        id: userAboutBox
        x: 21
        y: 471
        width: 431
        height: 282
        color: "#ffffff"
        radius: 10

        Rectangle {
            id: aboutMeBox
            height: 50
            color: "#007bff"
            radius: 10
            anchors.left: parent.left
            anchors.leftMargin: 0
            anchors.right: parent.right
            anchors.rightMargin: 0
            anchors.top: parent.top
            anchors.topMargin: 0

            Text {
                id: aboutMeLabel
                x: 136
                y: 10
                width: 158
                height: 42
                color: "#ffffff"
                text: qsTr("About Me")
                anchors.horizontalCenter: parent.horizontalCenter
                anchors.verticalCenter: parent.verticalCenter
                font.bold: true
                font.family: "Verdana"
                verticalAlignment: Text.AlignVCenter
                horizontalAlignment: Text.AlignHCenter
                font.pixelSize: 20
            }

            Rectangle {
                id: line
                y: 152
                height: 2
                color: "#7c7c7c"
                anchors.left: parent.left
                anchors.leftMargin: 15
                anchors.right: parent.right
                anchors.rightMargin: 15
            }
        }

        Label {
            id: positionLabel
            x: 55
            y: 66
            width: 76
            height: 28
            text: qsTr("Position")
            verticalAlignment: Text.AlignVCenter
            horizontalAlignment: Text.AlignHCenter
            font.bold: true
            font.pointSize: 10
            font.family: "Verdana"
        }

        Image {
            id: positionIcon
            x: 13
            y: 71
            width: 36
            height: 23
            fillMode: Image.PreserveAspectFit
            source: "icons/position.png"
        }

        Text {
            id: userPositionLabel
            x: 55
            width: 362
            height: 36
            text: "School Manager"
            anchors.top: positionLabel.bottom
            anchors.topMargin: 5
            anchors.right: parent.right
            anchors.rightMargin: 15
            verticalAlignment: Text.AlignVCenter
            font.family: "Verdana"
            font.pixelSize: 16
        }

        Label {
            id: addressLabel
            x: 58
            y: 172
            width: 76
            height: 28
            text: qsTr("Address")
            font.bold: true
            horizontalAlignment: Text.AlignHCenter
            font.pointSize: 10
            verticalAlignment: Text.AlignVCenter
            font.family: "Verdana"
        }

        Image {
            id: positionIcon1
            x: 13
            y: 175
            width: 36
            height: 23
            sourceSize.height: 513
            fillMode: Image.PreserveAspectFit
            source: "icons/address.png"
        }

        Text {
            id: userAddressLabel
            x: 54
            width: 362
            height: 56
            text: "497 Hoa Hao St., 7 Ward, District 10, HCMC"
            wrapMode: Text.WrapAtWordBoundaryOrAnywhere
            anchors.top: addressLabel.bottom
            anchors.topMargin: 5
            anchors.right: parent.right
            anchors.rightMargin: 15
            verticalAlignment: Text.AlignVCenter
            font.family: "Verdana"
            font.pixelSize: 16
        }

    }

    Rectangle {
        id: infoEditBox
        y: 94
        height: 532
        color: "#ffffff"
        radius: 10
        border.color: "#007bff"
        anchors.left: avatarBox.right
        anchors.leftMargin: 20
        anchors.right: parent.right
        anchors.rightMargin: 20

        Rectangle {
            id: editProfileTag
            width: 170
            height: 50
            color: "#007bff"
            radius: 10
            anchors.top: parent.top
            anchors.topMargin: 20
            anchors.left: parent.left
            anchors.leftMargin: 20
            Text {
                id: editProfileLabel
                x: 136
                y: 10
                width: 158
                height: 42
                color: "#ffffff"
                text: qsTr("Edit Profile")
                horizontalAlignment: Text.AlignHCenter
                font.bold: true
                anchors.verticalCenter: parent.verticalCenter
                anchors.horizontalCenter: parent.horizontalCenter
                verticalAlignment: Text.AlignVCenter
                font.family: "Verdana"
                font.pixelSize: 20
            }
        }

        Text {
            id: nameLabel
            width: 82
            height: 28
            text: qsTr("Name")
            anchors.top: editProfileTag.bottom
            anchors.topMargin: 40
            anchors.left: parent.left
            anchors.leftMargin: 20
            verticalAlignment: Text.AlignVCenter
            horizontalAlignment: Text.AlignLeft
            font.bold: true
            font.family: "Verdana"
            font.pixelSize: 18
        }

        Text {
            id: emailLabel
            width: 82
            height: 28
            text: qsTr("Email")
            anchors.top: nameLabel.bottom
            anchors.topMargin: 40
            anchors.left: parent.left
            anchors.leftMargin: 20
            font.bold: true
            horizontalAlignment: Text.AlignLeft
            verticalAlignment: Text.AlignVCenter
            font.family: "Verdana"
            font.pixelSize: 18
        }

        Text {
            id: phoneLabel
            width: 82
            height: 28
            text: qsTr("Phone")
            anchors.top: emailLabel.bottom
            anchors.topMargin: 40
            anchors.left: parent.left
            anchors.leftMargin: 20
            font.bold: true
            horizontalAlignment: Text.AlignLeft
            verticalAlignment: Text.AlignVCenter
            font.family: "Verdana"
            font.pixelSize: 18
        }

        Text {
            id: addressEditLabel
            width: 90
            height: 28
            text: qsTr("Address")
            anchors.top: positionEditLabel.bottom
            anchors.topMargin: 40
            anchors.left: parent.left
            anchors.leftMargin: 20
            font.bold: true
            horizontalAlignment: Text.AlignLeft
            verticalAlignment: Text.AlignVCenter
            font.family: "Verdana"
            font.pixelSize: 18
        }

        Text {
            id: positionEditLabel
            width: 92
            height: 28
            text: qsTr("Position")
            anchors.top: phoneLabel.bottom
            anchors.topMargin: 40
            anchors.left: parent.left
            anchors.leftMargin: 20
            font.bold: true
            horizontalAlignment: Text.AlignLeft
            verticalAlignment: Text.AlignVCenter
            font.family: "Verdana"
            font.pixelSize: 18
        }

        TextField {
            id: textFieldName
            y: 104
            height: 40
            anchors.verticalCenter: nameLabel.verticalCenter
            anchors.left: editProfileTag.right
            anchors.leftMargin: 0
            anchors.right: parent.right
            anchors.rightMargin: 20

            text: ""
            font.pointSize: 10
            font.family: "Verdana"
            placeholderText: "TRAN TRUNG QUAN"
            selectByMouse: true
        }

        TextField {
            id: textFieldEmail
            x: 190
            y: 172
            width: 498
            height: 40

            text: ""
            anchors.verticalCenter: emailLabel.verticalCenter
            placeholderText: "quan.tran.itbk@hcmut.edu.vn"
            font.pointSize: 10
            anchors.left: editProfileTag.right
            anchors.right: parent.right
            font.family: "Verdana"
            anchors.rightMargin: 20
            anchors.leftMargin: 0
            selectByMouse: true
        }

        TextField {
            id: textFieldAddress
            x: 190
            y: 305
            height: 40

            text: ""
            anchors.verticalCenter: addressEditLabel.verticalCenter
            placeholderText: "497 Hoa Hao St., 7 Ward, District 10"
            font.pointSize: 10
            anchors.left: editProfileTag.right
            anchors.right: parent.right
            font.family: "Verdana"
            anchors.rightMargin: 20
            anchors.leftMargin: 0
            selectByMouse: true
        }

        TextField {
            id: textFieldPosition
            y: 314
            height: 40

            text: ""
            anchors.verticalCenter: positionEditLabel.verticalCenter
            placeholderText: "School Manager"
            font.pointSize: 10
            anchors.left: editProfileTag.right
            anchors.right: parent.right
            font.family: "Verdana"
            anchors.leftMargin: 0
            anchors.rightMargin: 20
            selectByMouse: true
        }

        TextField {
            id: textFieldPhone
            x: 190
            y: 240
            width: 498
            height: 40

            text: ""
            anchors.verticalCenter: phoneLabel.verticalCenter
            placeholderText: "0855791231"
            font.pointSize: 10
            anchors.left: editProfileTag.right
            anchors.right: parent.right
            font.family: "Verdana"
            anchors.rightMargin: 20
            anchors.leftMargin: 0
            selectByMouse: true
        }

        Rectangle {
            id: updateButton
            x: 553
            width: 135
            color: "#dc3545"
            radius: 10
            anchors.bottom: parent.bottom
            anchors.bottomMargin: 20
            anchors.top: textFieldAddress.bottom
            anchors.topMargin: 40
            anchors.right: parent.right
            anchors.rightMargin: 20
            Label {
                id: updateLabel
                x: 47
                y: 13
                width: 85
                height: 25
                color: "#ffffff"
                text: qsTr("Update")
                font.bold: true
                anchors.verticalCenter: parent.verticalCenter
                anchors.horizontalCenter: parent.horizontalCenter
                font.pointSize: 12
                font.family: "Verdana"
                horizontalAlignment: Text.AlignHCenter
            }

            MouseArea {
                anchors.fill: parent
                onPressed: {
                    parent.color = "#ad3545"
                }
                onReleased: {
                    parent.color = "#dc3545"
//                  con.updateProfile(textFieldName.text, textFieldEmail.text, textFieldPhone.text, textFieldPosition.text, textFieldAddress.text)
                }
            }
        }
    }

    Component.onCompleted: {
        /*
        userAvatar.source = con.getUserAva()
        userNameLabel.text = con.getUserName()
        userEmailLabel.text = con.getUserEmail()
        userPhoneLabel.text = con.getUserPhone()
        userPositionLabel.text = con.getUserPosition()
        userAddressLabel.text = con.getUserAddress()
        textFieldName.placeholderText = userNameLabel.text
        textFieldEmail.placeholderText = userEmailLabel.text
        textFieldPhone.placeholderText = userPhoneLabel.text
        textFieldPosition.placeholderText = userPositionLabel.text
        textFieldAddress.placeholderText = userAddressLabel.text
        */
    }

}

/*##^##
Designer {
    D{i:0;formeditorZoom:0.8999999761581421}D{i:3;anchors_y:34}D{i:7;anchors_y:211}D{i:8;anchors_y:264}
D{i:9;anchors_height:36;anchors_y:303}D{i:2;anchors_x:21}D{i:13;anchors_width:415;anchors_x:8}
D{i:11;anchors_width:297;anchors_x:40;anchors_y:44}D{i:16;anchors_y:100}D{i:19;anchors_y:206}
D{i:21;anchors_width:297;anchors_x:19;anchors_y:17}D{i:23;anchors_x:20;anchors_y:97}
D{i:24;anchors_x:20;anchors_y:167}D{i:25;anchors_x:20;anchors_y:230}D{i:26;anchors_x:20;anchors_y:305}
D{i:27;anchors_x:20;anchors_y:370}D{i:28;anchors_width:481;anchors_x:207}D{i:29;anchors_width:481;anchors_x:207}
D{i:30;anchors_width:498;anchors_x:0}D{i:31;anchors_width:498;anchors_x:190}D{i:32;anchors_width:481;anchors_x:207}
D{i:33;anchors_height:51;anchors_width:135;anchors_x:553;anchors_y:466}D{i:20;anchors_width:573;anchors_x:519}
}
##^##*/
