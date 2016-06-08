import subprocess as sub
import json
from datetime import datetime
from datetime import date

from mysql_connector import mysql_db
import os

os.umask(0)
logspath = os.path.realpath(__file__ + "/../logs/") +"/"+date.today().strftime('%Y-%B')
if not os.path.isdir(logspath):
    os.makedirs(logspath)


timediag = open(logspath + "/timediag.csv", "a")

def get_command(fromCity, toCity, weight):
#return "echo -e \"" + fromCity + "\n" + toCity + "\n" + weight + "\n\""
    return "\"" + fromCity + "\" \"" + toCity + "\" \"" + weight + "\" 2>> log"

def find_in_base(command):
    new_db = mysql_db()
    q = new_db.execute("SELECT response FROM responses WHERE command='" + command + "' AND CURRENT_TIMESTAMP - `responses`.`date` <= 86400")
    if q == None:
        return ""
    else:
        response = ""
        for (resp) in q:
            response += resp[0]
        return response

def get_prices(command, q):
    resp = find_in_base(command)
    if resp != "":
        q.put(resp)
        return
    start = datetime.now()
    command = command + " 2>> " + logspath + "/log"
    p = sub.Popen(command, stdout=sub.PIPE, stderr=sub.PIPE, shell=True)
    output, errors = p.communicate()
    out = output.splitlines()
    delivery_cases = []
    for i in out:
        try:
            i = json.loads(i.decode("utf-8"))
            delivery_cases.append(i)
        except:
            print(sys.exc_info(), file=sys.stderr)
            continue
    print(command, delivery_cases, file=sys.stderr)
#    return sorted(delivery_cases)
    q.put(sorted(delivery_cases, key=lambda k: k["price"]))
    print(datetime.now().strftime("%Y-%m-%d %H:%M:%S"), ",", '{0:10f}'.format((datetime.now() - start).total_seconds()), ",", command, file=timediag)

import sys


reqlog = open(logspath + "/requestlog.csv", "a")
print(datetime.now().strftime("%Y-%m-%d %H:%M:%S"), ',', ','.join(['"' + a + '"' for a in sys.argv]), file=reqlog)
reqlog.close();
#отладочные строки. однажды тут был косяк с кодировкой
# print(sys.argv, file=sys.stderr)
# print(type(sys.argv[1]), file=sys.stderr)
# #print(sys.argv[1])
# import locale
# print(locale.getpreferredencoding(), file=sys.stderr)
# print(sys.argv[1].decode('ANSI_X3.4-1968'), file=sys.stderr)
# print(sys.argv[1].encode('utf-8'), file=sys.stderr);
# exit();
if len(sys.argv) != 10:
    print("wrong command line")
    sys.exit(1)

fromCity = sys.argv[1]
origCity = sys.argv[2]
weight = sys.argv[3]
volume = sys.argv[4]
value = sys.argv[5]
orgId = sys.argv[6]
height = sys.argv[7]
width = sys.argv[8]
length = sys.argv[9]
fromCity = fromCity.split(',') + ['']
fromReg = fromCity[1].replace(' обл.', ' область').strip() if len(fromCity[1]) > 0 else None
fromCity = fromCity[0]

origCity = origCity.split(',') + ['']
origReg = origCity[1].replace(' обл.', ' область').strip() if len(origCity[1]) > 0 else None
origCity = origCity[0]
#origCity = origCity.replace(' обл.', '')

from types import *

#if type(fromCity) is UnicodeType:
#fromCity = fromCity.decode("utf-8")
#if type(toCity) is UnicodeType:
#toCity = toCity.decode("utf-8")

prices = []

db = mysql_db()

def prepare_json(cases_list, site_id):
    # print(site_id, cases_list, file=sys.stderr)
    prices_list = list(map(lambda k: k.get("price", None), cases_list))
    delivery_times = list(map(lambda k: k.get("time", None), cases_list))
    conditions = list(map(lambda k: k.get("condition", None), cases_list))
    d = {"site_id":site_id, "low_price":float(prices_list[0]), "high_price":float(prices_list[-1]), "prices":prices_list, "times":delivery_times, "conditions" : conditions}
    return json.dumps(d)

