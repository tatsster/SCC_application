// CenteredDialog.qml
import QtQml 2.2

import QtQuick 2.9
import QtQuick.Controls 2.2

Dialog {
    parent: ApplicationWindow.overlay

    width: 450
    height: 200
    x: (parent.width - width) / 2
    y: (parent.height - height) / 2

    title: "Confirm"
    focus: true
    modal: true

    property alias text: messageText.text

    Label {
        id: messageText
        text: "Are you sure want to delete?"
        font.pointSize: 11
        font.family: "Verdana"
        verticalAlignment: Text.AlignVCenter
        horizontalAlignment: Text.AlignHCenter
        anchors.fill: parent
    }

    standardButtons: Dialog.Yes | Dialog.Cancel
}
