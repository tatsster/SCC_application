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
        width: 260
        height: 32
        text: "Report Floor F0005"
        font.family: "Verdana"
        font.pointSize: 14
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
            text: qsTr("Rooms in Floor 5")
            anchors.left: parent.left
            anchors.leftMargin: 10
            anchors.verticalCenterOffset: 0
            font.pointSize: 11
            font.family: "Verdana"
            anchors.verticalCenter: parent.verticalCenter
        }

        Rectangle {
            id: deleteAllButton
            width: 151
            color: "#dc3545"
            radius: 10
            anchors.right: parent.right
            anchors.rightMargin: 10
            anchors.topMargin: 8
            anchors.bottom: parent.bottom
            anchors.bottomMargin: 8
            anchors.top: parent.top
            Label {
                id: deleteAllLabel
                x: 47
                y: 13
                width: 137
                height: 16
                color: "#ffffff"
                text: qsTr("Delete all records")
                wrapMode: Text.WrapAtWordBoundaryOrAnywhere
                anchors.horizontalCenter: parent.horizontalCenter
                anchors.verticalCenter: parent.verticalCenter
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
                    parent.color = "#dc3545"
                    confirmDeleteAllFloorRecord.visible = true
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

        property var columnWidths: [100, 130, 150, 100, 150, 170, 270, 100, 100]
        height: 65
        columnWidthProvider: function (column) { return columnWidths[column] }

        model: TableModel {
            TableModelColumn { display: "roomID" }
            TableModelColumn { display: "roomName" }
            TableModelColumn { display: "currentTemp" }
            TableModelColumn { display: "currentHumid" }
            TableModelColumn { display: "eHoursUsage" }
            TableModelColumn { display: "electricalUsage" }
            TableModelColumn { display: "updateDatetime" }
            TableModelColumn { display: "viewButton" }
            TableModelColumn { display: "deleteButton" }

            rows: [
                {
                    // Each property is one cell/column.
                    "roomID": "Room's ID",
                    "roomName": "Room's Name",
                    "currentTemp": "Current Temperature",
                    "currentHumid": "Current Humidity",
                    "eHoursUsage": "Total Hours Usage",
                    "electricalUsage": "Total Electrical Usage",
                    "updateDatetime": "Update Time",
                    "viewButton": "",
                    "deleteButton": ""
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
        TableModelColumn { display: "roomID" }
        TableModelColumn { display: "roomName" }
        TableModelColumn { display: "currentTemp" }
        TableModelColumn { display: "currentHumid" }
        TableModelColumn { display: "eHoursUsage" }
        TableModelColumn { display: "electricalUsage" }
        TableModelColumn { display: "updateDatetime" }
        TableModelColumn { display: "viewButton" }
        TableModelColumn { display: "deleteButton" }

        // Each row is one type of fruit that can be ordered
        rows: [
            {
                // Each property is one cell/column.
                "roomID": "R500",
                "roomName": "Room 505",
                "currentTemp": "30 °C",
                "currentHumid": "50 %",
                "eHoursUsage": "200",
                "electricalUsage": "400 kW",
                "updateDatetime": "29/05/2020 12:00:00 AM",
                "viewButton": "",
                "deleteButton": ""
            },
            {
                "roomID": "R504",
                "roomName": "Room 504",
                "currentTemp": "32 °C",
                "currentHumid": "50 %",
                "eHoursUsage": "150",
                "electricalUsage": "350 kW",
                "updateDatetime": "29/05/2020 11:00:00 PM",
                "viewButton": "",
                "deleteButton": ""
            }
        ]

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

    Component.onCompleted: {
        /*
        reportFloorLabel.text = con.getFloorReportLabel()
        floorNameLabel.text = con.getFloorNameLabel()
        floorTableModel.rows = con.getFloorTable()
        */
    }

    MessageBox {
        id: confirmDeleteAllFloorRecord
        text: "Are you sure want to delete all records?"
        // onAccepted: con.deleteAllFloorgRecord()
    }

    MessageBox {
        id: confirmDeleteSingleFloorRecord
        property var item: ""

        // onAccepted: con.deleteSingleFloorRecord(item)
    }
}

/*##^##
Designer {
    D{i:0;formeditorZoom:0.75}D{i:3;anchors_height:47;anchors_width:437;anchors_y:58}
D{i:5;anchors_height:38;anchors_width:214;anchors_x:384;anchors_y:11}D{i:4;anchors_x:8}
D{i:11;anchors_width:182}
}
##^##*/
