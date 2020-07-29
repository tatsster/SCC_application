import QtQuick 2.12
import QtQuick.Controls 2.5
import QtQuick.Layouts 1.3
import Qt.labs.qmlmodels 1.0

Rectangle{
    id: roomReportView
    width: 1200
    height: 900
    color: "#f4f6f9"
    border.width: 0
    border.color: "#007bff"

    Label {
        id: reportRoomLabel
        x: 21
        y: 20
        width: 260
        height: 32
        text: ""
        wrapMode: Text.WrapAtWordBoundaryOrAnywhere
        font.family: "Verdana"
        font.pointSize: 14
    }

    Rectangle {
        width: 151
        height: 45
        color: "#007bff"
        radius: 10
        anchors.left: reportRoomLabel.right
        anchors.leftMargin: 0
        anchors.top: parent.top
        anchors.topMargin: 10
        Text {
            x: 136
            y: 10
            width: 127
            height: 42
            color: "#ffffff"
            text: "Back"
            horizontalAlignment: Text.AlignHCenter
            font.bold: true
            anchors.verticalCenter: parent.verticalCenter
            anchors.horizontalCenter: parent.horizontalCenter
            verticalAlignment: Text.AlignVCenter
            font.family: "Verdana"
            font.pixelSize: 20
        }

        MouseArea {
            anchors.fill: parent
            onPressed: {
                parent.color = "#0262c9"
            }
            onReleased: {
                mainViewLoader.source = "FloorReport.qml"
            }
        }
    }

    Rectangle {
        property var activateRoomStatus: "ON"
        x: 998
        id: turnOffRoomButton
        width: 180
        color: "#dc3545"
        radius: 10
        anchors.right: parent.right
        anchors.rightMargin: 10
        anchors.bottom: roomRealtimeBox.top
        anchors.bottomMargin: 10
        anchors.top: parent.top
        anchors.topMargin: 10
        Label {
            id: turnOffRoomLabel
            x: 47
            y: 13
            width: 137
            height: 18
            color: "#ffffff"
            text: "Turn Off Room"
            anchors.horizontalCenter: parent.horizontalCenter
            anchors.verticalCenter: parent.verticalCenter
            wrapMode: Text.WrapAtWordBoundaryOrAnywhere
            font.bold: true
            font.pointSize: 8
            font.family: "Verdana"
            horizontalAlignment: Text.AlignHCenter
        }

        MouseArea {
            width: 150
            anchors.fill: parent
            onPressed: {
                parent.color = "#ad3545"
            }
            onReleased: {
                confirmTurnOffRoom.visible = true
            }
        }
    }

    RowLayout {
        id: roomRealtimeBox
        height: 150
        anchors.top: reportRoomLabel.bottom
        anchors.topMargin: 10
        anchors.right: parent.right
        anchors.rightMargin: 10
        anchors.left: parent.left
        anchors.leftMargin: 10
        spacing: 7

        Rectangle {
            id: tempDataBox
            width: 560
            height: 134
            radius: 7
            Layout.fillHeight: true
            Layout.fillWidth: true
            color: "#dc3545"

            Image {
                id: tempImage
                x: 417
                y: 19
                width: 79
                height: 72
                anchors.verticalCenter: parent.verticalCenter
                anchors.right: parent.right
                anchors.rightMargin: 26
                fillMode: Image.PreserveAspectFit
                source: "icons/temp.png"
            }

            Label {
                id: tempLabel
                y: 85
                width: 147
                height: 30
                color: "#ffffff"
                text: "Temperature"
                font.bold: true
                anchors.bottom: parent.bottom
                anchors.bottomMargin: 20
                anchors.left: parent.left
                anchors.leftMargin: 20
                font.family: "Verdana"
                font.pointSize: 12
            }

            Label {
                id: tempDataNumber
                width: 95
                height: 44
                color: "#ffffff"
                text: ""
                anchors.top: parent.top
                anchors.topMargin: 30
                anchors.left: parent.left
                anchors.leftMargin: 20
                font.pointSize: 20
                font.bold: true
                font.family: "Verdana"
            }
        }

        Rectangle {
            id: humidDataBox
            width: 536
            height: 134
            color: "#17a2b8"
            radius: 7
            Layout.fillHeight: true
            Layout.fillWidth: true
            Layout.alignment: Qt.AlignRight | Qt.AlignVCenter

            Image {
                id: humidImage
                x: 417
                y: 19
                width: 79
                height: 72
                anchors.verticalCenter: parent.verticalCenter
                anchors.right: parent.right
                fillMode: Image.PreserveAspectFit
                source: "icons/humid.png"
                anchors.rightMargin: 26
            }

            Label {
                id: humidLabel
                y: 66
                width: 108
                height: 33
                color: "#ffffff"
                text: "Humidity"
                anchors.left: parent.left
                anchors.leftMargin: 20
                anchors.bottom: parent.bottom
                anchors.bottomMargin: 20
                font.bold: true
                font.family: "Verdana"
                font.pointSize: 12
            }

            Label {
                id:humidDataNumber
                width: 101
                height: 44
                color: "#ffffff"
                text: ""
                anchors.top: parent.top
                anchors.topMargin: 30
                anchors.left: parent.left
                anchors.leftMargin: 20
                font.bold: true
                font.family: "Verdana"
                font.pointSize: 20
            }
        }
    }

    Rectangle {
        id: deviceControlBox
        height: 45
        color: "#ffffff"
        radius: 10
        anchors.top: roomRealtimeBox.bottom
        anchors.right: parent.right
        anchors.left: parent.left
        anchors.topMargin: 20
        anchors.rightMargin: 10
        anchors.leftMargin: 10
        border.color: "#007bff"
        border.width: 1

        Label {
            id: controlDeviceLabel
            y: 22
            width: 700
            text: ""
            anchors.left: parent.left
            anchors.leftMargin: 10
            anchors.verticalCenterOffset: 0
            font.pointSize: 11
            font.family: "Verdana"
            anchors.verticalCenter: parent.verticalCenter
        }
    }


    TableView {
        id: deviceTableHeader
        columnSpacing: 1
        boundsBehavior: Flickable.StopAtBounds
        anchors.top: deviceControlBox.bottom
        anchors.topMargin: 10
        anchors.right: parent.right
        anchors.rightMargin: 10
        anchors.left: parent.left
        anchors.leftMargin: 10

        property var columnWidths: [200, 120, 250, 250, 300, 150]
        height: 50
        columnWidthProvider: function (column) { return columnWidths[column] }

        model: TableModel {
            TableModelColumn { display: "deviceName" }
            TableModelColumn { display: "status" }
            TableModelColumn { display: "eHoursUsage" }
            TableModelColumn { display: "electricalUsage" }
            TableModelColumn { display: "updateDatetime" }
            TableModelColumn { display: "viewButton" }

            rows: [
                {
                    "deviceName": "Name",
                    "status": "Status",
                    "eHoursUsage": "Hours Usage",
                    "electricalUsage": "Electrical Usage",
                    "updateDatetime": "Update Time",
                    "viewButton": ""
                }
            ]
        }

        delegate: DelegateChooser {
            DelegateChoice {
                delegate: Text {
                    text: model.display
                    font.pointSize: 9
                    font.bold: true
                    padding: 15
                    Rectangle {
                        anchors.fill: parent
                        color: "#efefef"
                        z: -1
                    }
                }
            }
        }

    }
    
    TableModel {
        id: roomDeviceTableModel
        TableModelColumn { display: "deviceName" }
        TableModelColumn { display: "status" }
        TableModelColumn { display: "eHoursUsage" }
        TableModelColumn { display: "electricalUsage" }
        TableModelColumn { display: "updateDatetime" }
        TableModelColumn { display: "viewButton" }

        rows: []
    }

    Loader{
        id: deviceTableLoader
        anchors.top: deviceTableHeader.bottom
        anchors.topMargin: 5
        anchors.right: parent.right
        anchors.rightMargin: 10
        anchors.bottom: parent.bottom
        anchors.bottomMargin: 358
        anchors.left: parent.left
        anchors.leftMargin: 10
        source: "RoomDeviceTable.qml"
    }

    TableView {
        id: sensorTableHeader
        columnSpacing: 1
        boundsBehavior: Flickable.StopAtBounds
        anchors.top: sensorControlBox.bottom
        anchors.topMargin: 10
        anchors.right: parent.right
        anchors.rightMargin: 10
        anchors.left: parent.left
        anchors.leftMargin: 10

        property var columnWidths: [200, 120, 250, 250, 300, 150]
        height: 50
        columnWidthProvider: function (column) { return columnWidths[column] }

        model: TableModel {
            TableModelColumn { display: "sensorName" }
            TableModelColumn { display: "status" }
            TableModelColumn { display: "currentTemp" }
            TableModelColumn { display: "currentHumid" }
            TableModelColumn { display: "updateDatetime" }
            TableModelColumn { display: "viewButton" }

            rows: [
                {
                    "sensorName": "Name",
                    "status": "Status",
                    "currentTemp": "Current Temperature",
                    "currentHumid": "Current Humidity",
                    "updateDatetime": "Update Time",
                    "viewButton": ""
                }
            ]
        }

        delegate: DelegateChooser {
            DelegateChoice {
                delegate: Text {
                    text: model.display
                    font.pointSize: 9
                    font.bold: true
                    padding: 15
                    Rectangle {
                        anchors.fill: parent
                        color: "#efefef"
                        z: -1
                    }
                }
            }
        }

    }

    TableModel {
        id: roomSensorTableModel
        TableModelColumn { display: "sensorName" }
        TableModelColumn { display: "status" }
        TableModelColumn { display: "currentTemp" }
        TableModelColumn { display: "currentHumid" }
        TableModelColumn { display: "updateDatetime" }
        TableModelColumn { display: "viewButton" }

        rows: []
    }

    Loader{
        id: sensorTableLoader
        anchors.top: sensorTableHeader.bottom
        anchors.topMargin: 5
        anchors.right: parent.right
        anchors.rightMargin: 10
        anchors.bottom: parent.bottom
        anchors.bottomMargin: 19
        anchors.left: parent.left
        anchors.leftMargin: 10
        source: "RoomSensorTable.qml"
    }

    MessageBox {
        id: confirmTurnOffRoom
        text: "Are you sure want to turn off this room?"
        onAccepted: {
            con.turnOffRoom()
            mainViewLoader.source = ""
            mainViewLoader.source = "RoomReport.qml"
        }
        onRejected: {
            turnOffRoomButton.color = "#dc3545"
        }
    }

    Rectangle {
        id: sensorControlBox
        y: 558
        height: 45
        color: "#ffffff"
        radius: 10
        anchors.left: parent.left
        Label {
            id: controlSensorLabel
            y: 22
            width: 700
            text: ""
            anchors.verticalCenter: parent.verticalCenter
            anchors.left: parent.left
            anchors.leftMargin: 10
            font.pointSize: 11
            anchors.verticalCenterOffset: 0
            font.family: "Verdana"
        }
        anchors.leftMargin: 10
        border.color: "#007bff"
        anchors.right: parent.right
        anchors.rightMargin: 10
        border.width: 1
    }

    Component.onCompleted: {
        reportRoomLabel.text = "Report ".concat(con.getCurrentRoomName())
        controlDeviceLabel.text = con.getCurrentRoomDeviceLabel()
        controlSensorLabel.text = con.getCurrentRoomSensorLabel()
        roomDeviceTableModel.rows = con.getRoomDeviceTable()
        roomSensorTableModel.rows = con.getRoomSensorTable()
        tempDataNumber.text = con.getCurrentRoomTemp()
        humidDataNumber.text = con.getCurrentRoomHumid()
        turnOffRoomButton.activateRoomStatus = con.getActivateRoomStatus()
    }
}

/*##^##
Designer {
    D{i:0;formeditorZoom:0.6600000262260437}D{i:3;anchors_height:47;anchors_width:437;anchors_y:58}
D{i:4;anchors_x:8}D{i:2;anchors_width:1174;anchors_x:8;anchors_y:67}D{i:5;anchors_height:51;anchors_width:214;anchors_x:384;anchors_y:9}
D{i:11;anchors_width:214;anchors_x:484}D{i:8;anchors_height:38;anchors_width:214;anchors_x:384;anchors_y:11}
}
##^##*/
