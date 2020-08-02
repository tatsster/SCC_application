import QtQuick 2.12
import QtQuick.Controls 2.5
import QtQuick.Layouts 1.3
import Qt.labs.qmlmodels 1.0

Rectangle{
    id: floorReportView
    width: 1200
    height: 900
    color: "#f4f6f9"
    border.width: 0
    border.color: "#007bff"

    Label {
        id: reportFloorLabel
        x: 21
        y: 20
        width: 270
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
        anchors.left: reportFloorLabel.right
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
                mainViewLoader.source = "BuildingReport.qml"
            }
        }
    }

    Rectangle {
        id: controlBox
        height: 60
        color: "#ffffff"
        radius: 10
        anchors.top: reportFloorLabel.bottom
        anchors.right: parent.right
        anchors.left: parent.left
        anchors.topMargin: 20
        anchors.rightMargin: 10
        anchors.leftMargin: 10
        border.color: "#007bff"
        border.width: 1

        Label {
            id: floorNameLabel
            y: 22
            width: 700
            height: 22
            text: ""
            anchors.left: parent.left
            anchors.leftMargin: 10
            anchors.verticalCenterOffset: 0
            font.pointSize: 11
            font.family: "Verdana"
            anchors.verticalCenter: parent.verticalCenter
        }

        Rectangle {
            x: 852
            id: turnOffFloorButton
            width: 180
            color: "#dc3545"
            radius: 10
            anchors.right: parent.right
            anchors.rightMargin: 10
            anchors.topMargin: 8
            anchors.bottom: parent.bottom
            anchors.bottomMargin: 8
            anchors.top: parent.top
            Label {
                id: turnOffFloorLabel
                x: 47
                y: 13
                width: 137
                height: 18
                color: "#ffffff"
                text: "Turn Off Floor"
                anchors.horizontalCenter: parent.horizontalCenter
                anchors.verticalCenter: parent.verticalCenter
                wrapMode: Text.WrapAtWordBoundaryOrAnywhere
                font.bold: true
                font.pointSize: 8
                font.family: "Verdana"
                horizontalAlignment: Text.AlignHCenter
            }

            MouseArea {
                anchors.fill: parent
                onPressed: {
                    parent.color = "#ad3545"
                }
                onReleased: {
                    confirmTurnOffFloor.visible = true
                }
            }
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

        property var columnWidths: [170, 170, 120, 170, 170, 320, 150]
        height: 65
        columnWidthProvider: function (column) { return columnWidths[column] }

        model: TableModel {
            TableModelColumn { display: "roomName" }
            TableModelColumn { display: "currentTemp" }
            TableModelColumn { display: "currentHumid" }
            TableModelColumn { display: "eHoursUsage" }
            TableModelColumn { display: "electricalUsage" }
            TableModelColumn { display: "updateDatetime" }
            TableModelColumn { display: "viewButton" }

            rows: [
                {
                    "roomName": "Room's Name",
                    "currentTemp": "Current Temperature",
                    "currentHumid": "Current Humidity",
                    "eHoursUsage": "Total Hours Usage (hrs)",
                    "electricalUsage": "Total Electrical Usage (kWh)",
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
                    wrapMode: Text.Wrap
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
        id: floorTableModel
        TableModelColumn { display: "roomName" }
        TableModelColumn { display: "currentTemp" }
        TableModelColumn { display: "currentHumid" }
        TableModelColumn { display: "eHoursUsage" }
        TableModelColumn { display: "electricalUsage" }
        TableModelColumn { display: "updateDatetime" }
        TableModelColumn { display: "viewButton" }

        rows: []

    }

    Loader{
        id: floorTableLoader
        anchors.top: tableHeader.bottom
        anchors.topMargin: 5
        anchors.right: parent.right
        anchors.rightMargin: 10
        anchors.bottom: parent.bottom
        anchors.bottomMargin: 0
        anchors.left: parent.left
        anchors.leftMargin: 10
        source: "FloorTable.qml"
    }

    MessageBox {
        id: confirmTurnOffFloor
        text: "Are you sure want to turn off this floor?"
        onAccepted: {
            con.turnOffFloor()
            turnOffFloorButton.color = "#dc3545"
        }
        onRejected: {
            turnOffFloorButton.color = "#dc3545"
        }
    }

    Component.onCompleted: {
        reportFloorLabel.text = con.getCurrentFloorReportLabel()
        floorNameLabel.text = con.getCurrentFloorReportName()
        floorTableModel.rows = con.getFloorTable()
    }
}

/*##^##
Designer {
    D{i:0;formeditorZoom:0.75}D{i:3;anchors_height:47;anchors_width:437;anchors_y:58}
D{i:4;anchors_x:8}D{i:5;anchors_height:38;anchors_width:214;anchors_x:384;anchors_y:11}
D{i:11;anchors_width:182}
}
##^##*/
