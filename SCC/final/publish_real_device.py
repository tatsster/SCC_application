import paho.mqtt.subscribe as mqtt
import paho.mqtt.client as mqttc
import config
import psycopg2
import psycopg2.extras
import random, threading, json
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
topic = sys.argv[5]
ip = sys.argv[3]
port = sys.argv[4]
mqttc.connect(ip, int(port))
mqttc.on_connect = on_connect
mqttc.on_disconnect = on_disconnect
mqttc.on_publish = on_publish

def publish_to_topic(topic, message):
    mqttc.publish(topic, message)
    print("Published: " + str(message) + " " + "on MQTT Topic: " + str(topic),"\n")

def publish_air_conditioner_values_to_mqtt():

    try:
        data = {}
        data['device_id'] = sys.argv[7]
        values = sys.argv[6]
        values = values.replace("[","").replace("]","").split(",")
        data['values'] = [values[0],values[1]]
        array_data = []
        array_data.append(data)
        json_data = json.dumps(array_data)
        publish_to_topic(topic, json_data)
    
    except (Exception, psycopg2.Error) as error :
        print("Strange: ", error)

publish_air_conditioner_values_to_mqtt()
