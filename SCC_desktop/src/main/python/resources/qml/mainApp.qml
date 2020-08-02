import QtQuick 2.4
import QtQuick.Controls 2.13
import QtQuick.Controls.Material 2.12

ApplicationWindow {
    id: applicationWindow
    visible: true
    width: 1600
    height: 900
    title: "SCC - Smart Classroom Controller"
    Material.theme: Material.Light
    Material.accent: Material.Amber

    Loader {
        id: appLoader
        anchors.fill: parent
        source: "LoginView.qml"
    }

}

/*##^##
Designer {
    D{i:0;formeditorZoom:0.5}D{i:1;anchors_x:0;anchors_y:0}D{i:2;anchors_x:341;anchors_y:58}
}
##^##*/
