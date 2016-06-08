import subprocess as sub
import json

from mysql_connector import mysql_db

def get_command(fromCity, toCity, weight):
#return "echo -e \"" + fromCity + "\n" + toCity + "\n" + weight + "\n\""
    return "\"" + fromCity + "\" \"" + toCity + "\" \"" + weight + "\" 2>> log"
def get_prices(command):
#    print(command)
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
    return sorted(prices)

import sys

print(sys.argv, file=sys.stderr)

if len(sys.argv) != 4:
    print("wrong command line")
    sys.exit(1)

fromCity = sys.argv[1]
origCity = sys.argv[2]
weight = sys.argv[3]

from types import *

#if type(fromCity) is UnicodeType:
#fromCity = fromCity.decode("utf-8")
#if type(toCity) is UnicodeType:
#toCity = toCity.decode("utf-8")

prices = []

db = mysql_db()

def prepare_json(prices_list, site_id):
    d = {"site_id":site_id, "low_price":int(prices_list[0]), "high_price":int(prices_list[-1])}
    return json.dumps(d)

response = []

res = db.execute("SELECT * FROM agregators")

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
    prices = get_prices(command)
#    print("123: ", prices)
    try:
        response += [prepare_json(prices, id)]
    except:
        print(id)
        continue
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
