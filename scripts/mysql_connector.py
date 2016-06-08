import MySQLdb

config = {
    'user' : 'agregator',
    'passwd' : '69q193lq0z693k3Q',
    'host' : '127.0.0.1',
    'db' : 'agregator',
}

class mysql_db:
    status = -1
    def __init__(self):
        try: 
            self.db = MySQLdb.connect(**config)
            self.db.set_character_set('utf8')
        except MySQLdb.Error as err:
            self.status = -1
            print(self.db.error())
        else:
            self.status = 0
            self.cursor = self.db.cursor()
            self.cursor.execute('SET NAMES `utf8`')
    def execute(self, query):
        try:
            self.cursor.execute(query)
        except MySQLdb.Error as err:
            print(err)
            print("Error");
        else:
            return self.cursor;

#db = mysql_db()
#res = db.execute("SELECT * FROM agregators")

#for (id, name, url, command, s_f1, s_f2, d_f1, d_f2) in res:
#    print(id, name, url, command, s_f1, s_f2, d_f1, d_f2)



