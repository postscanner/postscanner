import json
import requests
import sys

url = 'http://www.ponyexpress.ru/tracking/rate'

#print(sys.argv, file=sys.stderr)

#print("Original city:")
#originalCityName = input()
originalCityName = sys.argv[1]
#print("Deliviry city:")
#deliviryCityName = input()
deliviryCityName = sys.argv[2]
#print("Weight")
#weight = input()
weight = sys.argv[3]

payload = { "excel":"0",
            "data[0][service]":1,
            "data[0][service]":2,
            "data[0][service]":3,
            "data[0][service]":4,
            "data[0][service]":5,
            "data[0][service]":6,
            "data[0][service]":7,
            "data[0][from]":originalCityName, 
            "data[0][to]":deliviryCityName, 
            "data[0][weight]":weight,
            "data[0][go]":0,
            "data[0][og]":0,
            "data[0][service_count]":6,
            }
try:
	r = requests.post(url, data=payload)
	try:
		r = json.loads(r.text)["tariffall"]
	except:
		r = json.loads(r.text[3:])["tariffall"]
	if not (type(r) is list):
		r = [r]
	for x in r:
		print(json.dumps({ "price": x["tariffvat"],
							"time": x["delivery"].replace(' ', ''),
							"condition": x["servise"] + (", разместить заказ до " + x["orderdt"] if x["orderdt"] else "") + (", передать груз до " + x["cargodt"] if x["cargodt"] else "")
							}))
except:
	pass
