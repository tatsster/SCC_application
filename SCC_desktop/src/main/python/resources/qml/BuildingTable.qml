import QtQuick 2.12
import QtQuick.Controls 2.5
import QtQuick.Layouts 1.3
import Qt.labs.qmlmodels 1.0

TableView {
    id: buildingView
    columnSpacing: 1
    rowSpacing: 5
    boundsBehavior: Flickable.StopAtBounds

    property var columnWidths: [170, 200, 200, 230, 270, 100, 100]
    columnWidthProvider: function (column) { return columnWidths[column] }

    model: buildingTableModel

    delegate: DelegateChooser {
        DelegateChoice {
            column: 5

            delegate: Rectangle {
                color: "#007bff"
                radius: 10

                Label {
                    width: 48
                    height: 20
                    color: "#ffffff"
                    text: "View"
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
                        parent.color = "#005bbd"
                    }
                    onReleased: {
                        parent.color = "#007bff"
                        // con.setCurrentFloor(model.display)
                        mainViewLoader.source = "FloorReport.qml"
                    }
                }
            }
        }
        DelegateChoice {
            column: 6

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
                        confirmDeleteSingleBuildingRecord.visible = true
                        confirmDeleteSingleBuildingRecord.item = model.display
                    }
                }
            }
        }
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