response = []

def get_index(city, reg):
    new_db = mysql_db()
#    q = new_db.execute("SELECT postal_code FROM `postal_codes` WHERE `city_name`='" + city + "' LIMIT 0, 1")
    if reg == None:
        q = new_db.execute("SELECT pindx17.index FROM `pindx17` WHERE city=\"" + city.upper() + "\" or region=\"" + city.upper() + "\" LIMIT 0, 1")
    else:
        q = new_db.execute("SELECT pindx17.index FROM `pindx17` WHERE city=\"" + city.upper() + "\" and region=\"" + reg.upper() + "\" LIMIT 0, 1")
#    print(q)
    if q == None:
        return "Fail"
    for postal_code in q:
        return str(postal_code[0])


res = db.execute("SELECT * FROM agregators where active=1 and id="+orgId)  

#print(get_index("Краснодар"))

import threading, queue

queues = []
threads = []

#print(res)
for (id, name, url, command, s_u, s_e, d_u, d_e, active, calc) in res:
    from_city = fromCity + (', ' + fromReg.replace(' область', '') if fromReg != None else "")
    orig_city = origCity + (', ' + origReg.replace(' область', '') if origReg != None else "")
    if s_e:
        from_city = get_english(from_city)
    if s_u:
        from_city = from_city.upper()
    if d_e:
        orig_city = get_english(orig_city)
    if d_u:
        orig_city = orig_city.upper()
#    print(command)
    command = command.replace('%fromCity%', "\"" + from_city + "\"")
    command = command.replace('%toCity%', "\"" + orig_city + "\"")
    command = command.replace('%weight%', "\"" + weight + "\"")
    if "%fromIndex%" in command:
        command = command.replace('%fromIndex%', "\"" + get_index(fromCity, fromReg) + "\"")
    if "%toIndex%" in command:
        command = command.replace('%toIndex%', "\"" + get_index(origCity, origReg) + "\"")
    if "%volume%" in command:
        command = command.replace('%volume%', "\"" + volume + "\"")
    if "%value%" in command:
        command = command.replace('%value%', "\"" + value + "\"")
    if "%height%" in command:
        command = command.replace('%height%', "\"" + height + "\"")
    if "%width%" in command:
        command = command.replace('%width%', "\"" + width + "\"")
    if "%length%" in command:
        command = command.replace('%length%', "\"" + length + "\"")
        
    q = queue.Queue()
    threads.append(threading.Thread(target=get_prices, args=(command, q)))
    queues.append((q, id, command))

for th in threads:
    th.start()

for th in threads:
#    print("Here")
    th.join()
def add_response(command, response):
#    print(command, response)
    db1 = mysql_db()
    q = db1.execute("DELETE FROM responses WHERE command='" + command + "'")
#    print(q)
#    db1.cursor.close()
#    db1.db.close()
#    db2 = mysql_db()
    q = db1.execute("INSERT INTO responses (command, response) VALUES ('" + command + "', '" + response.replace('\\', '\\\\') + "')")
    #oh my god, this is awful!!!
#    print(q)
    db1.db.commit()
    db1.cursor.close()
#    db2.db.close()

#print("\n\n\n\n")
for q in queues:
    prices = q[0].get()
#    print(prices, q[1])
    try:
        if type(prices) is str:
            response += [prices]
        else:
            # print(q[1], prices, file=sys.stderr)
            resp = prepare_json(prices, q[1])
            response += [resp]
            add_response(q[2], resp)
    except:
        print('exception!', prices, q[2], sys.exc_info(), file=sys.stderr)
        continue
#prices = q.get()
#print(prices)

#    prices = get_prices(command)
#    print("123: ", prices)
#    try:
#        response += [prepare_json(prices, id)]
#    except:
#        print(id)
#        continue
#    print(command)
#print(response)
        

#id = 1
#for i in prices:
#    try:
#        response += [prepare_json(i, id)]
#    except:
#        continue
#    id += 1
print(json.dumps(response))
