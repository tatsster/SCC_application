import QtQuick 2.3
import QtQuick.Controls 2.13
import QtQuick.Layouts 1.3

Rectangle {
    id: buildingInfo
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

    Rectangle {
        id: buildingBlock
        color: "#ffffff"
        radius: 10
        anchors.bottom: parent.bottom
        anchors.bottomMargin: 20
        anchors.top: reportLabel.bottom
        anchors.topMargin: 25
        anchors.left: parent.left
        anchors.leftMargin: 20
        anchors.right: parent.right
        anchors.rightMargin: 20

        GridView {
            id: roomsGridView
            anchors.bottom: parent.bottom
            anchors.bottomMargin: 20
            anchors.right: parent.right
            anchors.rightMargin: 20
            anchors.top: buildingListLabel.bottom
            anchors.topMargin: 20
            anchors.left: parent.left
            anchors.leftMargin: 20

            snapMode: GridView.NoSnap
            keyNavigationWraps: false

            cellWidth:210
            cellHeight:60
            displayMarginBeginning: -20
            displayMarginEnd: -20
            ScrollBar.vertical: ScrollBar {}

            model: []

            delegate: Rectangle {
                width: 200
                height: 50
                color: "#007bff"
                radius: 10

                Text {
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
                    font.pixelSize: 16
                }

                MouseArea {
                    anchors.fill: parent
                    onPressed: {
                        parent.color = "#0262c9"
                    }
                    onReleased: {
                        con.setCurrentBuilding(modelData.name)
                        mainViewLoader.source = "BuildingInfo.qml"
                    }
                }
            }
        }

        Label {
            id: buildingListLabel
            width: 198
            height: 32
            text: "List of Buidlings"
            anchors.top: parent.top
            anchors.topMargin: 20
            anchors.left: parent.left
            anchors.leftMargin: 20
            font.family: "Verdana"
            font.pointSize: 14
        }
    }

    Component.onCompleted: {
        roomsGridView.model = con.getBuildingList()
    }
}
