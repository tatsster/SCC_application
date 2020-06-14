import QtQuick 2.12
import QtQuick.Controls 2.5
import QtQuick.Layouts 1.3
import Qt.labs.qmlmodels 1.0

TableView {
    id: deviceView
    columnSpacing: 1
    rowSpacing: 5
    boundsBehavior: Flickable.StopAtBounds

    property var columnWidths: [170, 200, 100, 170, 180, 300, 150]
    columnWidthProvider: function (column) { return columnWidths[column] }

    model: deviceTableModel

    delegate: DelegateChooser {
        DelegateChoice {
            column: 2

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
                        confirmDeleteSingleDeviceRecord.visible = true
                        confirmDeleteSingleDeviceRecord.item_timestamp = model.display
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
