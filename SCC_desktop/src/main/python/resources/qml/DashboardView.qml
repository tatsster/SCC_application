import QtQuick 2.0
import QtQuick.Controls 2.13
import QtQuick.Layouts 1.3

Rectangle{
    id: dashboardView
    width: 1200
    height: 900
    color: "#f4f6f9"

    anchors.fill: parent

    Label {
        id: labelName
        x: 21
        y: 20
        width: 132
        height: 32
        text: "Dashboard"
        font.family: "Verdana"
        font.pointSize: 14
    }

    RowLayout {
        id: summaryBox
        height: 149
        anchors.top: labelName.bottom
        anchors.topMargin: 5
        spacing: 7
        anchors.right: parent.right
        anchors.rightMargin: 20
        anchors.left: parent.left
        anchors.leftMargin: 20

        Rectangle {
            id: hoursUsage
            width: 560
            height: 134
            radius: 7
            Layout.fillWidth: true
            color: "#28a745"

            Image {
                id: image
                x: 417
                y: 19
                width: 79
                height: 72
                anchors.verticalCenter: parent.verticalCenter
                anchors.right: parent.right
                anchors.rightMargin: 26
                fillMode: Image.PreserveAspectFit
                source: "icons/hours_usage.png"
            }

            Label {
                id: hoursUsageLabel
                y: 74
                width: 142
                height: 33
                color: "#ffffff"
                text: "Hours Usage"
                anchors.left: parent.left
                anchors.leftMargin: 20
                anchors.bottom: parent.bottom
                anchors.bottomMargin: 20
                font.family: "Verdana"
                font.pointSize: 12
            }

            Label {
                id: hoursUsageNumber
                width: 141
                height: 44
                color: "#ffffff"
                text: ""
                anchors.left: parent.left
                anchors.leftMargin: 20
                anchors.top: parent.top
                anchors.topMargin: 25
                font.pointSize: 20
                font.bold: true
                font.family: "Verdana"
            }
        }

        Rectangle {
            id: electricalUsage
            width: 536
            height: 134
            color: "#ffc107"
            radius: 7
            Layout.fillWidth: true
            Layout.alignment: Qt.AlignRight | Qt.AlignVCenter

            Image {
                id: image1
                x: 417
                y: 19
                width: 79
                height: 72
                anchors.verticalCenter: parent.verticalCenter
                anchors.right: parent.right
                fillMode: Image.PreserveAspectFit
                source: "icons/electric.png"
                anchors.rightMargin: 26
            }

            Label {
                id: electricalUsageLabel
                y: 66
                width: 162
                height: 33
                color: "#000000"
                text: "Electrical Usage"
                anchors.left: parent.left
                anchors.leftMargin: 20
                anchors.bottom: parent.bottom
                anchors.bottomMargin: 20
                font.family: "Verdana"
                font.pointSize: 12
            }

            Label {
                id: electricalUsageNumber
                width: 162
                height: 44
                color: "#000000"
                text: ""
                anchors.left: parent.left
                anchors.leftMargin: 20
                anchors.top: parent.top
                anchors.topMargin: 25
                font.bold: true
                font.family: "Verdana"
                font.pointSize: 20
            }
        }
    }

    Rectangle {
        id: realtimedataBox
        height: 348
        color: "#ffffff"
        radius: 10
        anchors.top: summaryBox.bottom
        anchors.topMargin: 20
        anchors.left: parent.left
        anchors.leftMargin: 20
        anchors.right: parent.right
        anchors.rightMargin: 20
        border.color: "#007bff"
        border.width: 1

        Label {
            id: realtimedataLabel
            width: 181
            height: 32
            text: "Real-time Data"
            anchors.top: parent.top
            anchors.topMargin: 15
            anchors.left: parent.left
            anchors.leftMargin: 10
            font.pointSize: 14
            font.family: "Verdana"
        }

        Rectangle {
            id: line
            height: 2
            color: "#7c7c7c"
            anchors.top: realtimedataLabel.bottom
            anchors.topMargin: 10
            anchors.left: parent.left
            anchors.leftMargin: 10
            anchors.right: parent.right
            anchors.rightMargin: 10
        }

        Label {
            id: lastupdateLabel
            x: 729
            width: 145
            height: 27
            text: "Last Updated:"
            anchors.right: lastupdateTime.left
            anchors.rightMargin: 5
            anchors.top: parent.top
            anchors.topMargin: 15
            font.pointSize: 12
            font.family: "Verdana"
        }

        Label {
            id: lastupdateTime
            x: 873
            width: 270
            height: 27
            text: ""
            anchors.top: parent.top
            anchors.topMargin: 15
            anchors.right: parent.right
            anchors.rightMargin: 10
            font.pointSize: 12
            font.family: "Verdana"
        }

        RowLayout {
            id: realtimeBox1
            height: 221
            anchors.top: line.bottom
            anchors.topMargin: 30
            anchors.right: parent.right
            anchors.rightMargin: 20
            anchors.left: parent.left
            anchors.leftMargin: 20
            spacing: 7

            Rectangle {
                id: tempDataBox
                width: 560
                height: 134
                radius: 7
                Layout.fillHeight: true
                Layout.fillWidth: true
                color: "#dc3545"

                Image {
                    id: tempImage
                    x: 417
                    y: 19
                    width: 79
                    height: 72
                    anchors.verticalCenter: parent.verticalCenter
                    anchors.right: parent.right
                    anchors.rightMargin: 26
                    fillMode: Image.PreserveAspectFit
                    source: "icons/temp.png"
                }

                Label {
                    id: tempLabel
                    y: 85
                    width: 147
                    height: 30
                    color: "#ffffff"
                    text: "Temperature"
                    font.bold: true
                    anchors.bottom: parent.bottom
                    anchors.bottomMargin: 20
                    anchors.left: parent.left
                    anchors.leftMargin: 20
                    font.family: "Verdana"
                    font.pointSize: 12
                }

                Label {
                    id: tempDataNumber
                    width: 120
                    height: 55
                    color: "#ffffff"
                    text: ""
                    anchors.top: parent.top
                    anchors.topMargin: 30
                    anchors.left: parent.left
                    anchors.leftMargin: 20
                    font.pointSize: 25
                    font.bold: true
                    font.family: "Verdana"
                }
            }

            Rectangle {
                id: humidDataBox
                width: 536
                height: 134
                color: "#17a2b8"
                radius: 7
                Layout.fillHeight: true
                Layout.fillWidth: true
                Layout.alignment: Qt.AlignRight | Qt.AlignVCenter

                Image {
                    id: humidImage
                    x: 417
                    y: 19
                    width: 79
                    height: 72
                    anchors.verticalCenter: parent.verticalCenter
                    anchors.right: parent.right
                    fillMode: Image.PreserveAspectFit
                    source: "icons/humid.png"
                    anchors.rightMargin: 26
                }

                Label {
                    id: humidLabel
                    y: 66
                    width: 108
                    height: 33
                    color: "#ffffff"
                    text: "Humidity"
                    anchors.left: parent.left
                    anchors.leftMargin: 20
                    anchors.bottom: parent.bottom
                    anchors.bottomMargin: 20
                    font.bold: true
                    font.family: "Verdana"
                    font.pointSize: 12
                }

                Label {
                    id:humidDataNumber
                    width: 116
                    height: 57
                    color: "#ffffff"
                    text: ""
                    anchors.top: parent.top
                    anchors.topMargin: 30
                    anchors.left: parent.left
                    anchors.leftMargin: 20
                    font.bold: true
                    font.family: "Verdana"
                    font.pointSize: 25
                }
            }
        }
    }

    Component.onCompleted: {
        con.getDashboardInfo()
        hoursUsageNumber.text = con.getHoursUsage()
        electricalUsageNumber.text = con.getElectricalUsage()
        lastupdateTime.text = con.getLastUpdateTime()
        tempDataNumber.text = con.getRealTimeTemp()
        humidDataNumber.text = con.getRealTimeHumid()
    }
}



/*##^##
Designer {
    D{i:0;formeditorZoom:0.5}D{i:5;anchors_x:21}D{i:6;anchors_x:21;anchors_y:15}D{i:9;anchors_x:21}
D{i:10;anchors_x:21;anchors_y:15}D{i:2;anchors_width:1160;anchors_x:21;anchors_y:58}
D{i:24;anchors_height:150}
}
##^##*/
