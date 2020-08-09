import json
import paho.mqtt.subscribe as mqtt
import paho.mqtt.client as mqttc
from store_Sensor_data import sensor_Data_Handler
import numpy as np
from sklearn.model_selection import train_test_split
from sklearn.linear_model import LinearRegression
from datetime import datetime
client = mqttc.Client("P2")
client.connect("23.97.54.16")
client.subscribe("Home/Control")
xa=[]
predict=[0]
def message(client, userdata, msg):
    p  = str(msg.payload.decode("utf-8"))   #HERE!
    k = json.loads(p)
    humid=k["Humidity"]
    xa.append(humid)
    if len(xa) == 10:
        x = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
        return_value = humid_predict(x, xa)
        print(return_value[0][0])
        predict.append(return_value[0][0])
        xa.clear()
    if predict[0] > 80:
        if humid>= 80:
            Control_Data = {}
            Control_Data['Date'] = (datetime.today()).strftime("%d-%b-%Y %H:%M:%S:%f")
            Control_Data['Status'] = "HUMID-OFF"
            Control_json_data = json.dumps(Control_Data)
            client.publish("Home/Control", Control_json_data)
    sensor_Data_Handler(msg.topic, msg.payload)
def humid_predict(x,y):
    x=np.array(x)
    y=np.array(y)
    #Split the data into train and test dataset
    x_train,x_test,y_train,y_test=train_test_split(x.reshape(-1,1),y.reshape(-1,1),test_size=1/3,random_state=42)
    #Fitting Simple Linear regression data model to train data set
    regressorObject=LinearRegression()
    regressorObject.fit(x_train,y_train)
    #predict the test set
    y_pred_test_data=regressorObject.predict(x_test)
    a=regressorObject.predict([[11]])
    return a
    
mqtt.callback(message,"Home/Humidity",hostname="23.97.54.16")