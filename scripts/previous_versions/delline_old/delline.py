import requests
import json
import sys
from datetime import datetime
from datetime import date
from datetime import time

def printResult(price, time, condition):
    print(json.dumps({'price': price, 'time': time, 'condition': condition}))

def getDim(x):
    return float((float(x)**(1/3)))

def getCityCode(city):
    payload = {
        'answerType': 'json',
        'q': city,
        'mode': 'getPlaces'
    }
    headers = { 'Host': 'www.dellin.ru',
                'User-Agent': 'Mozilla/5.0 (Windows NT 6.2; WOW64; rv:33.0) Gecko/20100101 Firefox/33.0',
                'Accept': 'application/json, text/javascript, */*; q=0.01',
                'Accept-Language': 'en-US,en;q=0.5',
                'Accept-Encoding': 'gzip, deflate',
                'DNT': '1',
                'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
                'X-Requested-With': 'XMLHttpRequest',
                'Referer': 'http://www.dellin.ru/requests/?calculate=true&cityName=%D0%9C%D0%BE%D1%81%D0%BA%D0%B2%D0%B0&direction=0&derival_point_code=7700000000000000000000000&derivalPointSuggest=%D0%9C%D0%BE%D1%81%D0%BA%D0%B2%D0%B0&arrival_point_code=7800000000000000000000000&arrivalPointSuggest=%D0%A1%D0%B0%D0%BD%D0%BA%D1%82-%D0%9F%D0%B5%D1%82%D0%B5%D1%80%D0%B1%D1%83%D1%80%D0%B3&sized_weight=1&sized_volume=1',
                'Content-Length': '307',
                'Cookie': 'request_method=GET; _dellin_session=R2N6VWxZR1ZjZERZR1ZaclFqckJFc0E4U29aSXdqaHJkbTZxbnA0ZDdtSFBKTytQSTc3eTVBdVJNQnJSM2RSRjZ4QlZsMlZwQWp4MXB1OFF4eWRxaUtFVHVKZXBOei90cmhYalRuSnRBWEFEVFREOUQ5aUdtWW9JRTRGNzRNWGtnNTZhM1k0OWxBRWRHS0hSV2R4SFk5aVFnSzBTaTZIMGFUZWUxVy9YZEI3RzBWVFFXMllHNzhLRFl4TE1uZHVqLS0rSk02N2M5R2U5Zmx4VUF3cnYwa25nPT0%3D--bfddd3625683a93342c2eae338a3941a95a3118a; __utma=145774241.1376545507.1417476403.1417476403.1417506931.3; __utmc=145774241; __utmz=145774241.1417476403.1.1.utmcsr=yandex|utmccn=(organic)|utmcmd=organic; __utmv=145774241.|1=Member=new=1; uid=0f98a830-35a5-4ed9-95d2-e7fcc4852f6d; sid=D48DF743-BFEC-4A47-A0B2-A7356FAB8770; lat=37.619899; lon=55.753676; sendCity=%7B%22result%22%3A%22ok%22%2C%22city%22%3A%22%u041C%u043E%u0441%u043A%u0432%u0430%22%2C%22terminal%22%3A%22%u041C%u043E%u0441%u043A%u0432%u0430%22%2C%22cityId%22%3A%223%22%2C%22subdomain%22%3A%22%22%7D; defcity=1; autoinvite=1; hide_autoinvites=1; __utmb=145774241.6.9.1417506952100',
                'Connection': 'keep-alive',
                'Pragma': 'no-cache',
                'Cache-Control': 'no-cache' }
    r = requests.post('http://www.dellin.ru/javascripts/index.html', data=payload, headers=headers)
    r = json.loads(r.text);
    return r[0]['code']
    
# def GetTerminalInfo

def getTime(req):
    r = requests.post("http://www.dellin.ru/requests/index.html?mode=getTimeCalculation&answerType=json", data=req)
    if len(r.text) == 0:
        return None
    r = json.loads(r.text)['nextSend']
    return (datetime.strptime(r, '%d.%m.%Y') -  datetime.combine(date.today(), time.min)).days


origCity = sys.argv[1]  
delivCity = sys.argv[2]  
weight = sys.argv[3]  
volume = sys.argv[4]
value = sys.argv[5]


payload = {
    'requestType':'cargo-single',
    'delivery_type':'1',
    'length':getDim(volume),
    'width':getDim(volume),
    'height':getDim(volume),
    'sized_weight':weight,
    'sized_volume':volume,
    'max_length':'',
    'max_width':'',
    'max_height':'',
    'max_weight':'',
    'total_weight':'',
    'oversized_weight':'',
    'total_volume':'',
    'oversized_volume':'',
    'packedUID':'',
    'derival_point':origCity,
    'derival_point_code':getCityCode(origCity),
    'derival_variant':'terminal',
    'derival_terminal_city_code':'',
    'arrival_point':delivCity,
    'arrival_point_code':getCityCode(delivCity),
    'arrival_variant':'terminal',
    'arrival_terminal_city_code':'',
    'produceDate':datetime.now().strftime("%d.%m.%Y"),
    'oversized_weight_avia':'',
    'oversized_volume_avia':'',
    'derival_point_noSendDoor':'0'
}
r = requests.post('http://www.dellin.ru/requests/index.html?mode=getCalculation&answerType=json', data=payload)
# print(r.text)
r = json.loads(r.text)


printResult(
    price=max(map(lambda x: float(r['derival_terminal_price'][x]['price']), r['derival_terminal_price'])) + max(map(lambda x: float(r['arrival_terminal_price'][x]['price']), r['arrival_terminal_price'])) + r['intercity'], 
    time=getTime(payload), 
    condition='От терминала до терминала'
    )
if (r['express']):
    printResult(
        price=max(map(lambda x: float(r['derival_terminal_price'][x]['price']), r['derival_terminal_price'])) + max(map(lambda x: float(r['arrival_terminal_price'][x]['price']), r['arrival_terminal_price'])) + r['express'], 
        time=getTime(payload), 
        condition='Экспресс от терминала до терминала'
        )
if (r['avia']):
    printResult(
        price=max(map(lambda x: float(r['derival_terminal_price'][x]['price']), r['derival_terminal_price'])) + max(map(lambda x: float(r['arrival_terminal_price'][x]['price']), r['arrival_terminal_price'])) + r['avia'], 
        time=getTime(payload), 
        condition='Авиа от терминала до терминала'
        )
if (r['small']):
    printResult(
        price=r['small'], 
        time=getTime(payload), 
        condition='От двери до двери. Специальный тариф для маленьких посылок.'
        )
    
# print(r['arrivalToDoor'])
