import QtQuick 2.0
import QtQuick.Controls 2.13

Rectangle {
    height: 50
    radius: 5
    anchors.right: parent.right
    anchors.rightMargin: 15
    anchors.left: parent.left
    anchors.leftMargin: 15
    property alias buttonIcon: buttonIcon
    property alias buttonLabel: buttonLabel
    color: "#343a40"

    Label {
        id: buttonLabel
        y: 26
        width: 132
        height: 38
        color: "#d0d4db"
        anchors.left: buttonIcon.right
        anchors.leftMargin: 20
        anchors.verticalCenter: parent.verticalCenter
        font.pointSize: 11
        font.bold: true
        font.family: "Verdana"
        verticalAlignment: Text.AlignVCenter
        horizontalAlignment: Text.AlignLeft
    }

    Image {
        id: buttonIcon
        y: 19
        width: 25
        height: 24
        anchors.left: parent.left
        anchors.leftMargin: 20
        anchors.verticalCenter: parent.verticalCenter
        fillMode: Image.PreserveAspectFit
    }
}
