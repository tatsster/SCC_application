import QtQuick 2.12
import QtQuick.Controls 2.5
import QtQuick.Layouts 1.3
import Qt.labs.qmlmodels 1.0

TableView {
    id: roomView
    columnSpacing: 1
    rowSpacing: 5
    boundsBehavior: Flickable.StopAtBounds

    property var columnWidths: [50, 170, 200, 100, 150, 150, 250, 100, 100]
    columnWidthProvider: function (column) { return columnWidths[column] }

    model: roomTableModel

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
