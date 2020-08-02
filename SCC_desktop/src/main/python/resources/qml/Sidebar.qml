import QtQuick 2.4
import QtQuick.Controls 2.13
import QtGraphicalEffects 1.0

Rectangle {
    width: 400
    height: 900
    color: "#343a40"
    property alias tabBarUserName: tabBarUserName

    property int currentSelectTab: 1

    function switchTab(selectedTab) {
        switch(currentSelectTab) {
        case 1:
            dashboardButton.color = "#343a40";
            break;
        case 2:
            reportButton.color = "#343a40";
            break;
        case 3:
            profileButton.color = "#343a40";
            break;
        case 4:
            userlistButton.color = "#343a40";
            break;
        case 5:
            settingsButton.color = "#343a40";
            break;
        }

        switch(selectedTab) {
        case 1:
            dashboardButton.color = "#007bff";
            break;
        case 2:
            reportButton.color = "#007bff";
            break;
        case 3:
            profileButton.color = "#007bff";
            break;
        case 4:
            userlistButton.color = "#007bff";
            break;
        case 5:
            settingsButton.color = "#007bff";
            break;
        }
    }

    Label {
        id: appName
        x: 15
        y: 14
        width: 377
        height: 50
        color: "#d0d4db"
        text: "SCC"
        font.bold: true
        wrapMode: Text.WrapAtWordBoundaryOrAnywhere
        font.family: "Verdana"
        font.pointSize: 16
    }

    Rectangle {
        id: line
        y: 62
        height: 2
        color: "#7c7c7c"
        anchors.left: parent.left
        anchors.leftMargin: 0
        anchors.right: parent.right
        anchors.rightMargin: 0
    }

    Image {
        id: userAvatar
        property bool rounded: true
        property bool adapt: true
        x: 15
        y: 81
        width: 50
        height: 50
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
        id: tabBarUserName
        y: 86
        height: 40
        color: "#d0d4db"
        text: ""
        anchors.left: userAvatar.right
        anchors.leftMargin: 25
        anchors.right: parent.right
        anchors.rightMargin: 8
        verticalAlignment: Text.AlignVCenter
        horizontalAlignment: Text.AlignLeft
        font.family: "Verdana"
        wrapMode: Text.WrapAtWordBoundaryOrAnywhere
        font.bold: true
        font.pointSize: 11

    }

    Rectangle {
        id: line1
        height: 2
        color: "#7c7c7c"
        anchors.top: tabBarUserName.bottom
        anchors.topMargin: 24
        anchors.rightMargin: 0
        anchors.leftMargin: 0
        anchors.right: parent.right
        anchors.left: parent.left
    }

    SidebarButton {
        id: dashboardButton
        buttonLabel.text: "Dashboard"
        buttonIcon.source: "icons/dashboard.png"
        anchors.top: line1.bottom
        anchors.topMargin: 20
        color: "#007bff"

        MouseArea {
            anchors.fill: parent
            onPressed: {
                parent.color = "#7c7c7c"
            }
            onReleased: {
                switchTab(1)
                currentSelectTab = 1
                mainViewLoader.source = "DashboardView.qml"
            }
        }
    }

    SidebarButton {
        id: reportButton
        anchors.top: dashboardButton.bottom
        anchors.topMargin: 10
        buttonLabel.text: "Report"
        buttonIcon.source: "icons/report.png"

        MouseArea {
            anchors.fill: parent
            onPressed: {
                parent.color = "#7c7c7c"
            }
            onReleased: {
                switchTab(2)
                currentSelectTab = 2
                mainViewLoader.source = "ReportView.qml"
            }
        }
    }

    SidebarButton {
        id: profileButton
        buttonLabel.text: "Profile"
        buttonIcon.source: "icons/profile.png"
        anchors.top: reportButton.bottom
        anchors.topMargin: 10

        MouseArea {
            anchors.fill: parent
            onPressed: {
                parent.color = "#7c7c7c"
            }
            onReleased: {
                switchTab(3)
                currentSelectTab = 3
                mainViewLoader.source = "ProfileView.qml"
            }
        }
    }

    SidebarButton {
        id: userlistButton
        buttonLabel.text: "User List"
        buttonIcon.source: "icons/userlist.png"
        anchors.top: profileButton.bottom
        anchors.topMargin: 10

        MouseArea {
            anchors.fill: parent
            onPressed: {
                parent.color = "#7c7c7c"
            }
            onReleased: {
                switchTab(4)
                currentSelectTab = 4
                mainViewLoader.source = "UserListView.qml"
            }
        }
    }

    SidebarButton {
        id: settingsButton
        buttonLabel.text: "Settings"
        buttonIcon.source: "icons/settings.png"
        anchors.top: userlistButton.bottom
        anchors.topMargin: 10

        MouseArea {
            anchors.fill: parent
            onPressed: {
                parent.color = "#7c7c7c"
            }
            onReleased: {
                switchTab(5)
                currentSelectTab = 5
                mainViewLoader.source = "SettingsView.qml"
            }
        }
    }

    Component.onCompleted: {
        userAvatar.source = con.getUserAva()
        tabBarUserName.text = con.getUserName()
    }
}

/*##^##
Designer {
    D{i:0;formeditorZoom:1.25}D{i:2;anchors_width:400;anchors_x:0}D{i:7;anchors_width:282;anchors_x:110}
D{i:8;anchors_width:400;anchors_x:0;anchors_y:150}D{i:10;anchors_x:63}D{i:9;anchors_width:370;anchors_x:15;anchors_y:175}
D{i:12;anchors_x:19}D{i:11;anchors_y:324}
}
##^##*/
