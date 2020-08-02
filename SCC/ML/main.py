import loadForecast as fc
import pandas as pd

df = pd.read_csv('load_test.csv')
all_X = fc.makeUsefulDf(df)
all_y = df['load']
predictions, accuracy = fc.neural_net_predictions(all_X, all_y)