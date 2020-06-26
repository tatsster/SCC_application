import QtQuick 2.0

Rectangle {
    id: rectangle
    width: 1600
    height: 900
    anchors.fill: parent

    Sidebar {
        id: sidebar
        anchors.right: parent.right
        anchors.rightMargin: 1300
        anchors.bottom: parent.bottom
        anchors.bottomMargin: 0
        anchors.top: parent.top
        anchors.topMargin: 0
        anchors.left: parent.left
        anchors.leftMargin: 0
    }

    Rectangle{
        id: mainView
        width: 1200
        height: 900
        anchors.left: sidebar.right
        anchors.right: parent.right
        anchors.bottom: parent.bottom
        anchors.top: parent.top
        anchors.leftMargin: 0

        Loader {
            id: mainViewLoader
            anchors.fill: parent
            source: "DashboardView.qml"
        }
    }
}

/*##^##
Designer {
    D{i:0;formeditorZoom:0.5}D{i:1;anchors_width:300}
}
##^##*/
