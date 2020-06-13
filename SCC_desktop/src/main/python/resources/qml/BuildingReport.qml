import QtQuick 2.12
import QtQuick.Controls 2.5
import QtQuick.Layouts 1.3
import Qt.labs.qmlmodels 1.0

Rectangle{
    id: buildingReportView
    width: 1200
    height: 900
    color: "#f4f6f9"
    border.width: 0
    border.color: "#007bff"

    Label {
        id: reportBuildingLabel
        x: 21
        y: 20
        width: 260
        height: 32
        text: "Report A4 Building"
        font.family: "Verdana"
        font.pointSize: 14
    }

    Rectangle {
        id: controlBox
        height: 60
        color: "#ffffff"
        radius: 10
        anchors.top: reportBuildingLabel.bottom
        anchors.right: parent.right
        anchors.left: parent.left
        anchors.topMargin: 20
        anchors.rightMargin: 10
        anchors.leftMargin: 10
        border.color: "#007bff"
        border.width: 1

        Label {
            id: buildingNameLabel
            y: 22
            text: "A4 Building Info"
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
                    confirmDeleteAllBuildingRecord.visible = true
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

        property var columnWidths: [170, 200, 200, 230, 270, 100, 100]
        height: 50
        columnWidthProvider: function (column) { return columnWidths[column] }

        model: TableModel {
            TableModelColumn { display: "floorID" }
            TableModelColumn { display: "floorName" }
            TableModelColumn { display: "eHoursUsage" }
            TableModelColumn { display: "electricalUsage" }
            TableModelColumn { display: "updateDatetime" }
            TableModelColumn { display: "viewButton" }
            TableModelColumn { display: "deleteButton" }

            rows: [
                {
                    // Each property is one cell/column.
                    "floorID": "Floor's ID",
                    "floorName": "Floor's Name",
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
        id: buildingTableModel
        TableModelColumn { display: "floorID" }
        TableModelColumn { display: "floorName" }
        TableModelColumn { display: "eHoursUsage" }
        TableModelColumn { display: "electricalUsage" }
        TableModelColumn { display: "updateDatetime" }
        TableModelColumn { display: "viewButton" }
        TableModelColumn { display: "deleteButton" }

        // Each row is one type of fruit that can be ordered
        rows: [
            {
                // Each property is one cell/column.
                "floorID": "F0005",
                "floorName": "Floor 5",
                "eHoursUsage": "200",
                "electricalUsage": "400 kW",
                "updateDatetime": "29/05/2020 12:00:00 AM",
                "viewButton": "F0005",
                "deleteButton": "F0005"
            },
            {
                "floorID": "F0004",
                "floorName": "Floor 4",
                "eHoursUsage": "50",
                "electricalUsage": "250 kW",
                "updateDatetime": "29/05/2020 12:00:00 AM",
                "viewButton": "F0004",
                "deleteButton": "F0004"
            }
        ]
    }

    Loader{
        id: buildingTableLoader
        anchors.top: tableHeader.bottom
        anchors.topMargin: 5
        anchors.right: parent.right
        anchors.rightMargin: 10
        anchors.bottom: parent.bottom
        anchors.bottomMargin: 0
        anchors.left: parent.left
        anchors.leftMargin: 10
        source: "BuildingTable.qml"
    }

    Component.onCompleted: {
        /*
        reportBuildingLabel.text = con.getBuildingReportLabel()
        buildingNameLabel.text = con.getBuildingNameLabel()
        buildingTableModel.rows = con.getBuildingTable()
        */
    }

    MessageBox {
        id: confirmDeleteAllBuildingRecord
        text: "Are you sure want to delete all records?"
        // onAccepted: con.deleteAllBuildingRecord()
    }

    MessageBox {
        id: confirmDeleteSingleBuildingRecord
        property var item: ""

        // onAccepted: con.deleteSingleBuildingRecord(item)
    }
}

/*##^##
Designer {
    D{i:0;formeditorZoom:0.75}
}
##^##*/
