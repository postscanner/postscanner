import requests
import json
import urllib
import sys

def parsePrices(text):
    prices = json.loads(text)['result']
    for x in prices:
        print(json.dumps({ "price": x['rawPrice'],
                            "time": x['deliveryTime'],
                            "condition": x["typeLabel"] + " " + x['deliveryTime'],
                            }))
    
def getCity(name):
	headers = {'Accept': 'application/json, text/javascript, */*; q=0.01',
               "X-Requested-With": "XMLHttpRequest",
               'Cookie': 'region=55d4bdeb6d4586d63bd0881e044c4bf8305df725%7Emoscow; PHPSESSID=cdqi0gu61vgivrph7d3bmapec4',
               "User-Agent": 'Mozilla/5.0 (Windows NT 6.2; WOW64; rv:29.0) Gecko/20100101 Firefox/29.0'}
	data = {"content": name,
            "country": "Россия",
            "limit": "10"}
	data = urllib.parse.urlencode(data)
	r = requests.get("http://www.express.ru/calculate/get_city_list?" + data, headers=headers)
	print(r)
	r = json.loads(r.text)
	return r['response'][0]['title']


cargo_types = { "Груз": "2", "Негабаритный груз": "1" }

def getDim(x):
    return int((float(x)**(1/3)) * 100)
def getVolumeWeight(x):
    return int(float(x) * (100 ** 3) / 6000)

originalCityName = sys.argv[1]
deliveryCityName = sys.argv[2]
weight = sys.argv[3]
volume = sys.argv[4]


originalCity = getCity(originalCityName)
deliveryCity = getCity(deliveryCityName)

def getPrices(cargo_type):
	headers = { "User-Agent": 'Mozilla/5.0 (Windows NT 6.2; WOW64; rv:29.0) Gecko/20100101 Firefox/29.0',
	'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
	'X-Requested-With': 'XMLHttpRequest',
	'Cookie': 'region=55d4bdeb6d4586d63bd0881e044c4bf8305df725%7Emoscow; PHPSESSID=cdqi0gu61vgivrph7d3bmapec4'} #что за region? какая разница? но эта фигня нужна
	data = {"country_from": "Россия",
			"place_from": originalCity,
			"country_to": "Россия",
			"place_to": deliveryCity,
			"cargo_type":  cargo_types[cargo_type],
			"weight": weight,
			"items": "1",
			"cargo_form":  cargo_types[cargo_type],
			"box_length": str(getDim(volume)),
			"box_width": str(getDim(volume)),
			"box_height": str(getDim(volume)),
			"rulon_radius": "",
			"rulon_length": "",
			"tubus_length": "",
			"tubus_side_a": "",
			"tubus_side_b": "",
			"tubus_side_c": "",
			"volume_weight": str(getVolumeWeight(volume)),
			"volume_weight_place": str(getVolumeWeight(volume))}
	data = urllib.parse.urlencode(data)
	try:
		r = requests.post("http://www.express.ru/calculate/calculate", data = data.encode('utf-8'), headers=headers)
		parsePrices(r.text)
	except:
		pass
	
for x in cargo_types:
	getPrices(x)
	