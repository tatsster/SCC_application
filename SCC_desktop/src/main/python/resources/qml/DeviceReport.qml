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
        width: 260
        height: 32
        text: "Report Device LIGHT200"
        font.family: "Verdana"
        font.pointSize: 14
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
            id: deviceReportLabel
            y: 22
            text: qsTr("LIGHT200 History Report")
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
            anchors.right: generateReportButton.left
            anchors.rightMargin: 5
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
                }
            }
        }

        Rectangle {
            id: generateReportButton
            width: 182
            color: "#28a745"
            radius: 10
            anchors.right: parent.right
            anchors.rightMargin: 10
            anchors.topMargin: 8
            anchors.bottom: parent.bottom
            anchors.bottomMargin: 8
            anchors.top: parent.top
            Label {
                id: generateReportLabel
                x: 47
                y: 13
                width: 169
                height: 16
                color: "#ffffff"
                text: qsTr("Generate excel report")
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
                    parent.color = "#288545"
                }
                onReleased: {
                    parent.color = "#28a745"
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

        property var columnWidths: [50, 170, 200, 100, 150, 150, 300, 150]
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
            TableModelColumn { display: "deleteButton" }

            rows: [
                {
                    // Each property is one cell/column.
                    checked: false,
                    deviceID: "Device's ID",
                    deviceName: "Device's Name",
                    status: "Status",
                    eHoursUsage: "Hours Usage",
                    electricalUsage: "Electrical Usage",
                    updateDatetime: "Update Time",
                    deleteButton: ""
                }
            ]
        }

        delegate: DelegateChooser {
            DelegateChoice {
                column: 0
                delegate: CheckBox {
                    checked: model.display
                    onToggled: model.display = checked
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

    TableView {
        id: deviceView
        columnSpacing: 1
        rowSpacing: 5
        boundsBehavior: Flickable.StopAtBounds
        anchors.top: tableHeader.bottom
        anchors.topMargin: 5
        anchors.right: parent.right
        anchors.rightMargin: 10
        anchors.bottom: parent.bottom
        anchors.bottomMargin: 0
        anchors.left: parent.left
        anchors.leftMargin: 10

        property var columnWidths: [50, 170, 200, 100, 150, 150, 300, 150]
        columnWidthProvider: function (column) { return columnWidths[column] }

        model: TableModel {
            TableModelColumn { display: "checked" }
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
                    checked: false,
                    deviceID: "LIGHT200",
                    deviceName: "Light 1",
                    status: "ON",
                    eHoursUsage: "200",
                    electricalUsage: "400 kW",
                    updateDatetime: "29/05/2020 12:00:00 AM",
                    deleteButton: "LIGHT200"
                },
                {
                    checked: false,
                    deviceID: "LIGHT200",
                    deviceName: "Light 1",
                    status: "OFF",
                    eHoursUsage: "50",
                    electricalUsage: "250 kW",
                    updateDatetime: "29/05/2020 11:00:00 PM",
                    deleteButton: "LIGHT200"
                }
            ]

        }


        delegate: DelegateChooser {
            DelegateChoice {
                column: 0
                delegate: CheckBox {
                    checked: model.display
                    onToggled: model.display = checked
                }
            }
            DelegateChoice {
                column: 3

                delegate: Rectangle {
                    color: (model.display === "ON") ? "#28a745" : "#dc3545"
                    radius: 10

                    Label {
                        id: statusLabel
                        width: 48
                        height: 20
                        color: "#ffffff"
                        text: model.display
                        horizontalAlignment: Text.AlignHCenter
                        anchors.verticalCenter: parent.verticalCenter
                        anchors.horizontalCenter: parent.horizontalCenter
                        font.bold: true
                        font.pointSize: 10
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
                        }
                    }
                }
            }
            DelegateChoice {
                column: 7

                delegate: Rectangle {
                    color: "#dc3545"
                    radius: 10

                    Label {
                        width: 48
                        height: 20
                        color: "#ffffff"
                        text: "Delete"
                        horizontalAlignment: Text.AlignHCenter
                        anchors.verticalCenter: parent.verticalCenter
                        anchors.horizontalCenter: parent.horizontalCenter
                        font.bold: true
                        font.pointSize: 9
                        font.family: "Verdana"
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
            }
            //            DelegateChoice {
            //                column: 4
            //                delegate: ItemDelegate {
            //                    text: "Delete"
            //                    onClicked: console.log("clicked:", modelData)

            //                    Rectangle {
            //                        anchors.fill: parent
            //                        color: "red"
            //                        z: -1
            //                    }
            //                }
            //            }
            DelegateChoice {
                delegate: Text {
                    text: model.display
                    font.family: "Verdana"
                    font.pointSize: 9
                    padding: 15
                    Rectangle {
                        anchors.fill: parent
                        color: "#efefef"
                        z: -1
                    }
                }
            }
        }


        ScrollBar.vertical: ScrollBar {
            active: true
        }
    }
}

/*##^##
Designer {
    D{i:0;formeditorZoom:0.75}D{i:4;anchors_x:8}D{i:5;anchors_height:38;anchors_width:214;anchors_x:384;anchors_y:11}
D{i:8;anchors_width:214;anchors_x:484}D{i:14;anchors_width:182}D{i:3;anchors_height:47;anchors_width:437;anchors_y:58}
}
##^##*/