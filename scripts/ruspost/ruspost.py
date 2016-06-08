import requests
import sys
import lxml.html
import urllib
import json

def parsePrices(text, toMoscow):
    doc = lxml.html.fromstring(text)
    prices = doc.xpath('//table[@class="total_table"]/tr/td[h3="ИТОГО"]/p[@class="total_price"]')
    delivs = doc.xpath('//table[@class="total_table"]/tr/td/p[contains(text(), "срок")]')
    for i in range(0, len(prices)):
        price = prices[i]
        deliv = delivs[i].text[5:].replace(' - ', '-').split()[0]
        if price.text.find('рублей') >= 0:
            try:
                price = price.text.replace(',', '.')
                cost = float("".join(filter(lambda x: x.isdigit() or x == '.', price)))
                if toMoscow:
                    cost *= 1.2        
                print(json.dumps({ "price": cost,
                    "time": deliv,
                    "condition": None,
                    }))
            except:
                print(sys.exc_info(), file=sys.stderr)
    
def getCities():
    r = requests.get("http://www.rus-post.com/calc/")
    options = lxml.html.fromstring(r.text).xpath("//select[@name='city']/option")
    cities = { }
    for city in options:
        cities[city.text] = city.attrib["value"]
    return cities

def getDim(x):
    return (float(x)**(1/3)*100)

originalCityName = sys.argv[1]
deliveryCityName = sys.argv[2]
weight = sys.argv[3]
volume = sys.argv[4]
toMoscow = False

if deliveryCityName == 'Москва':
    originalCityName, deliveryCityName = deliveryCityName, originalCityName
    toMoscow = True

if originalCityName != 'Москва':
    exit()

cities = {'Южно-Сахалинск': '115', 'Ульяновск': '88', 'Липецк': '35', 'Камчатская обл.': '114', 'Сыктывкар': '78', 'Красноярск': '32', 'Барнаул': '4', 'Рязань': '67', 'Санкт-Петербург': '18', 'Саратов': '71', 'Тюмень': '86', 'Сочи': '74', 'Калуга': '26', 'Нижний Новгород': '47', 'Владимир': '12', 'Калининград': '25', 'Наб. Челны': '43', 'Чебоксары': '94', 'Магаданская обл.': '118', 'Новокузнецк': '50', 'Читинская обл.': '122', 'Тверь': '81', 'Псков': '64', 'Ярославль': '102', 'Новый Уренгой': '53', 'Тамбов': '80', 'Мурманск': '42', 'Белгород': '5', 'Орел': '56', 'Архангельск': '2', 'Тула': '85', 'Ставрополь': '75', 'Вологодская обл.': '112', 'Кострома': '30', 'Новгород': '49', 'Йошкар-Ола': '23', 'Саранск': '70', 'Чита': '121', 'Петропавловск-Камчатск': '113', 'Иркутск': '22', 'Краснодар': '31', 'Волгоград': '13', 'Пенза': '60', 'Махачкала': '39', 'Ростов-на-Дону': '66', 'Улан-Удэ': '87', 'Новосибирск': '52', 'Оренбург': '57', 'Смоленск': '73', 'Иваново': '20', 'Томск': '83', 'Киров': '28', 'Астрахань': '3', 'Екатеринбург': '18', 'Воронеж': '16', 'Норильск': '120', 'Чукотский АО': '111', 'Пермь': '61', 'Новороссийск': '51', 'Петрозаводск': '62', 'Вологда': '14', 'Омск': '59', 'Челябинск': '95', 'Казань': '19', 'Якутск': '101', 'Уфа': '90', 'Курск': '34', 'Анадырь': '110', 'Тольятти': '82', 'Магадан': '117', 'Брянск': '9', 'Самара': '69', 'Нижневартовск': '48', 'Мурманская обл.': '119', 'Сургут': '76', 'Владивосток': '10', 'Москва': '199', 'Череповец': '96', 'Хабаровск': '92', 'Кемерово': '27', 'Нальчик': '45', 'Сахалинская обл.': '116', 'Ижевск': '21', 'Владикавказ': '11'}
    
    
headers = {"Host": "www.rus-post.com",
"Accept": "text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8",
"Accept-Language": "ru-RU,ru;q=0.8,en-US;q=0.5,en;q=0.3",
"Accept-Encoding": "gzip, deflate",
"DNT": "1",
"Referer": "http://www.rus-post.com/calc/",
"Cookie": "PHPSESSID=51a7bfe5fe87b02a6517e8a7038dc1ef",
"Content-Type": "application/x-www-form-urlencoded",
"Connection": "keep-alive" }
try:
	payload = {"out_city":"msk",
			   "city":cities[deliveryCityName],
			   "wght":weight,
			   "volume_l":str(getDim(volume)),
			   "volume_h":str(getDim(volume)),
			   "volume_w":str(getDim(volume)),}
			   
	r = requests.post("http://www.rus-post.com/calc/", data=payload, headers=headers)
	parsePrices(r.text, toMoscow)
except:
	pass
