import requests
import json
import sys

def getCityId(city):
    data = "Action=GetLocationList&city=" + city
    r = requests.post("http://www.edostavka.ru/ajax.php?JsHttpRequest=0-xml", data=data.encode('utf-8'))
    js = json.loads(r.text)
    for x in js["js"]["Content"]["geonames"]:
        if x['name'] == city:
            return x['id']

def getDim(x):
    return int((float(x)**(1/3)) * 100)

originalCityName = sys.argv[1]
deliveryCityName = sys.argv[2]
weight = sys.argv[3]
volume = sys.argv[4]
try:
	originalCity = getCityId(originalCityName)
	deliveryCity = getCityId(deliveryCityName)
	lst = 'Action=GetTarifList&FromCity=' + originalCity + '&ToCity=' + deliveryCity + '&Package[0][weight]=' + weight + '&Package[0][length]=' + str(getDim(volume)) + '&Package[0][width]=' + str(getDim(volume)) + '&Package[0][height]=' + str(getDim(volume)) + '&Package[0][description]=1&idInterface=3'
	r = requests.post('http://www.edostavka.ru/ajax.php?JsHttpRequest=0-xml', data = lst)
	js = json.loads(r.text)
	for item in js['js']['Content']['result']:
		if len(item['price']) > 0:
			deliv = item['periodMin'] + '-' + item['periodMax']
			print(json.dumps({ "price": item['price'],
						"time": deliv,
						"condition": item['serviceDescription'],
						}))
except:
	pass						
