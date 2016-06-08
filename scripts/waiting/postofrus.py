import requests
from html.parser import HTMLParser
import sys

url = 'http://www.russianpost.ru/autotarif/Autotarif.aspx'

#print("Weight:")
#weight = input()
weight = sys.argv[3]
weight = int(weight)
weight = weight*1000
weight = str(weight)

#print("input postCode ") #индекс
postCode = sys.argv[4]
payload = {
            "viewPost": 26,
            "countryCode":643,
            "typePost":1, #это тип посылки: Наземный, Авиа, комбинированный и т.п.
            "viewPostName": 'Ценная бандероль',
            "countryCodeName": 'Российская Федерация',
            "typePostName": 'НАЗЕМН.',
            "weight": weight,
            "value1": 500,
            "postOfficeId":postCode,
            }

r = requests.get(url, params = payload)


class MyHTMLParser(HTMLParser):
    s = 0
    def handle_starttag(self, tag, attrs):
        if tag == 'span':
            if attrs[0][1] == 'TarifValue':
                self.s = 1

    def handle_data(self, data):
        if self.s == 1:
            data = data.replace(",",".")
            print(float(data))
            self.s = 0

parser = MyHTMLParser()
parser.feed(r.text)