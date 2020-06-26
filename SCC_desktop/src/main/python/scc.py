import os
import sys
from os.path import dirname, join

from fbs_runtime.application_context.PyQt5 import ApplicationContext
from PyQt5.QtCore import QUrl, QObject, pyqtSlot
from PyQt5.QtQml import QQmlApplicationEngine
from PyQt5.QtWidgets import QMainWindow

import src


class User():
    def __init__(self):
        self.user_name = ""
        self.user_ava = ""
        self.user_email = ""
        self.user_phone = ""
        self.user_position = ""
        self.user_address = ""
    
    def setUserInfo(self, user_name, user_ava, user_email, user_phone, user_position, user_address):
        self.user_name = user_name
        self.user_ava = user_ava
        self.user_email = user_email
        self.user_phone = user_phone
        self.user_position = user_position
        self.user_address = user_address


class ReportData():
    def __init__(self):
        self.floor = ""
        self.room = ""
        self.device = ""

    def setCurrentFloor(self, current_floor):
        self.floor = current_floor
    
    def setCurrentRoom(self, current_room):
        self.room = current_room

    def setCurrentDevice(self, current_device):
        self.floor = current_device


class Bridge(QObject):

    current_user = User()
    current_report = ReportData()

    @pyqtSlot(str, str, result=bool)
    def checkValidLogin(self, username, password):
        # TODO: call login api
        return True


    # User Profile
    @pyqtSlot(result=str)
    def getUserAva(self):
        return self.current_user.user_ava

    @pyqtSlot(result=str)
    def getUserName(self):
        return self.current_user.user_name
    
    @pyqtSlot(result=str)
    def getUserEmail(self):
        return self.current_user.user_email

    @pyqtSlot(result=str)
    def getUserPhone(self):
        return self.current_user.user_phone

    @pyqtSlot(result=str)
    def getUserPosition(self):
        return self.current_user.user_position

    @pyqtSlot(result=str)
    def getUserAddress(self):
        return self.current_user.user_address

    @pyqtSlot(str, str, str, str, str)
    def updateProfile(self, new_user_name, new_user_email, new_user_phone, new_user_position, new_user_address):
        #TODO: call update user profile api and update current user again
        pass


    # Dashboard Info
    @pyqtSlot(result=str)
    def getHoursUsage(self):
        #TODO: call hours usage api
        pass

    @pyqtSlot(result=str)
    def getElectricalUsage(self):
        #TODO: call electrical usage api
        pass

    @pyqtSlot(result=str)
    def getLastUpdateTime(self):
        #TODO: call last update time api
        pass

    @pyqtSlot(result=str)
    def getRealTimeTemp(self):
        #TODO: call realtime temp api
        pass

    @pyqtSlot(result=str)
    def getRealTimeHumid(self):
        #TODO: call realtime humid api
        pass

    @pyqtSlot(result=str)
    def getAvgTemp(self):
        #TODO: call average temp api
        pass

    @pyqtSlot(result=str)
    def getgetAvgHumid(self):
        #TODO: call average humid api
        pass

    @pyqtSlot(result=str)
    def getTopHours(self):
        #TODO: call top hours api
        pass

    @pyqtSlot(result=str)
    def getTopElectrical(self):
        #TODO: call top electrical api
        pass


    # Report
    @pyqtSlot(result=list)
    def getFloorList(self):
        #TODO: call get floor list api
        """ Format return json:
        [
            {"id": "F005", "name": "Floor 5"}, 
            {"id": "F004", "name": "Floor 4"}, 
            {"id": "F003", "name": "Floor 3"}, 
            {"id": "F002", "name": "Floor 2"}, 
            {"id": "F001", "name": "Floor 1"}
        ]
        """
        pass

    @pyqtSlot(str, result=list)
    def getRoomList(self, floor_id):
        #TODO: call get room list of specific floor
        """ Format return json (floor 5):
        [
            {"id": "R505", "name": "Room 505"}, 
            {"id": "R504", "name": "Room 504"}, 
            {"id": "R503", "name": "Room 503"},
            {"id": "R502", "name": "Room 502"},
            {"id": "R501", "name": "Room 501"}
        ]
        """
        pass
    
    ### Building Report
    @pyqtSlot(result=list)
    def getBuildingTable(self):
        #TODO call get building table
        """ Format return json:
        [
            {
                "floorID": "F0005",
                "floorName": "Floor 5",
                "eHoursUsage": "200",
                "electricalUsage": "400 kW",
                "updateDatetime": "29/05/2020 12:00:00 AM",
                "viewButton": "F0005",
                "deleteButton": "F0005"
            },
            {
                "floorID": "F0004",
                "floorName": "Floor 4",
                "eHoursUsage": "50",
                "electricalUsage": "250 kW",
                "updateDatetime": "29/05/2020 12:00:00 AM",
                "viewButton": "F0004",
                "deleteButton": "F0004"
            }
        ]
        """
        pass
    
    @pyqtSlot()
    def deleteAllBuildingRecord(self):
        #TODO: call delete all building record api
        pass

    @pyqtSlot(str)
    def deleteSingleBuildingRecord(self, floor_id):
        #TODO: call delete single floor api
        pass

    ### Floor Report
    @pyqtSlot(result=str)
    def getFloorReportLabel(self):
        return str("Report Floor " + self.current_report.floor)

    @pyqtSlot(result=str)
    def getFloorReportName(self):
        return str("Rooms in Floor " + self.current_report.floor)
    
    @pyqtSlot(result=list)
    def getFloorTable(self):
        #TODO call get current floor table api
        """ Format return json
        [
            {
                "roomID": "R505",
                "roomName": "Room 505",
                "currentTemp": "30 °C",
                "currentHumid": "50 %",
                "eHoursUsage": "200",
                "electricalUsage": "400 kW",
                "updateDatetime": "29/05/2020 12:00:00 AM",
                "viewButton": "R505",
                "deleteButton": "R505"
            },
            {
                "roomID": "R504",
                "roomName": "Room 504",
                "currentTemp": "32 °C",
                "currentHumid": "50 %",
                "eHoursUsage": "150",
                "electricalUsage": "350 kW",
                "updateDatetime": "29/05/2020 11:00:00 PM",
                "viewButton": "R504",
                "deleteButton": "R504"
            }
        ]
        """
        pass
    
    @pyqtSlot()
    def deleteAllFloorRecord(self):
        #TODO: call delete all floor record api
        pass

    @pyqtSlot(str)
    def deleteSingleFloorRecord(self, room_id):
        #TODO: call delete single room api
        pass

    
    ### Room Report

    @pyqtSlot(result=str)
    def getRoomReportLabel(self):
        return str("Report Room " + self.current_report.room)

    @pyqtSlot(result=list)
    def getRoomTable(self):
        #TODO call get current room table api
        """ Format return json:
        [
            {
                "checked": false,
                "deviceID": "LIGHT200",
                "deviceName": "Light 1",
                "status": "ON",
                "eHoursUsage": "200",
                "electricalUsage": "400 kW",
                "updateDatetime": "29/05/2020 12:00:00 AM",
                "viewButton": "LIGHT200",
                "deleteButton": "LIGHT200"
            },
            {
                "checked": false,
                "deviceID": "LIGHT201",
                "deviceName": "Light 2",
                "status": "OFF",
                "eHoursUsage": "50",
                "electricalUsage": "250 kW",
                "updateDatetime": "29/05/2020 12:00:00 AM",
                "viewButton": "LIGHT201",
                "deleteButton": "LIGHT201"
            }
        ]
        """
        pass

    @pyqtSlot()
    def deleteAllRoomRecord(self):
        #TODO: call delete all room record api
        pass

    @pyqtSlot(str)
    def deleteSingleRoomRecord(self, room_id):
        #TODO: call delete single device api
        pass
    
    @pyqtSlot(str)
    def toggleDivices(self):
        #TODO: call turn on/off devices by device id api
        pass

    @pyqtSlot(list)
    def turnOnSelectedDevices(self, selected_devices):
        #TODO: call turn on selected devices api by list of device id 
        pass

    @pyqtSlot(list)
    def turnOffSelectedDevices(self, selected_devices):
        #TODO: call turn off selected devices api by list of device id 
        pass
    
    ### Device Report
    @pyqtSlot(result=str)
    def getDeviceReportLabel(self):
        return str("Report Device " + self.current_report.device)

    @pyqtSlot(result=str)
    def getDeviceReportName(self):
        return str(self.current_report.device + " History Report")

    @pyqtSlot(result=list)
    def getDeviceTable(self):
        #TODO: call get current device table by id 
        """ Format return json
        [
            {
                "deviceID": "LIGHT200",
                "deviceName": "Light 1",
                "status": "ON",
                "eHoursUsage": "200",
                "electricalUsage": "400 kW",
                "updateDatetime": "29/05/2020 12:00:00 AM",
                "deleteButton": "29/05/2020 12:00:00 AM"
            },
            {
                "deviceID": "LIGHT200",
                "deviceName": "Light 1",
                "status": "OFF",
                "eHoursUsage": "50",
                "electricalUsage": "250 kW",
                "updateDatetime": "30/05/2020 11:00:00 PM",
                "deleteButton": "30/05/2020 11:00:00 PM"
            }
        ]
        """
        pass

    @pyqtSlot()
    def deleteAllDeviceRecord(self):
        #TODO: call delete all device record api
        pass

    @pyqtSlot(str)
    def deleteSingleDeviceRecord(self, device_timestamp):
        #TODO: call delete single device record api
        pass

    ### Set Current Report ID
    @pyqtSlot(str)
    def setCurrentFloor(self, floor_id):
        self.current_report.setCurrentFloor(floor_id)
    
    @pyqtSlot(str)
    def setCurrentRoom(self, room_id):
        self.current_report.setCurrentRoom(room_id)

    @pyqtSlot(str)
    def setCurrentDevice(self, device_id):
        self.current_report.setCurrentDevice(device_id)



    # User List
    @pyqtSlot(result=list)
    def getUserList(self):
        #TODO: call get user list api
        pass


    # Settings
    @pyqtSlot(result=str)
    def getStatusBLS(self):
        #TODO: call get backup log system status api
        pass

    @pyqtSlot(result=str)
    def getTempThreshold(self):
        #TODO: call get temp threshold api
        pass

    @pyqtSlot(result=str)
    def getHumidThreshold(self):
        #TODO: call get humid threshold api
        pass
    
    @pyqtSlot(str, str)
    def updateThreshold(self, new_temp_threshold, new_humid_threshold):
        #TODO: call update threshold api
        pass

if __name__ == '__main__':
    appctxt = ApplicationContext()

    engine = QQmlApplicationEngine()
    # qmlFile = join(dirname(__file__), 'resources\qml\mainApp.qml')
    # engine.load(QUrl(str(qmlFile)))
    engine.load(QUrl('qrc:/resources/qml/mainApp.qml'))

    # Bridge to GUI
    bridge = Bridge()

    # Expose the Python object to QML
    context = engine.rootContext()
    context.setContextProperty('con', bridge)

    exit_code = appctxt.app.exec_()
    sys.exit(exit_code)
