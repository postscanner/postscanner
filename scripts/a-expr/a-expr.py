import requests
from html.parser import HTMLParser
import xml.etree.ElementTree as ET
import sys
import json

url = 'http://a-express.ru/ajax/calc/calc'

uri = 'http://a-express.ru/ajax/calc/getform'
r = requests.post(uri)

class MyHTMLParser(HTMLParser):
    s = 1
    Dict = {}
    def handle_starttag(self, tag, attrs):
        if tag == 'option':
            t = attrs
            self.s = int(t[0][1])
    def handle_data(self, data):
        global s
        if data.find(',') != -1:
            if data[0:data.find(',')] !='Корея':
                if data[0:data.find(',')] !='Конго':
                    self.Dict[data[0:data.find(',')]] = self.s


parser = MyHTMLParser()

parser.feed(r.text)


def getDim(x):
    return int((float(x)**(1/3)) * 100)

#print("Original city:")
#originalCityName = input()
originalCityName = sys.argv[1]
#print("Delivery city:")
#deliveryCityName = input()
deliviryCityName = sys.argv[2]
#print("Weight")
#weight = input()
weight = sys.argv[3]
volume = sys.argv[4]

if deliviryCityName == 'Москва':
    originalCityName, deliviryCityName = deliviryCityName, originalCityName
#print(getDim(volume))
payload = { "receivercountry" : 0,
            "receivercity" : parser.Dict[deliviryCityName],
            "weight" : weight,
            "x" : getDim(volume),
            "y" : getDim(volume),
            "z" : getDim(volume)
          }

r = requests.post(url, data = payload);

root = ET.fromstring(r.text)

# print(r.text)
price = root.findall(".//strong")
# print(len(price))
s = price[0].text
s = s.replace(' ','')
deliv = price[1].text.split()[0]

print(json.dumps({ "price": float(s),
                    "time": deliv,
                    }))
