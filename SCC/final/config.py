
# Database

db_host     = "localhost"
db_user     = "user_scc"
db_password = "GgPRFkEL80W6H0Rb"
db_name     = "scc"
db_port     = "5432"

# MQTT information

mqtt_broker = "23.97.54.16"
mqtt_port = 1883
mqtt_topic = "Topic/TempHumi"

mqtt_real_username = "BKvm2"
mqtt_real_password = "Hcmut_CSE_2020"
mqtt_real_broker = "52.187.125.59"
mqtt_real_port = 1883
mqtt_real_topic = "Topic/TempHumi"

# Thread

thread_time = 3

# MQTT fake topic

mqtt_fake_topic = "Air_Conditioner"

### python3 subscribe_real_sensor.py "BKvm" "Hcmut_CSE_2020" "52.230.1.253" "1883" "Topic/TempHumi" "TempHumi"

### python3 publish_real_device.py "BKvm" "Hcmut_CSE_2020" "23.97.54.16" "1883" "Topic/LightD" "[0,0]" Air

### python3 publish_auto_real_device.py "BKvm" "Hcmut_CSE_2020" "23.97.54.16" "1883" "Topic/TempHumi" "Topic/LightD" "255" "16" "30" "AIRC30s" "timestamp" "3.75"

### python3 subscribe_real_device.py "BKvm" "Hcmut_CSE_2020" "23.97.54.16" "1883" "Topic/AirC" "AIRC30s"

### python3 subscribe_real_device.py "BKvm" "Hcmut_CSE_2020" "52.230.1.253" "1883" "Topic/LightD" "AIRCD"