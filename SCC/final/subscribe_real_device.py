import paho.mqtt.subscribe as mqtt
import paho.mqtt.client as mqttc
import config
import json
import psycopg2
import psycopg2.extras
import calendar
import time
import sys

# ====================================================
# PostgreSQL Settings

try:
    db = psycopg2.connect(user = config.db_user,
                                password = config.db_password,
                                host = config.db_host,
                                port = config.db_port,
                                database = config.db_name)

    cursor = db.cursor(cursor_factory=psycopg2.extras.DictCursor)
    # Print PostgreSQL Connection properties
    print ( db.get_dsn_parameters(),"\n")

    # Print PostgreSQL version
    cursor.execute("SELECT version();")
    record = cursor.fetchone()
    print("You are connected to - ", record,"\n")

except (Exception, psycopg2.Error) as error :
    print ("Error while connecting to PostgreSQL", error)

# ====================================================
# MQTT In action

def on_connect(client, userdata, rc):
    if rc != 0:
        print("Unable to connect to MQTT Broker...")
    else:
        print("Connected with MQTT Broker: " + str(config.mqtt_broker))

def on_publish(client, userdata, mid):
    pass

def on_disconnect(client, userdata, rc):
    if rc != 0:
        pass

client = mqttc.Client()
mqttc.on_connect = on_connect
mqttc.on_disconnect = on_disconnect
mqttc.on_publish = on_publish
# client.username_pw_set(username=config.mqtt_real_username,password=config.mqtt_real_password)
# client.connect(config.mqtt_broker, config.mqtt_port)
# client.subscribe(config.mqtt_topic)
topic = sys.argv[5]
ip = sys.argv[3]
port = sys.argv[4]
client.username_pw_set(username=sys.argv[1],password=sys.argv[2])
client.connect(ip, int(port))
client.subscribe(topic)

def message(client, userdata, msg):

    payloads  = str(msg.payload.decode("utf-8"))
    dic = json.loads(payloads)

    print("Received: " + str(payloads) + " " + "on MQTT Topic: " + str(msg.topic),"\n")
    
    # try:

    #     # Get threshold constant

    #     sql = """SELECT * FROM sensor WHERE sensor_id = '""" + str(dic["device_id"]) + """' """

    #     try:
    #         # Execute the SQL command
    #         cursor.execute(sql)

    #         result = cursor.fetchone()

    #         sql = """SELECT * FROM device WHERE floor_id = '""" + str(result["floor_id"]) + """' and room_id = '""" + str(result["room_id"]) + """' """

    #         # Execute the SQL command
    #         cursor.execute(sql)

    #         result = cursor.fetchone()
            
    #         final_result = str(result["device_additional"]).replace("[","").replace("]","").split(",")
            
    #         if final_result[Device.heat_index_upper_threshold.value] > final_result[Device.heat_index_upper_threshold_default.value] or final_result[Device.heat_index_upper_threshold.value] < final_result[Device.heat_index_lower_threshold_default.value]:
    #             heat_index_upper = float(final_result[Device.heat_index_upper_threshold_default.value])
    #         else:
    #             heat_index_upper = float(final_result[Device.heat_index_upper_threshold.value])

    #         # print(heat_index_upper)

    #         if final_result[Device.heat_index_lower_threshold.value] > final_result[Device.heat_index_upper_threshold_default.value] or final_result[Device.heat_index_lower_threshold.value] < final_result[Device.heat_index_lower_threshold_default.value]:
    #             heat_index_lower = float(final_result[Device.heat_index_lower_threshold_default.value])
    #         else:
    #             heat_index_lower = float(final_result[Device.heat_index_lower_threshold.value])

    #         # print(heat_index_lower)

    #         action = result["device_status"]

    #         if (result["device_automation"]):

    #             # Get current timestamp
    #             ts = calendar.timegm(time.gmtime())
                
    #             # Calculate heat index
    #             heat_index_value = float("{0:.1f}".format(float(str(heat_index(dic["values"][0],dic["values"][1])))))

    #             if action:
    #                 if heat_index_value < heat_index_lower:
    #                     action = False
    #                     data = {}
    #                     data['device_id'] = str(result["device_id"])
    #                     data['values'] = action
    #                     data['device_updated_by'] = "Automation_" + str(result["device_updated_by"]).replace("Automation_","")
    #                     json_data = json.dumps(data)
    #                     publish_to_topic(config.mqtt_fake_topic, json_data)
    #             else:
    #                 if heat_index_value > heat_index_upper:
    #                     action = True
    #                     data = {}
    #                     data['device_id'] = str(result["device_id"])
    #                     data['values'] = action
    #                     data['device_updated_by'] = "Automation_" + str(result["device_updated_by"]).replace("Automation_","")
    #                     json_data = json.dumps(data)
    #                     publish_to_topic(config.mqtt_fake_topic, json_data)

    #             print("Action: " + str(action) + ", Heat Index: " + str(heat_index_value),"\n")

    #             sql = """INSERT INTO temp_humid_log(sensor_id, sensor_temp, sensor_humid, sensor_heat_index, sensor_timestamp) VALUES ('""" + str(dic["device_id"]) + """', '""" + str(dic["values"][0]) + """', '""" + str(dic["values"][1]) + """', '""" + str(heat_index_value) + """', '""" + str(ts) + """')"""

    #             try:
    #                 # Execute the SQL command
    #                 cursor.execute(sql)
    #                 # Commit your changes in the database
    #                 db.commit()
    #             except (Exception, psycopg2.Error) as error :
    #                 print ("2: ", error)
    #                 # Rollback in case there is any error
    #                 db.rollback()

    #     except (Exception, psycopg2.Error) as error :
    #         print ("1: ", error)
    #         # Rollback in case there is any error
    #         db.rollback()

    # except (Exception, psycopg2.Error) as error :
    #     print ("3: ", error)

mqtt.callback(message,topic,hostname=ip)
