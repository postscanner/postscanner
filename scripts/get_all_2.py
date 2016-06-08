import subprocess as sub
import json
from datetime import datetime
from datetime import date

from mysql_connector import mysql_db
import os

os.umask(0)
logspath = os.path.realpath(__file__ + "/../logs/") + "/"+date.today().strftime('%Y-%B')
print(logspath)
reqlog = open(logspath + "/requestlog.csv", "a")
print(datetime.now().strftime("%Y-%m-%d %H:%M:%S"), ',', ','.join(['"' + a + '"' for a in sys.argv]), file=reqlog)
reqlog.close();