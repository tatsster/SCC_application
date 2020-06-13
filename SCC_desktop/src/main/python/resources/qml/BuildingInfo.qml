import QtQuick 2.3
import QtQuick.Controls 2.13
import QtQuick.Layouts 1.3

Rectangle{
    id: settingsView
    width: 1200
    height: 900
    color: "#f4f6f9"
    border.width: 0
    border.color: "#007bff"

    Label {
        id: reportLabel
        x: 21
        y: 20
        width: 132
        height: 32
        text: "Report"
        font.family: "Verdana"
        font.pointSize: 14
    }

    ListView {
        id: buildingListView
        anchors.top: reportLabel.bottom
        anchors.right: parent.right
        anchors.bottom: parent.bottom
        anchors.left: parent.left
        anchors.topMargin: 20
        clip: true
        spacing: 20

        ScrollBar.vertical: ScrollBar {}

        model: [{"name": "A4 Building"}]

        delegate:
            Rectangle {
            id: buildingBlock
            height: 900
            color: "#ffffff"
            radius: 10
            anchors.top: parent.top
            anchors.topMargin: 0
            anchors.left: parent.left
            anchors.leftMargin: 20
            anchors.right: parent.right
            anchors.rightMargin: 20


            Rectangle {
                id: buildingNameTag
                width: 170
                height: 50
                color: "#007bff"
                radius: 10
                anchors.top: parent.top
                anchors.topMargin: 30
                anchors.left: parent.left
                anchors.leftMargin: 30
                Text {
                    id: buildingName
                    x: 136
                    y: 10
                    width: 127
                    height: 42
                    color: "#ffffff"
                    text: modelData.name
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
                        parent.color = "#007bff"
                        mainViewLoader.source = "BuildingReport.qml"
                    }
                }
            }

            ListView {
                id: floorsListView
                anchors.top: buildingNameTag.bottom
                anchors.topMargin: 30
                anchors.bottom: parent.bottom
                anchors.bottomMargin: 30
                anchors.left: parent.left
                anchors.leftMargin: 30
                anchors.right: parent.right
                anchors.rightMargin: 30

                displayMarginBeginning: -20
                displayMarginEnd: -20

                spacing: 30
                ScrollBar.vertical: ScrollBar {}

                model: [{"name": "Floor 5"}, {"name": "Floor 4"}, {"name": "Floor 3"}, {"name": "Floor 2"}, {"name": "Floor 1"},]
//              model: con.getFloorList()

                delegate: Rectangle {
                    height: 130
                    color: "#f1f1f1"
                    radius: 10
                    anchors.right: parent.right
                    anchors.rightMargin: 0
                    anchors.left: parent.left
                    anchors.leftMargin: 0

                    Label {
                        id: floorsLabel
                        width: 89
                        height: 31
                        text: modelData.name
                        font.pointSize: 12
                        font.family: "Verdana"
                        color: "#007bff"
                        anchors.top: parent.top
                        anchors.topMargin: 15
                        anchors.left: parent.left
                        anchors.leftMargin: 15
                    }

                    MouseArea {
                        anchors.fill: parent
                        onPressed: {
                            parent.color = "#d6d6d6"
                        }
                        onReleased: {
                            parent.color = "#f1f1f1"
                            // con.setCurrentFloor(modelData.id)
                            mainViewLoader.source = "FloorReport.qml"
                        }
                    }

                    GridView {
                        id: roomsGridView
                        anchors.right: parent.right
                        anchors.rightMargin: 10
                        anchors.left: parent.left
                        anchors.leftMargin: 10
                        anchors.bottom: parent.bottom
                        anchors.bottomMargin: 10
                        anchors.top: floorsLabel.bottom
                        anchors.topMargin: 10

                        snapMode: GridView.NoSnap
                        keyNavigationWraps: false

                        cellWidth:150
                        cellHeight:60
                        displayMarginBeginning: -20
                        displayMarginEnd: -20
                        ScrollBar.vertical: ScrollBar {}

                        model: 6
//                      model: con.getRoomList(floorsLabel.text)
                        delegate: Rectangle {
                            width: 140
                            height: 50
                            color: "#28a745"
                            radius: 10

                            Text {
                                width: 127
                                height: 42
                                color: "#ffffff"
                                text: "Room 505"
                                horizontalAlignment: Text.AlignHCenter
                                font.bold: true
                                anchors.verticalCenter: parent.verticalCenter
                                anchors.horizontalCenter: parent.horizontalCenter
                                verticalAlignment: Text.AlignVCenter
                                font.family: "Verdana"
                                font.pixelSize: 16
                            }

                            MouseArea {
                                anchors.fill: parent
                                onPressed: {
                                    parent.color = "#288545"
                                }
                                onReleased: {
                                    parent.color = "#28a745"
                                    // con.setCurrentRoom(modelData.id)
                                    mainViewLoader.source = "RoomReport.qml"
                                }
                            }
                        }
                    }
                }

            }
        }
    }

}

/*##^##
Designer {
    D{i:0;formeditorZoom:0.75}D{i:3;anchors_height:820;anchors_width:1125;anchors_x:21;anchors_y:80}
}
##^##*/
