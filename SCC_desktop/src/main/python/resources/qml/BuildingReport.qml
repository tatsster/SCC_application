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
        text: ""
        font.family: "Verdana"
        font.pointSize: 14
    }

    Rectangle {
        width: 151
        height: 45
        color: "#007bff"
        radius: 10
        anchors.left: reportBuildingLabel.right
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
                mainViewLoader.source = "BuildingInfo.qml"
            }
        }
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
            id: turnOffBuildingButton
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
                id: turnOffBuildingLabel
                x: 47
                y: 13
                width: 137
                height: 18
                color: "#ffffff"
                text: "Turn Off Building"
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
                    confirmTurnOffBuilding.visible = true
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

        property var columnWidths: [220, 280, 310, 310, 150]
        height: 50
        columnWidthProvider: function (column) { return columnWidths[column] }

        model: TableModel {
            TableModelColumn { display: "floorName" }
            TableModelColumn { display: "eHoursUsage" }
            TableModelColumn { display: "electricalUsage" }
            TableModelColumn { display: "updateDatetime" }
            TableModelColumn { display: "viewButton" }

            rows: [
                {
                    // Each property is one cell/column.
                    "floorName": "Floor's Name",
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
        TableModelColumn { display: "floorName" }
        TableModelColumn { display: "eHoursUsage" }
        TableModelColumn { display: "electricalUsage" }
        TableModelColumn { display: "updateDatetime" }
        TableModelColumn { display: "viewButton" }

        rows: []
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

    MessageBox {
        id: confirmTurnOffBuilding
        text: "Are you sure want to turn off this building?"
        onAccepted: {
            con.turnOffBuilding()
            turnOffBuildingButton.color = "#dc3545"
        }
        onRejected: {
            turnOffBuildingButton.color = "#dc3545"
        }
    }

    Component.onCompleted: {
        reportBuildingLabel.text = "Report ".concat(con.getCurrentBuildingName())
        buildingNameLabel.text = con.getCurrentBuildingName().concat(" Info")
        buildingTableModel.rows = con.getBuildingTable()
    }
}

/*##^##
Designer {
    D{i:0;formeditorZoom:1.25}D{i:2;anchors_x:1029;anchors_y:13}
}
##^##*/
