import requests
import lxml.html
import sys
import json
import urllib

def getCity(name):
    jsonPayload = '{"prefixText":"' + name + '","count":"20","contextKey":"City"}'
    headers = {'Content-Type': "application/json; charset=utf-8"}
    r = requests.post("http://clients.cityexpress.ru/Customers/GEstAutoComplete.asmx/GetCompletionList", data=jsonPayload.encode('utf-8'), headers=headers)
    r = json.loads(r.text)
    r = json.loads(r['d'][0])
    return {"name": r['First'], "id": r['Second']}
    


headers = { "Host": "clients.cityexpress.ru",
"User-Agent": "Mozilla/5.0 (Windows NT 6.2; WOW64; rv:29.0) Gecko/20100101 Firefox/29.0",
"Accept": "text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8",
"Accept-Language": "ru-RU,ru;q=0.8,en-US;q=0.5,en;q=0.3",
"Accept-Encoding": "gzip, deflate",
"DNT": "1",
"X-Requested-With": "XMLHttpRequest",
"X-MicrosoftAjax": "Delta=true",
"Content-Type": "application/x-www-form-urlencoded; charset=utf-8",
"Referer": "http://clients.cityexpress.ru/Customers/Calc.aspx",
"Connection": "keep-alive" }

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

calc_form = lxml.html.fromstring(requests.get("http://clients.cityexpress.ru/Customers/Calc.aspx").text).forms[0]
calc_form.fields['ctl00$Content$cityFrom'] = originalCity["name"]
calc_form.fields['ctl00$Content$cityFromValue'] = originalCity["id"]
calc_form.fields['ctl00$Content$DispatchTypeComboBox'] = 'Документы'
calc_form.fields['ctl00$Content$cityTo'] = deliveryCity["name"]
calc_form.fields['ctl00$Content$cityToValue'] = deliveryCity["id"]
calc_form.fields['ctl00$Content$quantity'] = "1"
calc_form.fields["ctl00$Content$length"] = str(getDim(volume))
calc_form.fields["ctl00$Content$width"] = str(getDim(volume))
calc_form.fields["ctl00$Content$height"] = str(getDim(volume))
calc_form.fields["ctl00$Content$volumeWeight"] = str(getVolumeWeight(volume))
calc_form.fields["ctl00$Content$weight"] = weight
lst = calc_form.form_values()
lst.append(("__ASYNCPOST","true"))
lst.append(("hiddenInputToUpdateATBuffer_CommonToolkitScripts","1"))
lst.append(("ctl00$Content$CalculateButton", "Рассчитать стоимость"))
lst.append(("ctl00$Content$ScriptManager", "ctl00$Content$UpdatePanel|ctl00$Content$CalculateButton"))
data = urllib.parse.urlencode(lst)

try:
    r = requests.post("http://clients.cityexpress.ru/Customers/Calc.aspx", data=data.encode('utf-8'), headers=headers)
    for x in lxml.html.fromstring(r.text).xpath("//span[@id='Span4']"):
        price = x.text.replace(',', '.')
        if len(price) > 0 and int(price) > 0:
            print(price)
except:
    pass        
        

calc_form.fields['ctl00$Content$DispatchTypeComboBox'] = 'Товары'
lst = calc_form.form_values()
lst.append(("__ASYNCPOST","true"))
lst.append(("hiddenInputToUpdateATBuffer_CommonToolkitScripts","1"))
lst.append(("ctl00$Content$CalculateButton", "Рассчитать стоимость"))
lst.append(("ctl00$Content$ScriptManager", "ctl00$Content$UpdatePanel|ctl00$Content$CalculateButton"))

r = requests.post("http://clients.cityexpress.ru/Customers/Calc.aspx", data=data.encode('utf-8'), headers=headers)
r = lxml.html.fromstring(r.text);
prices = r.xpath('//*[@class="inform-table"]//tr//span[@id="Span4"]')
times = r.xpath('//*[@class="inform-table"]//tr//span[@id="Span5"]')
condition = r.xpath('//*[@class="inform-table"]//tr//span[@id="Span1"]')
for i in range(0, len(prices)):
    print(json.dumps({ "price": prices[i].text.replace(',', '.'),
                        "time": times[i].text.split()[0],
                        "condition": condition[i].text.strip(),
                        }))
    # price = x.xpath('//td[@id=Span4]')[0].text.replace(',', '.')
    # deliv = x.xpath('/td[@id="Span5"]')[0].text.split()[0]
    # if len(price) > 0:
        # print(price + " " + deliv)
