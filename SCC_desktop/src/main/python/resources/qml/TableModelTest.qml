import QtQuick 2.12
import QtQuick.Controls 2.5
import Qt.labs.qmlmodels 1.0

TableView {
    anchors.fill: parent
    columnSpacing: 1
    rowSpacing: 1
    boundsBehavior: Flickable.StopAtBounds
    property var columnWidths: [100, 150, 80, 150, 150]
    columnWidthProvider: function (column) { return columnWidths[column] }

    model: TableModel {
        TableModelColumn { display: "fruitType" }
        TableModelColumn { display: "fruitName" }
        TableModelColumn { display: "fruitPrice" }
        TableModelColumn { display: "edit" }
        TableModelColumn { display: "delete" }

        // Each row is one type of fruit that can be ordered
        rows: [
            {
                // Each property is one cell/column.
                fruitType: "Apple",
                fruitName: "Granny Smith",
                fruitPrice: 1.50,
                edit: "Apple",
                delete: false
            },
            {
                fruitType: "Orange",
                fruitName: "Navel",
                fruitPrice: 2.50,
                edit: false,
                delete: false
            },
            {
                fruitType: "Banana",
                fruitName: "Cavendish",
                fruitPrice: 3.50,
                edit: false,
                delete: false
            }
        ]
    }
    
    
    delegate: DelegateChooser {
        DelegateChoice {
            column: 3
            delegate: ItemDelegate {
                Label {
                    text: "Edit"
                    anchors.verticalCenter: parent.verticalCenter
                    anchors.horizontalCenter: parent.horizontalCenter
                }
                Rectangle {
                    id: editbutton
                    anchors.fill: parent
                    color: "green"
                    z: -1

                }
            }
        }
        DelegateChoice {
            column: 4
            delegate: ItemDelegate {
                text: "Delete"
                onClicked: console.log("clicked:", modelData)

                Rectangle {
                    anchors.fill: parent
                    color: "red"
                    z: -1
                }
            }
        }
        DelegateChoice {
            delegate: Text {
                text: model.display
                padding: 12

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
