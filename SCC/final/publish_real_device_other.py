import paho.mqtt.subscribe as mqtts
import paho.mqtt.client as mqtt
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

step_change_value = 0

sql = """SELECT constant_value FROM constant WHERE constant_id = 1"""

try:
    # Execute the SQL command
    cursor.execute(sql)
    
    result = cursor.fetchone()

    step_change_value = int(result["constant_value"])

except (Exception, psycopg2.Error) as error :
    print ("1: ", error)
    # Rollback in case there is any error
    db.rollback()

temperature_value = 30.0 + random.choice([0,step_change_value])*random.random()
humidity_value = 60.0 + random.choice([0,step_change_value])*random.random()

# ====================================================
# MQTT Settings
mqtt_broker = config.mqtt_broker
mqtt_port = config.mqtt_port
# mqtt_topic = config.mqtt_topic
mqtt_topic = str(sys.argv[5])

# ====================================================
# MQTT In action
def on_connect(client, userdata, rc):
    if rc != 0:
        print("Unable to connect to MQTT Broker...")
    else:
        print("Connected with MQTT Broker: " + str(mqtt_broker))


def on_publish(client, userdata, mid):
    pass


def on_disconnect(client, userdata, rc):
    if rc != 0:
        pass


mqttc = mqtt.Client()
mqttc.username_pw_set(username="config.mqtt_real_username",password=config.mqtt_real_password)
mqttc.on_connect = on_connect
mqttc.on_disconnect = on_disconnect
mqttc.on_publish = on_publish
# mqttc.connect(mqtt_broker, int(mqtt_port))
# mqttc.subscribe(config.mqtt_fake_topic)
mqttc.username_pw_set(username=sys.argv[1],password=sys.argv[2])
mqttc.connect(sys.argv[3], int(sys.argv[4]))

def publish_to_topic(topic, message):
    mqttc.publish(topic, message)
    global step_change_value
    print("Step change value: ", step_change_value)
    print("Published: " + str(message) + " " + "on MQTT Topic: " + str(topic),"\n")

def publish_air_conditioner_values_to_mqtt():

    try:
        data = {}
        data['device_id'] = "Light_D"
        data['values'] = ["0","100"]
        array_data = []
        array_data.append(data)
        json_data = json.dumps(array_data)
        publish_to_topic(mqtt_topic, json_data)
    
    except (Exception, psycopg2.Error) as error :
        print("Strange: ", error)

publish_air_conditioner_values_to_mqtt()
