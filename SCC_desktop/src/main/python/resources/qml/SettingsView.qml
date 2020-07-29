import QtQuick 2.0
import QtQuick.Controls 2.13
import QtQuick.Layouts 1.3
import QtQuick.Dialogs 1.1

Rectangle{
    id: testView
    width: 1200
    height: 900
    color: "#f4f6f9"

    anchors.fill: parent

    Label {
        id: settingLabel
        x: 21
        y: 20
        width: 132
        height: 32
        text: "Settings"
        font.family: "Verdana"
        font.pointSize: 14
    }

    Rectangle {
        id: rectangle
        y: 94
        height: 286
        color: "#ffffff"
        radius: 10
        border.color: "#007bff"
        anchors.right: parent.right
        anchors.rightMargin: 20
        anchors.left: parent.left
        anchors.leftMargin: 20
        visible: false

        Label {
            id: backupLogLabel
            width: 323
            height: 30
            text: "Backup Log System"
            anchors.left: parent.left
            anchors.leftMargin: 25
            anchors.top: parent.top
            anchors.topMargin: 40
            font.pointSize: 13
            font.family: "Verdana"
        }

        Rectangle {
            id: statusBackupLogButton
            y: 212
            width: 130
            height: 51
            radius: 10
            anchors.verticalCenter: backupLogLabel.verticalCenter
            anchors.left: backupLogLabel.right
            anchors.leftMargin: 25
            color: "#28a745"

            Label {
                id: statusBackupLogLabel
                x: 47
                y: 13
                width: 48
                height: 25
                color: "#ffffff"
                text: "ON"
                horizontalAlignment: Text.AlignHCenter
                anchors.verticalCenter: parent.verticalCenter
                anchors.horizontalCenter: parent.horizontalCenter
                font.bold: true
                font.pointSize: 12
                font.family: "Verdana"
            }

            MouseArea {
                anchors.fill: parent
                onPressed: {
                    if (parent.color == "#28a745") {
                        parent.color = "#288545"
                    }
                    else {
                        parent.color = "#ad3545"
                    }
                }
                onReleased: {
                    if (parent.color == "#288545") {
                        parent.color = "#dc3545"
                        statusBackupLogLabel.text = "OFF"
                    }
                    else {
                        parent.color = "#28a745"
                        statusBackupLogLabel.text = "ON"
                    }
                    //con.updateBLS()
                }
            }
        }

        Rectangle {
            id: updateButton
            x: 957
            y: 282
            width: 135
            height: 51
            color: "#dc3545"
            radius: 10
            anchors.bottom: parent.bottom
            anchors.bottomMargin: 20
            anchors.right: parent.right
            anchors.rightMargin: 20
            Label {
                id: updateLabel
                x: 47
                y: 13
                width: 85
                height: 25
                color: "#ffffff"
                text: "Update"
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
                }
            }
        }

        Label {
            id: maintenanceLabel
            width: 323
            height: 30
            text: "Maintenance System"
            font.pointSize: 13
            font.family: "Verdana"
            anchors.top: backupLogLabel.bottom
            anchors.left: parent.left
            anchors.topMargin: 70
            anchors.leftMargin: 25
        }

        Rectangle {
            id: statusMaintenanceButton
            y: 212
            width: 130
            height: 51
            color: "#28a745"
            radius: 10
            anchors.verticalCenter: maintenanceLabel.verticalCenter
            anchors.left: maintenanceLabel.right
            anchors.leftMargin: 25

            Label {
                id: statusMaintenanceLabel
                x: 47
                y: 13
                width: 48
                height: 25
                color: "#ffffff"
                text: "ON"
                font.pointSize: 12
                font.family: "Verdana"
                font.bold: true
                anchors.verticalCenter: parent.verticalCenter
                anchors.horizontalCenter: parent.horizontalCenter
                horizontalAlignment: Text.AlignHCenter
            }

            MouseArea {
                anchors.fill: parent
                onPressed: {
                    if (parent.color == "#28a745") {
                        parent.color = "#288545"
                    }
                    else {
                        parent.color = "#ad3545"
                    }
                }
                onReleased: {
                    if (parent.color == "#288545") {
                        parent.color = "#dc3545"
                        statusMaintenanceLabel.text = "OFF"
                    }
                    else {
                        parent.color = "#28a745"
                        statusMaintenanceLabel.text = "ON"
                    }
                }
            }
        }
    }

    Rectangle {
        id: logoutButton
        x: 1021
        y: 798
        width: 135
        height: 51
        color: "#dc3545"
        radius: 10
        anchors.bottom: parent.bottom
        anchors.bottomMargin: 40
        anchors.right: parent.right
        anchors.rightMargin: 40
        Label {
            id: logoutLabel
            x: 47
            y: 8
            width: 85
            height: 29
            color: "#ffffff"
            text: "Logout"
            anchors.verticalCenter: parent.verticalCenter
            anchors.horizontalCenter: parent.horizontalCenter
            font.bold: true
            horizontalAlignment: Text.AlignHCenter
            font.pointSize: 12
            font.family: "Verdana"
        }

        MouseArea {
            anchors.fill: parent
            onPressed: {
                parent.color = "#ad3545"
            }
            onReleased: {
                appLoader.source = "LoginView.qml"
            }
        }
    }
}

/*##^##
Designer {
    D{i:0;formeditorZoom:0.75}D{i:3;anchors_x:25;anchors_y:221}D{i:5;anchors_x:47;anchors_y:13}
D{i:4;anchors_x:370}D{i:8;anchors_x:47;anchors_y:13}D{i:7;anchors_x:47;anchors_y:13}
D{i:10;anchors_x:25;anchors_y:221}D{i:12;anchors_x:47;anchors_y:13}D{i:11;anchors_x:370}
D{i:2;anchors_width:1139;anchors_x:21;anchors_y:94}
}
##^##*/
