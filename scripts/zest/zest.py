import requests
import sys
import lxml.html
import html
import json

def getDim(x):
    return int(float(x)**(1/3))
    
def fetchResult(r):
    r = lxml.html.fromstring(r.text)
    r = r.xpath('//td/div[@class="feed_inp"]/p[contains(text(), "Стоимость")]')
    r = lxml.html.tostring(r[0]).decode('windows-1251')
    return r.split()[-2]
    
def fetchCityName(city):
    r = requests.get('http://www.zest.ru/orders/request.php?s=' + city +'&type=3&resedit=town&resultbar=townbar');
    r = lxml.html.fromstring('<html>' + r.text + '</html>');
    r = r.xpath('//div')[0]
    return r.text

origCity = sys.argv[1]
delivCity = sys.argv[2]
weight = sys.argv[3]
volume = sys.argv[4]
headers = { }
payload = {
    'town2': fetchCityName(origCity).encode('windows-1251'),
    'town': fetchCityName(delivCity).encode('windows-1251'),
    'mode': '1',
    'mass': weight,
    'l': getDim(volume),
    'w': getDim(volume),
    'h': getDim(volume),
    'Package': '0',
}
try:
	r = requests.post('http://www.zest.ru/orders/calc.php', data=payload, headers=headers)
	print(json.dumps({ "price": fetchResult(r),
						"condition": "Обычная доставка"
					 }))
	payload["mode"] = "2"
	r = requests.post('http://www.zest.ru/orders/calc.php', data=payload, headers=headers)
	print(json.dumps({ "price": fetchResult(r),
						"condition": "Срочная доставка"
					 }))
except:
	pass