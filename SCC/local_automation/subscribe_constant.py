import paho.mqtt.subscribe as mqtts
import paho.mqtt.client as mqtt
import config
import psycopg2
import psycopg2.extras
import random, threading, json
import calendar
import time

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
mqttc.on_connect = on_connect
mqttc.on_disconnect = on_disconnect
mqttc.on_publish = on_publish
mqttc.connect(mqtt_broker, int(mqtt_port))
mqttc.subscribe(config.mqtt_fake_topic)


def message(client, userdata, msg):

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

    payloads  = str(msg.payload.decode("utf-8"))
    dic = json.loads(payloads)

    print("Received: " + str(payloads) + " " + "on MQTT Topic: " + str(msg.topic),"\n")

    # Change temperature and humidity

    sql = """SELECT constant_value FROM constant WHERE constant_id = 1"""

    try:
        # Execute the SQL command
        cursor.execute(sql)
        
        result = cursor.fetchone()

        new_value = int(result["constant_value"])

        if (dic["values"]):
            if new_value > 0:
                new_value *= -1
        else:
            if new_value < 0:
                new_value *= -1

        sql = """UPDATE constant SET constant_value = '""" + str(new_value) + """' WHERE constant_id = 1"""

        cursor.execute(sql)
    
    except (Exception, psycopg2.Error) as error :
        print ("1a: ", error)
        # Rollback in case there is any error
        db.rollback()

    # Get current timestamp
    ts = calendar.timegm(time.gmtime())

    # Get recent status

    sql = """SELECT * FROM device_log ORDER BY device_timestamp DESC LIMIT 1 """

    try:
        # Execute the SQL command
        cursor.execute(sql)
        
        result = cursor.fetchone()

        if result is not None:
            if result["device_status"] != dic["values"]:
                sql = """INSERT INTO device_log(device_id, device_status, device_timestamp, device_updated_by) VALUES ('""" + str(dic["device_id"]) + """', '""" + str(dic["values"]) + """', '""" + str(ts) + """', '""" + str(dic['device_updated_by']) + """')"""

                try:
                    # Execute the SQL command
                    cursor.execute(sql)
                    # Commit your changes in the database
                    db.commit()
                except (Exception, psycopg2.Error) as error :
                    print ("2: ", error)
                    # Rollback in case there is any error
                    db.rollback()

                sql = """UPDATE device SET device_status = '""" + str(dic["values"]) + """', device_updated_by = '""" + str(dic["device_updated_by"]) + """' WHERE device_id = '""" + str(dic["device_id"]) + """' """

                try:
                    # Execute the SQL command
                    cursor.execute(sql)
                    # Commit your changes in the database
                    db.commit()
                except (Exception, psycopg2.Error) as error :
                    print ("2a: ", error)
                    # Rollback in case there is any error
                    db.rollback()
        else:
            sql = """INSERT INTO device_log(device_id, device_status, device_timestamp, device_updated_by) VALUES ('""" + str(dic["device_id"]) + """', '""" + str(dic["values"]) + """', '""" + str(ts) + """', '""" + str(dic['device_updated_by']) + """')"""

            try:
                # Execute the SQL command
                cursor.execute(sql)
                # Commit your changes in the database
                db.commit()
            except (Exception, psycopg2.Error) as error :
                print ("2: ", error)
                # Rollback in case there is any error
                db.rollback()

            sql = """UPDATE device SET device_status = '""" + str(dic["values"]) + """', device_updated_by = '""" + str(dic["device_updated_by"]) + """' WHERE device_id = '""" + str(dic["device_id"]) + """' """

            try:
                # Execute the SQL command
                cursor.execute(sql)
                # Commit your changes in the database
                db.commit()
            except (Exception, psycopg2.Error) as error :
                print ("2b: ", error)
                # Rollback in case there is any error
                db.rollback()

    except (Exception, psycopg2.Error) as error :
        print ("1: ", error)
        # Rollback in case there is any error
        db.rollback()

mqtts.callback(message,config.mqtt_fake_topic,hostname=config.mqtt_broker)
