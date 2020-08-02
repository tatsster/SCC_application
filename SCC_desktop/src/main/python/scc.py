import json
import os
import sys
import threading
from datetime import datetime
from os.path import dirname, join

import requests
from fbs_runtime.application_context.PyQt5 import ApplicationContext
from PyQt5.QtCore import QObject, QUrl, pyqtSlot
from PyQt5.QtQml import QQmlApplicationEngine
from PyQt5.QtWidgets import QApplication

import src


class Dashboard():
    def __init__(self):
        self.hours_usage = ""
        self.electrical_usage = ""
        self.current_temp = ""
        self.current_humid = ""
        self.lastest_update = ""

    def setDashboard(self, hours_usage, electrical_usage, current_temp, current_humid, lastest_update):
        self.hours_usage = hours_usage
        self.electrical_usage = electrical_usage
        self.current_temp = current_temp
        self.current_humid = current_humid
        self.lastest_update = lastest_update


class User():
    def __init__(self):
        self.user_id = ""
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


class Bridge(QObject):

    current_host = "http://179c19801333.ngrok.io"
    current_user = User()
    current_dashboard = Dashboard()

    current_building_info = {}
    current_building = ""
    current_building_status = False
    current_floor = ""
    current_floor_status = False
    current_room = ""
    current_room_status = False
    current_room_list = {}
    current_device = ""
    current_sensor = ""

    @pyqtSlot(str, str, result=bool)
    def checkValidLogin(self, username, password):
        send_api = requests.post(
            self.current_host + "/api/sign-in?user_email=" + username + "&user_password=" + password)
        result = json.loads(send_api.text)
        if (result["success"]):
            self.current_user.user_id = result["data"][0]["user"]["user_id"]
            self.current_user.user_name = result["data"][0]["user"]["user_fullname"]
            self.current_user.user_ava = self.current_host + \
                result["data"][0]["user"]["user_avatar"][2:]
            self.current_user.user_email = result["data"][0]["user"]["user_email"]
            self.current_user.user_phone = result["data"][0]["user"]["user_mobile"]
            self.current_user.user_position = result["data"][0]["user"]["user_role"]
            self.current_user.user_address = result["data"][0]["user"]["user_address"]
            return True
        else:
            return False

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

    @pyqtSlot(str, str, str, result=bool)
    def updateProfile(self, new_user_name, new_user_phone, new_user_address):
        send_api = requests.post(self.current_host + "/api/update-profile?user_id=" +
                                 self.current_user.user_id + "&user_fullname=" + new_user_name + "&user_address=" + new_user_address + "&user_mobile=" + new_user_phone)

        result = json.loads(send_api.text)
        if result["message"] == "Successfully updated !!!":
            self.current_user.user_name = result["data"][0]["user_fullname"]
            self.current_user.user_phone = result["data"][0]["user_mobile"]
            self.current_user.user_address = result["data"][0]["user_address"]
            return True
        else:
            return False

    # Dashboard Info
    @pyqtSlot()
    def getDashboardInfo(self):
        send_api = requests.post(
            self.current_host + "/api/hours-usage-electrical-consumption?user_id=" + self.current_user.user_id)
        result = json.loads(send_api.text)

        send_weather_api = requests.post(
            self.current_host + "/api/get-current-weather?user_id=" + self.current_user.user_id)
        result_weather = json.loads(send_weather_api.text)

        self.current_dashboard.hours_usage = result["data"][0]["hours_usage"]
        self.current_dashboard.electrical_usage = result["data"][0]["electrical_consumption"]

        self.current_dashboard.current_temp = result_weather["data"][0]["current_temp"]
        self.current_dashboard.current_humid = result_weather["data"][0]["current_humid"]
        self.current_dashboard.lastest_update = str(
            datetime.fromtimestamp(int(result_weather["data"][0]["timestamp"])))

    @pyqtSlot(result=str)
    def getHoursUsage(self):
        return str(self.current_dashboard.hours_usage) + " hrs"

    @pyqtSlot(result=str)
    def getElectricalUsage(self):
        return str(self.current_dashboard.electrical_usage) + " kWh"

    @pyqtSlot(result=str)
    def getLastUpdateTime(self):
        return self.current_dashboard.lastest_update

    @pyqtSlot(result=str)
    def getRealTimeTemp(self):
        return str(self.current_dashboard.current_temp) + "°C"

    @pyqtSlot(result=str)
    def getRealTimeHumid(self):
        return str(self.current_dashboard.current_humid) + "%"

    # Report
    @pyqtSlot(str)
    def setCurrentBuilding(self, building_name):
        self.current_building = building_name

    @pyqtSlot(result=list)
    def getCurrentBuilding(self):
        return [{"name": self.current_building}]

    @pyqtSlot(result=str)
    def getCurrentBuildingName(self):
        return self.current_building

    @pyqtSlot()
    def getBuildingInfo(self):
        send_api = requests.post(
            self.current_host + "/api/get-room?user_id=" + self.current_user.user_id)
        result = json.loads(send_api.text)
        building_list = {}

        for item in result["data"]:
            current_building = item["room_building"] + " Building"
            current_floor = "Floor " + item["room_floor"]
            current_room = "Room " + item["room_name"]
            if current_building not in building_list.keys():
                building_list[current_building] = {}
                building_list[current_building]["floors"] = []
                building_list[current_building]["floors_info"] = []
            if current_floor not in building_list[current_building]["floors"]:
                building_list[current_building]["floors"].append(current_floor)
                building_list[current_building]["floors_info"].append(
                    {current_floor: []})
            for floor in building_list[current_building]["floors_info"]:
                if current_floor in floor.keys():
                    if current_room not in floor[current_floor]:
                        floor[current_floor].append(current_room)

        self.current_building_info = building_list

    @pyqtSlot(result=list)
    def getBuildingList(self):
        """ Format return json:
        [
            {"name": "A4 Building"}, 
            {"name": "B4 Building"}
        ]
        """
        self.getBuildingInfo()
        model = []
        for building_name in self.current_building_info.keys():
            model.append({"name": building_name})
        return model

    @pyqtSlot(str, result=list)
    def getFloorList(self, building_name):
        """ Format return json:
        [
            {"name": "Floor 5"}, 
            {"name": "Floor 4"}, 
            {"name": "Floor 3"}, 
            {"name": "Floor 2"}, 
            {"name": "Floor 1"}
        ]
        """
        model = []
        for floors_name in self.current_building_info[building_name]["floors"]:
            model.append({"name": floors_name})
        return model

    @pyqtSlot(str, str, result=list)
    def getRoomList(self, building_name, floor_name):
        """ Format return json (floor 5):
        [
            {"name": "Room 505"}, 
            {"name": "Room 504"}, 
            {"name": "Room 503"},
            {"name": "Room 502"},
            {"name": "Room 501"}
        ]
        """
        model = []
        for floor_info in self.current_building_info[building_name]["floors_info"]:
            if floor_name in floor_info.keys():
                for room_name in floor_info[floor_name]:
                    model.append({"name": room_name})
        return model

    # Building Report
    @pyqtSlot(result=list)
    def getBuildingTable(self):
        """ Format return json:
        [
            {
                "floorName": "Floor 5",
                "eHoursUsage": "200",
                "electricalUsage": "400 kW",
                "updateDatetime": "29/05/2020 12:00:00 AM",
                "viewButton": "F0005"
            }
        ]
        """
        send_api = requests.post(
            self.current_host + "/api/get-floor-table?user_id=" + self.current_user.user_id + "&building=" + self.current_building[:2])
        result = json.loads(send_api.text)
        model = []

        for data in result["data"]:
            self.current_building_status = data["building_active"]
            if data["floor"]:
                for floor in data["floor"].keys():
                    model_child = {}
                    model_child["floorName"] = "Floor " + floor
                    model_child["eHoursUsage"] = (
                        data["floor"][floor]["hours_usage"] if data["floor"][floor]["hours_usage"] else "null")
                    model_child["electricalUsage"] = (
                        data["floor"][floor]["electrical_consumption"] if data["floor"][floor]["electrical_consumption"] else "null")
                    model_child["updateDatetime"] = (str(datetime.fromtimestamp(int(
                        data["floor"][floor]["lastest_timestamp"]))) if data["floor"][floor]["lastest_timestamp"] else "null")
                    model_child["viewButton"] = "Floor " + floor
                    model.append(model_child)
        return model

    @pyqtSlot()
    def turnOffBuilding(self):
        button_value = 1
        send_api = requests.post(
            self.current_host + "/api/activate-deactivate-building?user_id=" + self.current_user.user_id + "&building=" + self.current_building[:2] + "&button=" + str(button_value))

    # Floor Report
    @pyqtSlot(str)
    def setCurrentFloor(self, floor_name):
        self.current_floor = floor_name

    @pyqtSlot(result=str)
    def getCurrentFloorName(self):
        return self.current_floor

    @pyqtSlot(result=str)
    def getCurrentFloorReportLabel(self):
        return str("Report " + self.current_floor)

    @pyqtSlot(result=str)
    def getCurrentFloorReportName(self):
        return str("Rooms in " + self.current_floor + " Building " + self.current_building.split()[0])

    @pyqtSlot(result=list)
    def getFloorTable(self):
        """ Format return json
        [
            {
                "roomName": "Room 505",
                "currentTemp": "30 °C",
                "currentHumid": "50 %",
                "eHoursUsage": "200",
                "electricalUsage": "400 kW",
                "updateDatetime": "29/05/2020 12:00:00 AM",
                "viewButton": "R505"
            }
        ]
        """
        send_api = requests.post(
            self.current_host + "/api/get-room-table?user_id=" + self.current_user.user_id + "&building=" + self.current_building[:2] + "&floor=" + self.current_floor.split()[-1])
        result = json.loads(send_api.text)
        model = []

        for data in result["data"]:
            self.current_floor_status = data["floor_active"]
            if data["room"]:
                for room in data["room"].keys():
                    model_child = {}
                    model_child["roomName"] = "Room " + room
                    if data["room"][room]["current_temperature"]:
                        model_child["currentTemp"] = data["room"][room]["current_temperature"] + " °C"
                    else:
                        model_child["currentTemp"] = "null"
                    if data["room"][room]["current_humidity"]:
                        model_child["currentHumid"] = data["room"][room]["current_humidity"] + " %"
                    else:
                        model_child["currentHumid"] = "null"

                    model_child["eHoursUsage"] = (
                        data["room"][room]["hours_usage"] if data["room"][room]["hours_usage"] else "null")
                    model_child["electricalUsage"] = (
                        data["room"][room]["electrical_consumption"] if data["room"][room]["electrical_consumption"] else "null")
                    model_child["updateDatetime"] = (str(datetime.fromtimestamp(int(
                        data["room"][room]["lastest_timestamp"]))) if data["room"][room]["lastest_timestamp"] else "null")
                    model_child["viewButton"] = "Room " + room
                    model.append(model_child)
        return model

    @pyqtSlot()
    def turnOffFloor(self):
        button_value = 1
        send_api = requests.post(
            self.current_host + "/api/activate-deactivate-floor?user_id=" + self.current_user.user_id + "&building=" + self.current_building[:2] + "&current_floor=" + self.current_floor.split()[-1] + "&button=" + str(button_value))

    # Room Report
    @pyqtSlot(str)
    def setCurrentRoom(self, current_room):
        self.current_room = current_room

    @pyqtSlot(result=str)
    def getCurrentRoomName(self):
        return self.current_room

    @pyqtSlot(result=str)
    def getCurrentRoomDeviceLabel(self):
        return str("Devices in " + self.current_room + " " + self.current_floor + " Building " + self.current_building.split()[0])

    @pyqtSlot(result=str)
    def getCurrentRoomSensorLabel(self):
        return str("Sensors in " + self.current_room + " " + self.current_floor + " Building " + self.current_building.split()[0])

    @pyqtSlot(result=list)
    def getRoomDeviceTable(self):
        """ Format return json:
        [
            {
                "deviceName": "Light 1",
                "status": "ON",
                "eHoursUsage": "200",
                "electricalUsage": "400 kW",
                "updateDatetime": "29/05/2020 12:00:00 AM",
                "viewButton": "LIGHT200"
            }
        ]
        """
        send_api = requests.post(
            self.current_host + "/api/get-sensor-device-table?user_id=" + self.current_user.user_id + "&building=" + self.current_building[:2] + "&floor=" + self.current_floor.split()[-1] + "&room=" + self.current_room.split()[-1])
        result = json.loads(send_api.text)
        self.current_room_list = result

        model = []
        for data in result["data"]:
            self.current_room_status = data["room_active"]
            if data["device"]:
                for device in data["device"].keys():
                    model_child = {}
                    model_child["deviceName"] = device
                    if data["device"][device]["status"]:
                        model_child["status"] = "ON"
                    else:
                        model_child["status"] = "OFF"
                    model_child["eHoursUsage"] = data["device"][device]["hours_usage"]
                    model_child["electricalUsage"] = data["device"][device]["electrical_consumption"]
                    model_child["updateDatetime"] = str(datetime.fromtimestamp(
                        int(data["device"][device]["lastest_timestamp"])))
                    model_child["viewButton"] = device
                    model.append(model_child)
        return model

    @pyqtSlot(result=str)
    def getActivateRoomStatus(self):
        if self.current_room_status:
            return "ON"
        else:
            return "OFF"

    @pyqtSlot(result=list)
    def getRoomSensorTable(self):
        """ Format return json:
        [
            {
                "sensorName": "Light 1",
                "status": "ON",
                "currentTemp": "27 °C",
                "currentHumid": "50 %",
                "updateDatetime": "29/05/2020 12:00:00 AM",
                "viewButton": "LIGHT200"
            }
        ]
        """
        result = self.current_room_list
        model = []
        for data in result["data"]:
            if data["sensor"]:
                for sensor in data["sensor"].keys():
                    model_child = {}
                    model_child["sensorName"] = sensor
                    if data["sensor"][sensor]["status"]:
                        model_child["status"] = "ON"
                        model_child["currentTemp"] = data["sensor"][sensor]["current_temperature"] + " °C"
                        model_child["currentHumid"] = data["sensor"][sensor]["current_humidity"] + " %"
                    else:
                        model_child["status"] = "OFF"
                        model_child["currentTemp"] = "null"
                        model_child["currentHumid"] = "null"
                    if data["sensor"][sensor]["lastest_timestamp"]:
                        model_child["updateDatetime"] = str(datetime.fromtimestamp(
                            int(data["sensor"][sensor]["lastest_timestamp"])))
                    else:
                        model_child["updateDatetime"] = "null"
                    model_child["viewButton"] = sensor
                    model.append(model_child)
        return model

    @pyqtSlot(result=str)
    def getCurrentRoomTemp(self):
        result = self.current_room_list
        model = []
        for data in result["data"]:
            if data["sensor"]:
                for sensor in data["sensor"].keys():
                    if data["sensor"][sensor]["status"]:
                        return data["sensor"][sensor]["current_temperature"] + " °C"
                    else:
                        continue
        return "null"

    @pyqtSlot(result=str)
    def getCurrentRoomHumid(self):
        result = self.current_room_list
        model = []
        for data in result["data"]:
            if data["sensor"]:
                for sensor in data["sensor"].keys():
                    if data["sensor"][sensor]["status"]:
                        return data["sensor"][sensor]["current_humidity"] + " %"
                    else:
                        continue
        return "null"

    @pyqtSlot()
    def turnOffRoom(self):
        button_value = 1
        send_api = requests.post(
            self.current_host + "/api/activate-deactivate-room?user_id=" + self.current_user.user_id + "&building=" + self.current_building[:2] + "&current_floor=" + self.current_floor.split()[-1] + "&current_room=" + self.current_room.split()[-1] + "&button=" + str(button_value))

    # Device Report
    @pyqtSlot(str)
    def setCurrentDevice(self, current_device):
        self.current_device = current_device

    @pyqtSlot(result=str)
    def getDeviceReportLabel(self):
        return str("Report Device " + self.current_device)

    @pyqtSlot(result=str)
    def getDeviceNameLabel(self):
        return str(self.current_device + " History Report")

    @pyqtSlot(result=list)
    def getDeviceTable(self):
        """ Format return json
        [
            {
                "deviceName": "Light 1",
                "status": "ON",
                "deviceStatusValue": "240",
                "eHoursUsage": "200",
                "electricalUsage": "400 kW",
                "updateDatetime": "29/05/2020 12:00:00 AM"
            }
        ]
        """
        send_api = requests.post(
            self.current_host + "/api/get-device-full-log?user_id=" + self.current_user.user_id + "&device_id=" + self.current_device)
        result = json.loads(send_api.text)
        model = []

        for data in result["data"]:
            if data["device_log"]:
                for device_log in data["device_log"]:
                    model_child = {}
                    model_child["deviceName"] = device_log["device_id"]
                    if device_log["device_status"]:
                        model_child["status"] = "ON"
                    else:
                        model_child["status"] = "OFF"
                    model_child["deviceStatusValue"] = device_log["device_status_value"]
                    model_child["eHoursUsage"] = device_log["device_hours_usage"]
                    model_child["electricalUsage"] = device_log["device_electrical_consumption"]
                    model_child["updateDatetime"] = str(
                        datetime.fromtimestamp(int(device_log["device_timestamp"])))
                    model.append(model_child)
        return model

    @pyqtSlot(str, str)
    def toggleDevice(self, device_name, current_status):
        send_device_api = requests.post(
            self.current_host + "/api/get-device-full-log?user_id=" + self.current_user.user_id + "&device_id=" + self.current_device)
        result_device = json.loads(send_device_api.text)

        button_value = 0
        if current_status == "ON":
            button_value = 1

        for data in result_device["data"]:
            device = data["device"]
            send_toggle_api = requests.post(self.current_host + "/api/run-stop-device?user_id=" + self.current_user.user_id + "&device_id=" +
                                            device_name + "&device_username=" + device["device_username"] + "&device_password=" + device["device_password"] + "&device_ip=" + str(device["device_ip"]) + "&device_port=" + str(device["device_port"]) + "&device_topic=" + device["device_topic"] + "&button=" + str(button_value) + "&device_status_value=" + str(device["device_status_value"]))
            break

    # Sensor Report
    @pyqtSlot(str)
    def setCurrentSensor(self, current_sensor):
        self.current_sensor = current_sensor

    @pyqtSlot(result=str)
    def getSensorReportLabel(self):
        return str("Report Sensor " + self.current_sensor)

    @pyqtSlot(result=str)
    def getSensorNameLabel(self):
        return str(self.current_sensor + " History Report")

    @pyqtSlot(result=list)
    def getSensorTable(self):
        """ Format return json
        [
            {
                "sensorName": "Light 1",
                "sensorTemp": "27",
                "sensorHumid": "50",
                "sensorHeatIndex": "12",
                "updateDatetime": "29/05/2020 12:00:00 AM"
            }
        ]
        """
        send_api = requests.post(
            self.current_host + "/api/get-sensor-full-log?user_id=" + self.current_user.user_id + "&sensor_id=" + self.current_sensor)
        result = json.loads(send_api.text)
        model = []

        for data in result["data"]:
            if data["sensor_log"]:
                for sensor_log in data["sensor_log"]:
                    model_child = {}
                    model_child["sensorName"] = sensor_log["sensor_id"]
                    model_child["sensorTemp"] = sensor_log["sensor_temp"]
                    model_child["sensorHumid"] = sensor_log["sensor_humid"]
                    model_child["sensorHeatIndex"] = sensor_log["sensor_heat_index"]
                    model_child["updateDatetime"] = str(
                        datetime.fromtimestamp(int(sensor_log["sensor_timestamp"])))
                    model.append(model_child)
        return model

    @pyqtSlot(str, str)
    def toggleSensor(self, sensor_name, current_status):
        send_sensor_api = requests.post(
            self.current_host + "/api/get-sensor-full-log?user_id=" + self.current_user.user_id + "&sensor_id=" + self.current_sensor)
        result_sensor = json.loads(send_sensor_api.text)

        button_value = 0
        if current_status == "ON":
            button_value = 1

        if button_value:
            send_toggle_api = requests.post(self.current_host + "/api/run-stop-sensor?user_id=" +
                                            self.current_user.user_id + "&sensor_id=" + sensor_name + "&button=" + str(button_value))
        else:
            for data in result_sensor["data"]:
                sensor = data["sensor"]
                threading.Thread(target=requests.post, args=(self.current_host + "/api/run-stop-sensor?user_id=" + self.current_user.user_id + "&sensor_id=" +
                                                             sensor_name + "&sensor_username=" + sensor["sensor_username"] + "&sensor_password=" + sensor["sensor_password"] + "&sensor_ip=" + str(sensor["sensor_ip"]) + "&sensor_port=" + str(sensor["sensor_port"]) + "&sensor_topic=" + sensor["sensor_topic"] + "&button=" + str(button_value),)).start()
                # send_toggle_api = requests.post(self.current_host + "/api/run-stop-sensor?user_id=" + self.current_user.user_id + "&sensor_id=" +
                #                                 sensor_name + "&sensor_username=" + sensor["sensor_username"] + "&sensor_password=" + sensor["sensor_password"] + "&sensor_ip=" + str(sensor["sensor_ip"]) + "&sensor_port=" + str(sensor["sensor_port"]) + "&sensor_topic=" + sensor["sensor_topic"] + "&button=" + str(button_value))

                break

    # User List
    @pyqtSlot(result=list)
    def getUserList(self):
        send_api = requests.post(
            self.current_host + "/api/user-list?user_id=" + self.current_user.user_id)
        result = json.loads(send_api.text)
        model = []

        for user in result["data"]:
            current_user = {}
            current_user["user_avatar"] = self.current_host + \
                user["user_avatar"][2:]
            current_user["user_fullname"] = user["user_fullname"]
            current_user["user_role"] = user["user_role"]
            current_user["user_email"] = user["user_email"]
            current_user["user_mobile"] = user["user_mobile"]
            current_user["user_address"] = user["user_address"]
            model.append(current_user)

        return model

    # Settings
    @pyqtSlot(result=str)
    def getStatusBLS(self):
        # TODO: call get backup log system status api
        pass

    @pyqtSlot(result=str)
    def getStatusMTS(self):
        # TODO: call get maintainance status api
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
