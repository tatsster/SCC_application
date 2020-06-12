import QtQuick 2.0
import QtQuick.Controls 2.13
import QtQuick.Layouts 1.3

Rectangle{
    id: settingsView
    width: 1200
    height: 900
    color: "#f4f6f9"
    border.width: 0
    border.color: "#007bff"

    Loader {
        id: reportViewLoader
        anchors.fill: parent
        source: "BuildingInfo.qml"
    }
}
