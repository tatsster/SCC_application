import sys
import numpy as np
import pandas as pd
import pickle
import time
import re
import os
import json
import subprocess
import time
import datetime 
from flask import Flask, request, jsonify
from flask_restful import Resource, Api
from json import dumps
from tensorflow.keras.models import Sequential
from tensorflow.keras.layers import LSTM
from tensorflow.keras.layers import Dense
from tensorflow.keras.layers import Dropout
from tensorflow.keras.layers import Flatten
from numpy import array
from tensorflow import keras


app = Flask(__name__)
api = Api(app)



@app.route('/weather/todays', methods=['POST'])


def post():
    
    os.chdir('weatherCrawl')
    with open('../weatherCrawl/current_data.json', 'w') as outfile:
        outfile.write('')
    subprocess.check_output(['scrapy', 'crawl', 'hcmcurrent', "-o", "current_data.json"])
    with open('../weatherCrawl/current_data.json','rb') as file:
        data=json.load(file)
    
    
    weather ={
                'current time': data[0]['Date'],
                'current temperature':data[0]['Temp'],
                'current humid':data[0]['Humid'][0],
           
            }
   
    os.chdir('..')
    return jsonify(weather)

@app.route('/weather/next_day', methods=['POST'])

def post_predict():
    os.chdir('weatherCrawl')
    count1=1
    n_steps=7
    n_features=1
    count=0
    predict_weather=[]
    data_Temp=[]
    temperature='°'
    with open('../weatherCrawl/data_predict.json', 'w') as outfile:
        outfile.write('')
    with open('../weatherCrawl/humid_predict.json', 'w') as outfile:
        outfile.write('')
    subprocess.check_output(['scrapy', 'crawl', 'hcmspi', "-o", "data_predict.json"])
    subprocess.check_output(['scrapy', 'crawl', 'hcm_humid', "-o", "humid_predict.json"])
    with open('../weatherCrawl/data_predict.json','rb') as file:
        data=json.load(file)
    with open('../weatherCrawl/humid_predict.json','rb') as fileH:
        data_humid=json.load(fileH)    
    os.chdir('..')
    
    for i in range(0,7):
        data_Temp+=data[i]['Temp']
        
    for i in range(0,7):
        res=re.search(r'\d+', data_Temp[i]).group(0)
        predict_weather.append(res)
        
    for i in range(0,len(predict_weather)):
        predict_weather[i]=predict_weather[i].replace(temperature,'')
        predict_weather[i]=int(predict_weather[i])
    predict_weather=predict_weather[::-1]
    
    model=keras.models.load_model('main_model')

    
    x_input = array(predict_weather)
    temp_input=list(x_input)
    lst_output=[]
    i=0
    while(i<7):
        
        if(len(temp_input)>7):
            x_input=array(temp_input[1:])
           
            #print(x_input)
            x_input = x_input.reshape((1, n_steps, n_features))
            #print(x_input)
            yhat = model.predict(x_input, verbose=0)
           
            temp_input.append(yhat[0][0])
            temp_input=temp_input[1:]
            #print(temp_input)
            lst_output.append(yhat[0][0])
            i=i+1
        else:
            x_input = x_input.reshape((1, n_steps, n_features))
            yhat = model.predict(x_input, verbose=0)
            
            temp_input.append(yhat[0][0])
            lst_output.append(yhat[0][0])
            i=i+1
        

    
    pd.Series(lst_output).to_json(orient='values')
    result=lst_output
    weather =[
    ]
    
    for i in range(0,7):
        string=data_humid[i]['Date'][1]+"/2020"
        weather.append({
            'Date': time.mktime(datetime.datetime.strptime(string,"%m/%d/%Y").timetuple()),
            'Temperature': str(lst_output[i]),
            'Humid':data_humid[i]['Humid'][0]
            })
        
    return jsonify(weather)



if __name__ == '__main__':
     app.run(port='5001')
     
