import paho.mqtt.subscribe as mqtt
import paho.mqtt.client as mqttc
import config
import json
import psycopg2
import psycopg2.extras
import calendar
import time
import sys

from enum import Enum
class Device(Enum):
    heat_index_upper_threshold = 0
    heat_index_upper_threshold_default = 1
    heat_index_lower_threshold = 2
    heat_index_lower_threshold_default = 3

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
client.username_pw_set(username=sys.argv[1],password=sys.argv[2])
mqttc.on_connect = on_connect
mqttc.on_disconnect = on_disconnect
mqttc.on_publish = on_publish
topic = sys.argv[5]
ip = sys.argv[3]
port = sys.argv[4]
client.connect(ip, int(port))
client.subscribe(topic)

# client.username_pw_set(username="BKvm2",password="Hcmut_CSE_2020")
# client.connect("23.97.54.16", int("1883"))
# client.subscribe("Topic/Light")

# def publish_to_topic(topic, message):
#     client.publish(topic, message)
#     print("Published: " + str(message) + " " + "on MQTT Topic: " + str(topic),"\n")

def message(client, userdata, msg):

    payloads  = msg.payload.decode("utf-8")
    dic = json.loads(payloads)[0]

    print("Received: " + str(payloads) + " " + "on MQTT Topic: " + str(msg.topic),"\n")
    
    try:

        if (float(dic["values"][0]) > 0 and float(dic["values"][1]) > 0):

            try:

                # Calculate heat index
                heat_index_value = float("{0:.1f}".format(float(str(heat_index(float(dic["values"][0]),float(dic["values"][1]))))))

                ts = calendar.timegm(time.gmtime())

                print("Temperature: " + str(dic["values"][0]) + ", Humidity: " + str(dic["values"][1]) + ", Heat Index: " + str(heat_index_value),"\n")

                sql = """INSERT INTO sensor_log(sensor_id, sensor_temp, sensor_humid, sensor_heat_index, sensor_timestamp) VALUES ('""" + str(sys.argv[6]) + """', '""" + str(dic["values"][0]) + """', '""" + str(dic["values"][1]) + """', '""" + str(heat_index_value) + """', '""" + str(ts) + """')"""

                try:
                    # Execute the SQL command
                    cursor.execute(sql)
                    # Commit your changes in the database
                    db.commit()
                except (Exception, psycopg2.Error) as error :
                    print ("2: ", error)
                    # Rollback in case there is any error
                    db.rollback()

            except (Exception, psycopg2.Error) as error :
                print ("1: ", error)
                # Rollback in case there is any error
                db.rollback()

    except (Exception, psycopg2.Error) as error :
        print ("0: ", error)

mqtt.callback(message,topic,hostname=ip)
