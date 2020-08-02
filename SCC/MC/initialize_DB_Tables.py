import sqlite3
# SQLite DB Name
DB_Name =  "IoT.db"
# SQLite DB Table Schema
TableSchema="""
drop table if exists Temperature_Data ;
create table Temperature_Data (
  id integer primary key autoincrement,
  SensorID text,
  Date_n_Time text,
  Temperature text
);

drop table if exists Humidity_Data ;
create table Humidity_Data (
  id integer primary key autoincrement,
  SensorID text,
  Date_n_Time text,
  Humidity text
);

drop table if exists Control_Data ;
create table Control_Data (
  id integer primary key autoincrement,
  Date_n_Time text,
  Status text
);
"""
#Connect or Create DB File
conn = sqlite3.connect(DB_Name)
curs = conn.cursor()
#Create Tables
sqlite3.complete_statement(TableSchema)
curs.executescript(TableSchema)
#Close DB
curs.close()
conn.close()