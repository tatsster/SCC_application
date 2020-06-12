import os
import sys
from os.path import dirname, join

from fbs_runtime.application_context.PyQt5 import ApplicationContext
from PyQt5.QtCore import QUrl
from PyQt5.QtQml import QQmlApplicationEngine
from PyQt5.QtWidgets import QMainWindow

import src

if __name__ == '__main__':
    appctxt = ApplicationContext()

    engine = QQmlApplicationEngine()
    # qmlFile = join(dirname(__file__), 'resources\qml\mainApp.qml')
    # engine.load(QUrl(str(qmlFile)))
    engine.load(QUrl('qrc:/resources/qml/mainApp.qml'))

    exit_code = appctxt.app.exec_()
    sys.exit(exit_code)
