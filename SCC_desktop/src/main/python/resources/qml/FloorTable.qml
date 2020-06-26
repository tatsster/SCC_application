import QtQuick 2.12
import QtQuick.Controls 2.5
import QtQuick.Layouts 1.3
import Qt.labs.qmlmodels 1.0

TableView {
    id: floorView
    columnSpacing: 1
    rowSpacing: 5
    boundsBehavior: Flickable.StopAtBounds

    property var columnWidths: [100, 130, 150, 100, 150, 170, 270, 100, 100]
    columnWidthProvider: function (column) { return columnWidths[column] }

    model: floorTableModel


    delegate: DelegateChooser {
        DelegateChoice {
            column: 7

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
                        // con.setCurrentRoom(model.display)
                        mainViewLoader.source = "RoomReport.qml"
                    }
                }
            }
        }
        DelegateChoice {
            column: 8

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
                        confirmDeleteSingleFloorRecord.visible = true
                        confirmDeleteSingleFloorRecord.item = model.display
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
