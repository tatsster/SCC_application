import QtQuick 2.0
import QtQuick.Controls 2.13
import QtQuick.Layouts 1.3
import QtGraphicalEffects 1.0

Rectangle {
    id: rectangle
    width: 1200
    height: 900
    color: "#f4f6f9"

    Label {
        id: userListLabel
        x: 21
        y: 20
        width: 132
        height: 32
        text: "User List"
        font.family: "Verdana"
        font.pointSize: 14
    }

    GridView {
        anchors.right: parent.right
        anchors.rightMargin: 0
        anchors.left: parent.left
        anchors.leftMargin: 20
        anchors.bottom: parent.bottom
        anchors.bottomMargin: 0
        anchors.top: userListLabel.bottom
        anchors.topMargin: 25
        snapMode: GridView.NoSnap
        keyNavigationWraps: false
        model: [{"name": "Tran Trung Quan","email": "quan.tran.itbk@hcmut.edu.vn","phone": "0855791615"}, {"name": "Huynh Ngoc Thien","email": "quan.tran.itbk@hcmut.edu.vn","phone": "0855791615"}]
        cellWidth:420
        cellHeight:350
        delegate: Rectangle {
            id: avatarBox
            width: 410
            height: 340
            color: "#ffffff"
            radius: 10
            border.color: "#007bff"
            border.width: 1

            Image {
                id: userAvatar
                property bool rounded: true
                property bool adapt: true
                width: 150
                height: 150
                anchors.top: parent.top
                anchors.topMargin: 35
                anchors.horizontalCenterOffset: 0
                anchors.horizontalCenter: parent.horizontalCenter
                source: 'ava.png'
                layer.enabled: rounded
                layer.effect: OpacityMask {
                    maskSource: Item {
                        width: userAvatar.width
                        height: userAvatar.height
                        Rectangle {
                            anchors.centerIn: parent
                            width: userAvatar.adapt ? userAvatar.width : Math.min(userAvatar.width, userAvatar.height)
                            height: userAvatar.adapt ? userAvatar.height : width
                            radius: Math.min(width, height)
                        }
                    }
                }
            }

            Label {
                id: userNameLabel
                width: 290
                height: 42
                text: modelData.name
                anchors.top: userAvatar.bottom
                anchors.topMargin: 20
                anchors.horizontalCenterOffset: 0
                anchors.horizontalCenter: parent.horizontalCenter
                font.pointSize: 11
                font.bold: true
                font.family: "Verdana"
                verticalAlignment: Text.AlignVCenter
                horizontalAlignment: Text.AlignHCenter
            }

            Text {
                id: userEmailLabel
                width: 247
                height: 36
                text: modelData.email
                anchors.top: userNameLabel.bottom
                anchors.topMargin: 5
                anchors.horizontalCenterOffset: 1
                anchors.horizontalCenter: parent.horizontalCenter
                verticalAlignment: Text.AlignVCenter
                horizontalAlignment: Text.AlignHCenter
                font.family: "Verdana"
                font.pixelSize: 16
            }

            Text {
                id: userPhoneLabel
                width: 247
                height: 36
                text: modelData.phone
                anchors.top: userEmailLabel.bottom
                anchors.topMargin: 5
                horizontalAlignment: Text.AlignHCenter
                anchors.horizontalCenter: parent.horizontalCenter
                verticalAlignment: Text.AlignVCenter
                font.family: "Verdana"
                font.pixelSize: 16
                anchors.horizontalCenterOffset: 1
            }

        }

    }

}

/*##^##
Designer {
    D{i:0;formeditorZoom:0.6600000262260437}
}
##^##*/
