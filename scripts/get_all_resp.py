import subprocess as sub
import json

from mysql_connector import mysql_db

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
    print(command, file=sys.stderr)
    resp = find_in_base(command)
    if resp != "":
        q.put(resp)
        return
    command = command + " 2>> log"
    p = sub.Popen(command, stdout=sub.PIPE, stderr=sub.PIPE, shell=True)
    output, errors = p.communicate()
    out = output.splitlines()
    prices = []
    for i in out:
        try:
            i = i.decode("utf-8")
            val = float(str(i))
            prices.append(val)
        except:
            continue
#    return sorted(prices)
    q.put(sorted(prices))

import sys

print(sys.argv, file=sys.stderr)

if len(sys.argv) != 6:
    print("wrong command line")
    sys.exit(1)

fromCity = sys.argv[1]
origCity = sys.argv[2]
weight = sys.argv[3]
volume = sys.argv[4]
value = sys.argv[5]

from types import *

#if type(fromCity) is UnicodeType:
#fromCity = fromCity.decode("utf-8")
#if type(toCity) is UnicodeType:
#toCity = toCity.decode("utf-8")

prices = []

db = mysql_db()

def prepare_json(prices_list, site_id):
    d = {"site_id":site_id, "low_price":int(prices_list[0]), "high_price":int(prices_list[-1]), "prices":prices_list}
    return json.dumps(d)

response = []

def get_index(city):
    new_db = mysql_db()
#    q = new_db.execute("SELECT postal_code FROM `postal_codes` WHERE `city_name`='" + city + "' LIMIT 0, 1")
    q = new_db.execute("SELECT pindx17.index FROM `pindx17` WHERE city=\"" + city.upper() + "\" or region=\"" + city.upper() + "\" LIMIT 0, 1")
#    print(q)
    if q == None:
        return "Fail"
    for postal_code in q:
        return str(postal_code[0])


res = db.execute("SELECT * FROM agregators")

#print(get_index("Краснодар"))

import threading, queue

queues = []
threads = []

#print(res)

for (id, name, url, command, s_u, s_e, d_u, d_e) in res:
    from_city = fromCity
    orig_city = origCity
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
        command = command.replace('%fromIndex%', "\"" + get_index(from_city) + "\"")
    if "%toIndex%" in command:
        command = command.replace('%toIndex%', "\"" + get_index(orig_city) + "\"")
    if "%volume%" in command:
        command = command.replace('%volume%', "\"" + volume + "\"")
    if "%value%" in command:
        command = command.replace('%value%', "\"" + value + "\"")
 
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
    q = db1.execute("INSERT INTO responses (command, response) VALUES ('" + command + "', '" + response + "')")
#    print(q)
    db1.db.commit()
    db1.cursor.close()
#    db2.db.close()

for q in queues:
    prices = q[0].get()
#    print(prices, q[1])
    try:
        if type(prices) is str:
            response += [prices]
        else:
            response += [prepare_json(prices, q[1])]
            add_response(q[2], prepare_json(prices, q[1]))
    except:
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
