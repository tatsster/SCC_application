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

from meteocalc import Temp, heat_index

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

step_change_value_temp = 5
step_change_value_humid = 5

temperature_value = 30.0 + random.choice([0,step_change_value_temp])*random.random()
humidity_value = 60.0 + random.choice([0,step_change_value_humid])*random.random()

# temperature_value = -999.0
# humidity_value = -999.0

# ====================================================
# MQTT Settings
mqtt_broker = config.mqtt_broker
mqtt_port = config.mqtt_port
mqtt_topic = config.mqtt_topic


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
mqttc.connect(mqtt_broker, int(mqtt_port))
mqttc.subscribe(config.mqtt_fake_topic)

def publish_to_topic(topic, message):
    mqttc.publish(topic, message)
    global step_change_value_temp
    global step_change_value_humid
    print("Step change value of temperature: ", step_change_value_temp)
    print("Step change value of humidity: ", step_change_value_humid)
    print("Heat Index: ", float("{0:.1f}".format(float(str(heat_index(float(json.loads(message)[0]["values"][0]),float(json.loads(message)[0]["values"][1])))))))
    print("Published: " + str(message) + " " + "on MQTT Topic: " + str(topic),"\n")

def publish_fake_sensor_values_to_mqtt():
    # Temperature_Value = float("{0:.2f}".format(random.uniform(16, 44)))
    # Humidity_Value = float("{0:.2f}".format(random.uniform(20, 100)))

    threading.Timer(config.thread_time, publish_fake_sensor_values_to_mqtt).start()

    global temperature_value
    global humidity_value
    global step_change_value_temp
    global step_change_value_humid

    try:

        temperature_value = float("{0:.1f}".format(temperature_value + random.choice([0,step_change_value_temp])*random.random()))
        humidity_value = float("{0:.1f}".format(humidity_value + random.choice([0,step_change_value_humid])*random.random()))

        if temperature_value > 37.0:
            step_change_value_temp = -5
        
        if temperature_value < 16.0:
            step_change_value_temp = 5

        if humidity_value > 80.0:
            step_change_value_humid = -5
        
        if humidity_value < 40.0:
            step_change_value_humid = 5

        data = {}
        data['device_id'] = "TempHumi"
        data['values'] = [ temperature_value , humidity_value ]
        array_data = []
        array_data.append(data)
        json_data = json.dumps(array_data)
        publish_to_topic(mqtt_topic, json_data)
    
    except (Exception, psycopg2.Error) as error :
        print("Strange: ", error)

publish_fake_sensor_values_to_mqtt()
