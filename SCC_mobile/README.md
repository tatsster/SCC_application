# SCC_mobile

A Flutter project for SCC which take DB APIs to get/set history data and threshold and subscribe to MQTT server and get data from IOT devices.

## Packages

- flutter_sparkline: ^0.1.0
    - To draw graph line
- flutter_staggered_grid_view: ^0.3.0
    - To display images/blocks continuous that have different size (width or height)
    - Similar display to Unsplash
- font_awesome_flutter: ^8.8.1
    - To use awesome icons
- horizontal_data_table: ^1.0.5+2
    - **Special**: DataTable with fixed first column and header
- intl: ^0.16.1
    - Dateformat for DateTime
- http: ^0.12.1
    - HTTP request
- rxdart: ^0.24.0
    - Obvious for BLOC design


## BLOCs

Number of BLOC and usage:
- DB_bloc: to fetch data from DB
    - 2 Stream to send to DB (in setting page). Helpful guideline in `Login_bloc repo`

- MQTT_bloc: to fetch data from MQTT
    - 2 Stream to get current data from MQTT.