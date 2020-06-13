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
        height: 362
        color: "#ffffff"
        radius: 10
        border.color: "#007bff"
        anchors.right: parent.right
        anchors.rightMargin: 20
        anchors.left: parent.left
        anchors.leftMargin: 20

        Label {
            id: tempLabel
            x: 25
            y: 38
            width: 323
            height: 42
            text: qsTr("Temperature Threshold (°C)")
            font.family: "Verdana"
            font.pointSize: 13
        }

        Label {
            id: humidLabel
            x: 25
            width: 323
            height: 42
            text: qsTr("Humidity Threshold (%)")
            anchors.top: tempLabel.bottom
            anchors.topMargin: 52
            font.pointSize: 13
            font.family: "Verdana"
        }

        TextField {
            id: textFieldTemp
            y: 33
            height: 40

            text: ""
            anchors.left: tempLabel.right
            anchors.leftMargin: 22
            anchors.right: parent.right
            anchors.rightMargin: 20
            font.pointSize: 12
            font.family: "Verdana"
            placeholderText: qsTr("37")
            selectByMouse: true
        }

        TextField {
            id: textFieldHumid
            y: 127
            height: 40

            text: ""
            anchors.left: humidLabel.right
            anchors.leftMargin: 22
            anchors.right: parent.right
            anchors.rightMargin: 20
            placeholderText: qsTr("50")
            font.pointSize: 12
            font.family: "Verdana"
            selectByMouse: true
        }

        Label {
            id: backupLogLabel
            x: 25
            width: 323
            height: 42
            text: qsTr("Backup Log System")
            anchors.top: humidLabel.bottom
            anchors.topMargin: 52
            font.pointSize: 13
            font.family: "Verdana"
        }

        Rectangle {
            id: statusButton
            y: 212
            width: 106
            height: 51
            radius: 10
            anchors.left: textFieldHumid.left
            anchors.leftMargin: 0
            color: "#28a745"

            Label {
                id: statusLabel
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
                        statusLabel.text = "OFF"
                    }
                    else {
                        parent.color = "#28a745"
                        statusLabel.text = "ON"
                    }
//                  con.updateBLS()
                    message.visible = true
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
//                  con.updateThreshold(textFieldTemp.text, textFieldHumid.text)
                }
            }
        }
    }
    /*
    Component.onCompleted: {
        statusLabel.text = con.getStatusBLS()
        textFieldTemp.placeholderText = con.getTempThreshold()
        textFieldHumid.placeholderText = con.getHumidThreshold()

        if (statusLabel === "ON"){
            statusButton.color = "#28a745"
        } else {
            statusButton.color = "#dc3545"
        }
    }
    */

}

/*##^##
Designer {
    D{i:0;formeditorZoom:1.5}D{i:4;anchors_y:132}D{i:5;anchors_width:770;anchors_x:370}
D{i:6;anchors_width:770;anchors_x:370}D{i:7;anchors_y:221}D{i:9;anchors_x:47;anchors_y:13}
D{i:8;anchors_x:370}D{i:12;anchors_x:47;anchors_y:13}D{i:11;anchors_x:47;anchors_y:13}
D{i:2;anchors_width:1139;anchors_x:21;anchors_y:94}
}
##^##*/
