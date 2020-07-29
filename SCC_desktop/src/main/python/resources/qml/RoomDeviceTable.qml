import QtQuick 2.12
import QtQuick.Controls 2.5
import QtQuick.Layouts 1.3
import Qt.labs.qmlmodels 1.0

TableView {
    id: roomView
    columnSpacing: 1
    rowSpacing: 5
    boundsBehavior: Flickable.StopAtBounds
    
    property var columnWidths: [200, 120, 250, 250, 300, 150]
    columnWidthProvider: function (column) { return columnWidths[column] }
    
    model: roomDeviceTableModel
    
    delegate: DelegateChooser {
        DelegateChoice {
            column: 1
            
            delegate: Rectangle {
                color: (model.display === "ON") ? "#28a745" : "#dc3545"
                radius: 10
                
                Label {
                    id: statusLabel
                    width: 48
                    height: 20
                    color: "#ffffff"
                    text: model.display
                    horizontalAlignment: Text.AlignHCenter
                    anchors.verticalCenter: parent.verticalCenter
                    anchors.horizontalCenter: parent.horizontalCenter
                    font.bold: true
                    font.pointSize: 10
                    font.family: "Verdana"
                }
                
                MouseArea {
                    anchors.fill: parent
                    onPressed: {
                        if (turnOffRoomButton.activateRoomStatus === "ON") {
                            if (parent.color == "#28a745") {
                                parent.color = "#288545"
                            }
                            else {
                                parent.color = "#ad3545"
                            }
                        }
                    }
                    onReleased: {
                        if (turnOffRoomButton.activateRoomStatus === "ON") {
                            confirmOnOffDevice.device_name = roomDeviceTableModel.rows[index - 2].deviceName
                            confirmOnOffDevice.current_status = roomDeviceTableModel.rows[index - 2].status
                            confirmOnOffDevice.visible = true
                        }
                    }
                }
            }
        }
        DelegateChoice {
            column: 5
            
            delegate: Rectangle {
                color: "#007bff"
                radius: 10
                
                Label {
                    width: 48
                    height: 20
                    color: "#ffffff"
                    text: "View"
                    horizontalAlignment: Text.AlignHCenter
                    anchors.verticalCenter: parent.verticalCenter
                    anchors.horizontalCenter: parent.horizontalCenter
                    font.bold: true
                    font.pointSize: 9
                    font.family: "Verdana"
                }
                
                MouseArea {
                    anchors.fill: parent
                    onPressed: {
                        parent.color = "#005bbd"
                    }
                    onReleased: {
                        con.setCurrentDevice(model.display)
                        mainViewLoader.source = "DeviceReport.qml"
                    }
                }
            }
        }
        DelegateChoice {
            delegate: Text {
                text: model.display
                font.family: "Verdana"
                font.pointSize: 9
                padding: 15
                Rectangle {
                    anchors.fill: parent
                    color: "#efefef"
                    z: -1
                }
            }
        }
    }
    
    
    ScrollBar.vertical: ScrollBar {
        active: true
    }

    MessageBox {
        id: confirmOnOffDevice
        property  var device_name: ""
        property  var current_status: ""
        text: "Are you sure want to turn this device ".concat((current_status === "ON") ? "OFF?" : "ON?")
        onAccepted: {
            con.setCurrentDevice(device_name)
            con.toggleDevice(device_name, current_status)
            mainViewLoader.source = ""
            mainViewLoader.source = "RoomReport.qml"
        }
        onRejected: {
            mainViewLoader.source = ""
            mainViewLoader.source = "RoomReport.qml"
        }
    }
}
