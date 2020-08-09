
from keras.models import Sequential
from keras.layers import Dense
from keras.layers import LSTM
from keras.layers import Bidirectional
from tensorflow import keras


from scipy.signal import medfilt






import matplotlib.pyplot as plt
import pandas as pd
import numpy as np
from sklearn.preprocessing import MinMaxScaler
from sklearn.metrics import mean_squared_error
from sklearn.metrics import r2_score
from numpy import array

# Make our plot a bit formal





# #
# # Set input number of timestamps and training days
# #
n_steps = 7
train_days = 8000  # number of days to train from
n_epochs = 30
n_features=1







# dataset = pd.read_csv('./data_set.csv')
# print(dataset['Temp'])


# dataset['Temp'] = medfilt(dataset['Temp'], 3)
   

# # print(dataset['Temp'])

# train_set = dataset[0:train_days].reset_index(drop=True)
# training_set = train_set.iloc[:,0:1].values

# def data_split(sequence, n_steps):
#     X = []
#     y = []
#     for i in range(len(sequence)):
#         end_ix = i + n_steps
#         if end_ix > len(sequence)-1:
#             break
#         seq_x, seq_y = sequence[i:end_ix], sequence[end_ix]
#         X.append(seq_x)
#         y.append(seq_y)
#     return array(X), array(y)


# X_train, y_train = data_split(training_set, n_steps)

# X_train = X_train.reshape(X_train.shape[0], X_train.shape[1], 1)
# print(X_train.shape[0],X_train.shape[1])



# model = Sequential()
# model.add(LSTM(50, activation='relu', return_sequences=True, input_shape=(X_train.shape[1], 1)))
# model.add(LSTM(50, activation='relu'))
# model.add(Dense(1))




# model.compile(optimizer = 'adam', loss = 'mean_squared_error')
# history = model.fit(X_train, y_train, epochs = n_epochs, batch_size = 32)
# model.save('main_model')




# loss = history.history['loss']
# epochs = range(len(loss))

model=keras.models.load_model('main_model')
predict_weather = array([32,33,34,32,34,33,32,34])
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
        

print(lst_output)





