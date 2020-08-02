import paho.mqtt.subscribe as mqtt
import paho.mqtt.client as mqttc
import config
import psycopg2
import psycopg2.extras
import random, threading, json
import calendar
import time
import sys

from meteocalc import Temp, heat_index

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
# MQTT Settings
# mqtt_broker = config.mqtt_broker
# mqtt_port = config.mqtt_port
# mqtt_topic = config.mqtt_topic
# mqtt_topic = str(sys.argv[5])

# ====================================================
# MQTT In action
def on_connect(client, userdata, rc):
    if rc != 0:
        print("Unable to connect to MQTT Broker...")
    else:
        print("Connected with MQTT Broker: " + str(sys.argv[3]))


def on_publish(client, userdata, mid):
    pass


def on_disconnect(client, userdata, rc):
    if rc != 0:
        pass


mqttc = mqttc.Client()
mqttc.username_pw_set(username=sys.argv[1],password=sys.argv[2])
subscribe_topic = sys.argv[5]
publish_topic = sys.argv[6]
ip = sys.argv[3]
port = sys.argv[4]
current_place = 1
timestamp_now = int(sys.argv[11])
mqttc.connect(ip, int(port))
mqttc.on_connect = on_connect
mqttc.on_disconnect = on_disconnect
mqttc.on_publish = on_publish

def publish_to_topic(topic, message):
    mqttc.publish(publish_topic, message)
    print("Published: " + str(message) + " " + "on MQTT Topic: " + str(publish_topic),"\n")

def publish_air_conditioner_values_to_mqtt(status,value):

    try:
        data = {}
        data['device_id'] = sys.argv[10]
        data['values'] = [status,value]
        array_data = []
        array_data.append(data)
        json_data = json.dumps(array_data)
        publish_to_topic(publish_topic, json_data)
    
    except (Exception, psycopg2.Error) as error :
        print("Strange: ", error)

def message(client, userdata, msg):

    global timestamp_now
    global current_place

    payloads  = msg.payload.decode("utf-8")
    dic = json.loads(payloads)[0]

    print("Received: " + str(payloads) + " " + "on MQTT Topic: " + str(subscribe_topic),"\n")
    
    try:

        if (float(dic["values"][0]) > 0 and float(dic["values"][1]) > 0):

            try:

                # Calculate heat index
                heat_index_value = float("{0:.1f}".format(float(str(heat_index(float(dic["values"][0]),float(dic["values"][1]))))))

                ts = calendar.timegm(time.gmtime())

                print("Temperature: " + str(dic["values"][0]) + ", Humidity: " + str(dic["values"][1]) + ", Heat Index: " + str(heat_index_value),"\n")

                if heat_index_value > float(sys.argv[9]):

                    publish_air_conditioner_values_to_mqtt("1",sys.argv[7])

                    if current_place == 0:

                        current_place = 1

                        timestamp_now = ts
                    
                        sql = """INSERT INTO device_log(device_id, device_status, device_timestamp, device_hours_usage, device_electrical_consumption, device_status_value) VALUES ('""" + str(sys.argv[10]) + """', '""" + "true" + """', '""" + str(ts) + """', '""" + "0" + """', '""" + "0" + """', '""" + str(sys.argv[7]) + """')"""

                        try:
                            # Execute the SQL command
                            cursor.execute(sql)
                            # Commit your changes in the database
                            db.commit()
                        except (Exception, psycopg2.Error) as error :
                            print ("2: ", error)
                            # Rollback in case there is any error
                            db.rollback()

                elif heat_index_value < float(sys.argv[8]):

                    publish_air_conditioner_values_to_mqtt("0","0")

                    if current_place == 1:

                        current_place = 0

                        timestamp_new = ts

                        hours_usage =  float( timestamp_new - timestamp_now ) / 3600.0
                        electrical_consumption = float(hours_usage * float(str(sys.argv[12])))

                        sql = """INSERT INTO device_log(device_id, device_status, device_timestamp, device_hours_usage, device_electrical_consumption, device_status_value) VALUES ('""" + str(sys.argv[10]) + """', '""" + "false" + """', '""" + str(ts) + """', '""" + str(hours_usage) + """', '""" + str(electrical_consumption) + """', '""" + str(sys.argv[7]) + """')"""

                        try:
                            # Execute the SQL command
                            cursor.execute(sql)
                            # Commit your changes in the database
                            db.commit()
                        except (Exception, psycopg2.Error) as error :
                            print ("3: ", error)
                            # Rollback in case there is any error
                            db.rollback()

            except (Exception, psycopg2.Error) as error :
                print ("1: ", error)
                # Rollback in case there is any error
                db.rollback()

    except (Exception, psycopg2.Error) as error :
        print ("0: ", error)

publish_air_conditioner_values_to_mqtt("1",sys.argv[7])
                    
mqtt.callback(message,subscribe_topic,hostname=ip)
