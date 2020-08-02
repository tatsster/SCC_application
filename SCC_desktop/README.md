# SCC_Desktop_Application

## Prerequisites

* python 3.6.8
* PyQt5
```sh
pip install pyqt5
```
* fbs
```sh
pip install fbs
```

**_Notes:_** _fbs does not run with python > 3.6_


## Run and Build

Change `current_host` in `src/main/python/scc.py` to the host of the api provider.

* Run the code
```sh
fbs run
```

* Build the code
```sh
fbs freeze
```