import QtQuick 2.12
import QtQuick.Controls 2.5
import QtQuick.Layouts 1.3
import Qt.labs.qmlmodels 1.0

TableView {
    id: deviceView
    columnSpacing: 1
    rowSpacing: 5
    boundsBehavior: Flickable.StopAtBounds

    property var columnWidths: [190, 100, 230, 220, 230, 300]
    columnWidthProvider: function (column) { return columnWidths[column] }

    model: deviceTableModel

    delegate: DelegateChooser {
        DelegateChoice {
            column: 1

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
