import requests
import sys
import lxml.html
import json

PACKAGE = "1"
PARCEL = "2"

def getCities():
    r = requests.get("http://www.kazpost.kz/calc/")
    elements = lxml.html.fromstring(r.text).xpath("//select[@id='from']/option[@value != '0']")
    cities = { }
    for x in elements:
        cities[x.text.strip('\n\t\r ')] = x.attrib["value"]
    return cities
    
def getWeights(type_send):
    headers = { "Accept": "application/json, text/javascript, */*",
                "Accept-Encoding": "gzip, deflate",
                "X-Requested-With": "XMLHttpRequest"}
    r = requests.get("http://emscal.kazpost.kz/inc/weight.php?kz=1&tsend=" + type_send, headers=headers)
    r = r.text.replace('value', '"value"').replace('text', '"text"').replace("'", '"')
    weights = []
    for weight in json.loads(r):
        val = weight['value'].split('&')
        try:
            weights.append((float(val[-1]), val[0]))
        except:
            weights.append((float('inf'), val[0]))
    weights.sort(key = lambda x: x[0])
    return weights
    
    
def convertPrice(price):
    try:
        return float(price) * 0.19
    except:
        return None

def printPrice(price):
    price = convertPrice(price)
    if price != None and price > 0:
        print(price)
    
    
cities = {'Тараз': '11', 'Талдыкорган': '16', 'Актау': '3', 'Шымкент': '14', 'Костанай': '8', 'Кызылорда': '7', 'Устькаменогорск': '12', 'Павлодар': '9', 'Петропавловск': '10', 'Астана': '1', 'Уральск': '13', 'Караганда': '6', 'Атырау': '5', 'Актюбинск': '2', 'Кокшетау': '15', 'Алматы': '4'}

weights = [(0.0, '0'), (0.15, '1'), (0.3, '2'), (0.5, '3'), (1.0, '4'), (1.5, '5'), (2.0, '6'), (2.5, '7'), (3.0, '8'), (3.5, '9'), (4.0, '10'), (4.5, '11'), (5.0, '12'), (5.5, '13'), (6.0, '14'), (6.5, '15'), (7.0, '16'), (7.5, '17'), (8.0, '18'), (8.5, '19'), (9.0, '20'), (9.5, '21'), (10.0, '22'), (float('inf'), '23')]

countries = { }

originalCityName = sys.argv[1].replace('-', '')
deliveryCityName = sys.argv[2].replace('-', '')
weight = sys.argv[3]

if originalCityName in cities and deliveryCityName in cities:
    payload = { "w": weight,
                "w2":"",
                "from":cities[originalCityName],
                "to":cities[deliveryCityName],
                "v":"1",
                "obcen":"0",
                "obcentenge":"0"
                }

    r = requests.get("http://www.kazpost.kz/calc/cost.php", params=payload)
    r = "".join(filter(lambda x: x.isdigit(), r))
    printPrice(r)
    
    payload = { "w": weight,
                "w2":"",
                "from":cities[originalCityName],
                "to":cities[deliveryCityName],
                "v":"2",
                "obcen":"0",
                "obcentenge":"0"
                }

    r = requests.get("http://www.kazpost.kz/calc/cost.php", params=payload)    
    r = "".join(filter(lambda x: x.isdigit(), r))
    printPrice(r)
    
    try:
        fweight = float(weight)
    except:
        pass
    else:
        ems_weight_ID = list(filter(lambda typle_Weight_ID: typle_Weight_ID[0] >= fweight, weights))[0][1]
        
        if int(ems_weight_ID) < 6:
            payload = {"tsend": "1",
                       "from_city": cities[originalCityName],
                       "to_city": cities[deliveryCityName],
                       "notif": "",
                       "ves": "",
                       "weight": "0.150",
                       "wID": ems_weight_ID}   
            r = requests.post("http://emscal.kazpost.kz/inc/result_kz.php", data = payload)
            r = lxml.html.fromstring(r.text).text_content()
            r = "".join(filter(lambda x: x.isdigit(), r))
            printPrice(r)
        
        payload = {"tsend": "2",
                   "from_city": cities[originalCityName],
                   "to_city": cities[deliveryCityName],
                   "notif": "",
                   "ves": "",
                   "weight": "0.150",
                   "wID": ems_weight_ID}   
        r = requests.post("http://emscal.kazpost.kz/inc/result_kz.php", data = payload)
        r = lxml.html.fromstring(r.text).text_content()
        r = "".join(filter(lambda x: x.isdigit(), r))
        printPrice(r)
        
        payload = {"tsend":"1",
                   "countryID":"1",
                   "czone":"2",
                   "vesm":"",
                   "weightm":"0.150",
                   "wID":"1",
                   "kurs":"150.44"}
                   
        r = requests.post("http://emscal.kazpost.kz/inc/result_m.php", data = payload)
        r = lxml.html.fromstring(r.text).text_content()
        r = "".join(filter(lambda x: x.isdigit(), r))
        printPrice(r)
        
        payload = {"tsend":"1",
                   "countryID":"1",
                   "czone":"2",
                   "vesm":"",
                   "weightm":"0.150",
                   "wID":"1",
                   "kurs":"150.44"}
                   
        r = requests.post("http://emscal.kazpost.kz/inc/result_m.php", data = payload)
        r = lxml.html.fromstring(r.text).text_content()
        r = "".join(filter(lambda x: x.isdigit(), r))
        printPrice(r)
               
    