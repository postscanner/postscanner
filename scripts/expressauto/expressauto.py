import requests
import json
import sys

def getOrigCityId(name):
    list = {
        "Березники" : "3",
        "Екатеринбург" : "1",
        "Ижевск" : "4",
        "Казань" : "5",
        "Курган" : "6",
        "Магнитогорск" : "7",
        "Миасс" : "8",
        "Москва" : "2",
        "Набережные Челны" : "9",
        "Нефтеюганск" : "10",
        "Нижневартовск" : "11",
        "Нижний Новгород" : "12",
        "Нижний Тагил" : "13",
        "Новосибирск" : "14",
        "Новый Уренгой" : "15",
        "Ноябрьск" : "16",
        "Омск" : "17",
        "Оренбург" : "18",
        "Орск" : "19",
        "Пермь" : "20",
        "Самара" : "21",
        "Санкт-Петербург" : "22",
        "Сургут" : "23",
        "Тюмень" : "24",
        "Уфа" : "25",
        "Ханты-Мансийск" : "26",
        "Челябинск" : "27"
    }

    return list[name]

def getDelivCityId(name):
    list = {
        "Барнаул" : "28",
        "Березники" : "3",
        "Воткинск" : "29",
        "Екатеринбург" : "1",
        "Златоуст" : "30",
        "Ижевск" : "4",
        "Казань" : "5",
        "Каменск-Уральский" : "105",
        "Когалым" : "32",
        "Курган" : "6",
        "Магнитогорск" : "7",
        "Миасс" : "8",
        "Москва" : "2",
        "Набережные Челны" : "9",
        "Нефтеюганск" : "10",
        "Нижневартовск" : "11",
        "Нижний Новгород" : "12",
        "Нижний Тагил" : "13",
        "Новосибирск" : "14",
        "Новый Уренгой" : "15",
        "Ноябрьск" : "16",
        "Нягань" : "33",
        "Омск" : "17",
        "Оренбург" : "18",
        "Орск" : "19",
        "Пермь" : "20",
        "Салават" : "34",
        "Самара" : "21",
        "Санкт-Петербург" : "22",
        "Сарапул" : "35",
        "Соликамск" : "36",
        "Стерлитамак" : "37",
        "Сургут" : "23",
        "Тобольск" : "38",
        "Тольятти" : "39",
        "Тюмень" : "24",
        "Уфа" : "25",
        "Ханты-Мансийск" : "26",
        "Чайковский" : "40",
        "Челябинск" : "27"
    }
    return list[name]

origName = sys.argv[1]
delivName = sys.argv[2]
weight = sys.argv[3]
volume = sys.argv[4]

try:
    idOrig = getOrigCityId(origName)
    idDeliv = getDelivCityId(delivName)
except:
    print("wrong")
    sys.exit(0)

lst = "act=getPrice&cfId=" + str(idOrig) + "&ctId=" + str(idDeliv) + "&weight=" + weight + "&volume=" + volume
headers = { "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
             "X-Requested-With": "XMLHttpRequest"}
#headers = {"" : "application/x-www-form-urlencoded"}

r = requests.post("http://expressauto.ru/ajax", data = lst, headers = headers)

#print(r.headers)  
print(json.dumps({ "price": r.text,
    "time": None,
    "condition": None,
    }))

#print(lst)
