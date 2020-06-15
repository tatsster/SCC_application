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
    property var selected_devices: []

    Label {
        id: reportRoomLabel
        x: 21
        y: 20
        width: 260
        height: 32
        text: "Report Room 505"
        font.family: "Verdana"
        font.pointSize: 14
    }

    Rectangle {
        id: controlBox
        height: 60
        color: "#ffffff"
        radius: 10
        anchors.top: reportRoomLabel.bottom
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
            text: qsTr("Control Device")
            anchors.left: parent.left
            anchors.leftMargin: 10
            anchors.verticalCenterOffset: 0
            font.pointSize: 11
            font.family: "Verdana"
            anchors.verticalCenter: parent.verticalCenter
        }

        Rectangle {
            id: turnoffButton
            x: 384
            width: 214
            color: "#ffc107"
            radius: 10
            anchors.right: turnonButton.left
            anchors.rightMargin: 5
            anchors.topMargin: 8
            anchors.bottom: parent.bottom
            anchors.bottomMargin: 8
            anchors.top: parent.top
            Label {
                id: turnoffLabel
                x: 47
                y: 13
                width: 199
                height: 16
                color: "#000000"
                text: qsTr("Turn off selected devices")
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
                    parent.color = "#cc9900"
                }
                onReleased: {
                    parent.color = "#ffc107"
                    getSelectedDevices()
                    // con.turnOffSelectedDevices(selected_devices)
                    // roomTableModel.rows = con.getRoomTable()
                    roomTableLoader.source = ""
                    roomTableLoader.source = "RoomTable.qml"
                }
            }
        }

        Rectangle {
            id: turnonButton
            x: 484
            width: 214
            color: "#007bff"
            radius: 10
            anchors.right: deleteAllButton.left
            anchors.rightMargin: 5
            anchors.topMargin: 8
            anchors.bottom: parent.bottom
            anchors.bottomMargin: 8
            anchors.top: parent.top
            Label {
                id: turnonLabel
                x: 47
                y: 13
                width: 199
                height: 16
                color: "#ffffff"
                text: qsTr("Turn on selected devices")
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
                    parent.color = "#005bbd"
                }
                onReleased: {
                    parent.color = "#007bff"
                    getSelectedDevices()
                    // con.turnOnSelectedDevices(selected_devices)
                    // roomTableModel.rows = con.getRoomTable()
                    roomTableLoader.source = ""
                    roomTableLoader.source = "RoomTable.qml"
                }
            }
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
                    confirmDeleteAllRoomRecord.visible = true
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

        property var columnWidths: [50, 170, 200, 100, 150, 150, 250, 100, 100]
        height: 50
        columnWidthProvider: function (column) { return columnWidths[column] }

        model: TableModel {
            TableModelColumn { display: "checked" }
            TableModelColumn { display: "deviceID" }
            TableModelColumn { display: "deviceName" }
            TableModelColumn { display: "status" }
            TableModelColumn { display: "eHoursUsage" }
            TableModelColumn { display: "electricalUsage" }
            TableModelColumn { display: "updateDatetime" }
            TableModelColumn { display: "viewButton" }
            TableModelColumn { display: "deleteButton" }

            rows: [
                {
                    // Each property is one cell/column.
                    "checked": false,
                    "deviceID": "Device's ID",
                    "deviceName": "Device's Name",
                    "status": "Status",
                    "eHoursUsage": "Hours Usage",
                    "electricalUsage": "Electrical Usage",
                    "updateDatetime": "Update Time",
                    "viewButton": "",
                    "deleteButton": ""
                }
            ]
        }

        delegate: DelegateChooser {
            DelegateChoice {
                column: 0
                delegate: CheckBox {
                    checked: model.display
                    onToggled: {
                        model.display = checked
                        for (var r = 0; r < roomTableModel.rowCount; ++r) {
                            var tempRow = roomTableModel.rows[r]
                            if (checked) {
                                tempRow.checked = true
                            } else {
                                tempRow.checked = false
                            }
                            roomTableModel.setRow(r, tempRow)
                        }
                        roomTableLoader.source = ""
                        roomTableLoader.source = "RoomTable.qml"
                    }

                }
            }

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
        id: roomTableModel
        TableModelColumn { display: "checked" }
        TableModelColumn { display: "deviceID" }
        TableModelColumn { display: "deviceName" }
        TableModelColumn { display: "status" }
        TableModelColumn { display: "eHoursUsage" }
        TableModelColumn { display: "electricalUsage" }
        TableModelColumn { display: "updateDatetime" }
        TableModelColumn { display: "viewButton" }
        TableModelColumn { display: "deleteButton" }

        // Each row is one type of fruit that can be ordered
        rows: [
            {
                // Each property is one cell/column.
                "checked": false,
                "deviceID": "LIGHT200",
                "deviceName": "Light 1",
                "status": "ON",
                "eHoursUsage": "200",
                "electricalUsage": "400 kW",
                "updateDatetime": "29/05/2020 12:00:00 AM",
                "viewButton": "LIGHT200",
                "deleteButton": "LIGHT200"
            },
            {
                "checked": false,
                "deviceID": "LIGHT201",
                "deviceName": "Light 2",
                "status": "OFF",
                "eHoursUsage": "50",
                "electricalUsage": "250 kW",
                "updateDatetime": "29/05/2020 12:00:00 AM",
                "viewButton": "LIGHT201",
                "deleteButton": "LIGHT201"
            }
        ]
    }

    Loader{
        id: roomTableLoader
        anchors.top: tableHeader.bottom
        anchors.topMargin: 5
        anchors.right: parent.right
        anchors.rightMargin: 10
        anchors.bottom: parent.bottom
        anchors.bottomMargin: 0
        anchors.left: parent.left
        anchors.leftMargin: 10
        source: "RoomTable.qml"
    }

    Component.onCompleted: {
        /*
        reportRoomgLabel.text = con.getRoomReportLabel()
        roomTableModel.rows = con.getRoomTable()
        */
    }

    MessageBox {
        id: confirmDeleteAllRoomRecord
        text: "Are you sure want to delete all records?"
        onAccepted: {
            // con.deleteAllRoomRecord()
            roomTableModel.clear()
        }
    }

    MessageBox {
        id: confirmDeleteSingleRoomRecord
        property var item: ""
        onAccepted: {
            // con.deleteSingleRoomRecord(item)
            roomTableModel.removeRow(getDeviceIndex(item))
        }
    }

    function getSelectedDevices() {
        selected_devices = []
        for (var r = 0; r < roomTableModel.rowCount; ++r) {
            if (roomTableModel.rows[r].checked === true) {
                selected_devices.push(roomTableModel.rows[r].deviceID)
            }
        }
    }

    function getDeviceIndex(device_id) {
        for (var r = 0; r < roomTableModel.rowCount; ++r) {
            if (roomTableModel.rows[r].deviceID === device_id) {
                return r;
            }
        }
    }
}

/*##^##
Designer {
    D{i:0;formeditorZoom:0.75}D{i:3;anchors_height:47;anchors_width:437;anchors_y:58}
D{i:5;anchors_height:38;anchors_width:214;anchors_x:384;anchors_y:11}D{i:4;anchors_x:8}
D{i:8;anchors_width:214;anchors_x:484}
}
##^##*/
