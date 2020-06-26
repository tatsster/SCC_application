import QtQuick 2.12
import QtQuick.Controls 2.5
import QtQuick.Layouts 1.3
import Qt.labs.qmlmodels 1.0

Rectangle{
    id: deviceReportView
    width: 1200
    height: 900
    color: "#f4f6f9"
    border.width: 0
    border.color: "#007bff"

    Label {
        id: reportDeviceLabel
        x: 21
        y: 20
        width: 344
        height: 32
        text: "Report Device LIGHT200"
        wrapMode: Text.WrapAtWordBoundaryOrAnywhere
        font.family: "Verdana"
        font.pointSize: 14
    }

    Rectangle {
        width: 151
        height: 45
        color: "#007bff"
        radius: 10
        anchors.left: reportDeviceLabel.right
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
                parent.color = "#007bff"
                mainViewLoader.source = "RoomReport.qml"
            }
        }
    }

    Rectangle {
        id: controlBox
        height: 60
        color: "#ffffff"
        radius: 10
        anchors.top: reportDeviceLabel.bottom
        anchors.right: parent.right
        anchors.left: parent.left
        anchors.topMargin: 20
        anchors.rightMargin: 10
        anchors.leftMargin: 10
        border.color: "#007bff"
        border.width: 1

        Label {
            id: deviceNameLabel
            y: 22
            text: "LIGHT200 History Report"
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
                    confirmDeleteAllDeviceRecord.visible = true
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

        property var columnWidths: [170, 200, 100, 170, 180, 300, 150]
        height: 50
        columnWidthProvider: function (column) { return columnWidths[column] }

        model: TableModel {
            TableModelColumn { display: "deviceID" }
            TableModelColumn { display: "deviceName" }
            TableModelColumn { display: "status" }
            TableModelColumn { display: "eHoursUsage" }
            TableModelColumn { display: "electricalUsage" }
            TableModelColumn { display: "updateDatetime" }
            TableModelColumn { display: "deleteButton" }

            rows: [
                {
                    // Each property is one cell/column.
                    "deviceID": "Device's ID",
                    "deviceName": "Device's Name",
                    "status": "Status",
                    "eHoursUsage": "Hours Usage",
                    "electricalUsage": "Electrical Usage",
                    "updateDatetime": "Update Time",
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
        id: deviceTableModel
        TableModelColumn { display: "deviceID" }
        TableModelColumn { display: "deviceName" }
        TableModelColumn { display: "status" }
        TableModelColumn { display: "eHoursUsage" }
        TableModelColumn { display: "electricalUsage" }
        TableModelColumn { display: "updateDatetime" }
        TableModelColumn { display: "deleteButton" }

        // Each row is one type of fruit that can be ordered
        rows: [
            {
                // Each property is one cell/column.
                "deviceID": "LIGHT200",
                "deviceName": "Light 1",
                "status": "ON",
                "eHoursUsage": "200",
                "electricalUsage": "400 kW",
                "updateDatetime": "29/05/2020 12:00:00 AM",
                "deleteButton": "29/05/2020 12:00:00 AM"
            },
            {
                "deviceID": "LIGHT200",
                "deviceName": "Light 1",
                "status": "OFF",
                "eHoursUsage": "50",
                "electricalUsage": "250 kW",
                "updateDatetime": "30/05/2020 11:00:00 PM",
                "deleteButton": "30/05/2020 11:00:00 PM"
            }
        ]

    }

    Loader{
        id: deviceTableLoader
        anchors.top: tableHeader.bottom
        anchors.topMargin: 5
        anchors.right: parent.right
        anchors.rightMargin: 10
        anchors.bottom: parent.bottom
        anchors.bottomMargin: 0
        anchors.left: parent.left
        anchors.leftMargin: 10
        source: "DeviceTable.qml"
    }

    Component.onCompleted: {
        /*
        reportDeviceLabel.text = con.getDeviceReportLabel()
        deviceNameLabel.text = con.getDeviceNameLabel()
        deviceTableModel.rows = con.getDeviceTable()
        */
    }

    MessageBox {
        id: confirmDeleteAllDeviceRecord
        text: "Are you sure want to delete all records?"
        onAccepted: {
            // con.deleteAllDeviceRecord()
            deviceTableModel.clear()
        }
    }

    MessageBox {
        id: confirmDeleteSingleDeviceRecord
        property var item_timestamp: ""
        onAccepted: {
            // con.deleteSingleDeviceRecord(item_timestamp)
            deviceTableModel.removeRow(getDeviceIndex(item_timestamp))
        }
    }

    function getDeviceIndex(device_timestamp) {
        for (var r = 0; r < deviceTableModel.rowCount; ++r) {
            if (deviceTableModel.rows[r].updateDatetime === device_timestamp) {
                return r;
            }
        }
    }
}

/*##^##
Designer {
    D{i:0;formeditorZoom:0.75}D{i:3;anchors_height:47;anchors_width:437;anchors_y:58}
D{i:4;anchors_x:8}D{i:8;anchors_width:214;anchors_x:484}D{i:5;anchors_height:38;anchors_width:214;anchors_x:384;anchors_y:11}
D{i:14;anchors_width:182}
}
##^##*/
