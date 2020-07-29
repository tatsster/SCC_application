import QtQuick 2.12
import QtQuick.Controls 2.5
import QtQuick.Layouts 1.3
import Qt.labs.qmlmodels 1.0

Rectangle{
    id: sensorReportView
    width: 1200
    height: 900
    color: "#f4f6f9"
    border.width: 0
    border.color: "#007bff"

    Label {
        id: reportSensorLabel
        x: 21
        y: 20
        width: 344
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
        anchors.left: reportSensorLabel.right
        anchors.leftMargin: 0
        anchors.top: parent.top
        anchors.topMargin: 15
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
                mainViewLoader.source = "RoomReport.qml"
            }
        }
    }

    Rectangle {
        id: controlBox
        height: 60
        color: "#ffffff"
        radius: 10
        anchors.top: reportSensorLabel.bottom
        anchors.right: parent.right
        anchors.left: parent.left
        anchors.topMargin: 20
        anchors.rightMargin: 10
        anchors.leftMargin: 10
        border.color: "#007bff"
        border.width: 1

        Label {
            id: sensorNameLabel
            y: 22
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
        id: tableHeader
        columnSpacing: 1
        boundsBehavior: Flickable.StopAtBounds
        anchors.top: controlBox.bottom
        anchors.topMargin: 10
        anchors.right: parent.right
        anchors.rightMargin: 10
        anchors.left: parent.left
        anchors.leftMargin: 10

        property var columnWidths: [210, 250, 240, 250, 320]
        height: 50
        columnWidthProvider: function (column) { return columnWidths[column] }

        model: TableModel {
            TableModelColumn { display: "sensorName" }
            TableModelColumn { display: "sensorTemp" }
            TableModelColumn { display: "sensorHumid" }
            TableModelColumn { display: "sensorHeatIndex" }
            TableModelColumn { display: "updateDatetime" }

            rows: [
                {
                    "sensorName": "Sensor's Name",
                    "sensorTemp": "Sensor's Temperature",
                    "sensorHumid": "Sensor's Humidity",
                    "sensorHeatIndex": "Heat Index",
                    "updateDatetime": "Update Time"
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
        id: sensorTableModel
        TableModelColumn { display: "sensorName" }
        TableModelColumn { display: "sensorTemp" }
        TableModelColumn { display: "sensorHumid" }
        TableModelColumn { display: "sensorHeatIndex" }
        TableModelColumn { display: "updateDatetime" }

        rows: []
    }

    Loader{
        id: sensorTableLoader
        anchors.top: tableHeader.bottom
        anchors.topMargin: 20
        anchors.right: parent.right
        anchors.rightMargin: 10
        anchors.bottom: parent.bottom
        anchors.bottomMargin: 0
        anchors.left: parent.left
        anchors.leftMargin: 10
        source: "SensorTable.qml"
    }

    Component.onCompleted: {
        reportSensorLabel.text = con.getSensorReportLabel()
        sensorNameLabel.text = con.getSensorNameLabel()
        sensorTableModel.rows = con.getSensorTable()
    }
}

/*##^##
Designer {
    D{i:0;formeditorZoom:0.75}D{i:3;anchors_height:47;anchors_width:437;anchors_y:58}
D{i:4;anchors_x:8}D{i:5;anchors_height:38;anchors_width:214;anchors_x:384;anchors_y:11}
D{i:11;anchors_width:182}
}
##^##*/
