from mysql_connector import *

db = mysql_db()

res = db.execute("SELECT id FROM agregators")

for (id) in res:
    print(id)
