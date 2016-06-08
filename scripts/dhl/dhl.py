import sys
import requests
from urllib import parse
def getEnglishName(postal):
    url = "http://dct.dhl.com/data/postLoc?start=0&max=1000&queryBy=2&cntryCd=RU&postcdStart=" + str(postal) + "&t=1407159989206"
    r = requests.get(url)
    return r.text.split("cityName")[1][1:-2]

def getDim(x):
    return int((float(x)**(1/3)) * 100)

origName = sys.argv[1]
origIndex = sys.argv[2]
delivName = sys.argv[3]
delivIndex = sys.argv[4]
weight = sys.argv[5]
volume = sys.argv[6]

"""
volume = 0.001
origIndex = 143000
delivIndex = 350000
"""
origName = getEnglishName(origIndex)
delivName = getEnglishName(delivIndex)


headers = {
"Accept":"application/json",
"Accept-Encoding":"gzip,deflate,sdch",
"Accept-Language":"en-US,en;q=0.8"
}

l = getDim(volume)

from datetime import date
from datetime import timedelta
from datetime import datetime

date = (datetime.today() + timedelta(days=1)).strftime("%Y-%m-%d")

url = "http://dct.dhl.com/data/quotation/?dtbl=N&declVal=&declValCur=RUB&wgtUom=kg&dimUom=cm&noPce=1&wgt0=" + weight + "&w0=" + str(l) + "&l0=" + str(l) + "&h0=" + str(l) + "&shpDate=" + date + "&orgCtry=RU&orgCity=" + origName + "&orgSub=&orgZip=" + str(origIndex) + "&dstCtry=RU&dstCity=" + delivName + "&dstSub=&dstZip=" + str(delivIndex)

r = requests.get(url, headers=headers)

import json

r = json.loads(r.text)


if int(r["count"]) > 1:
    for x in r["quotationList"]["quotation"]:
        #print(x)
        price = x["estTotPrice"][3:]
        price = price.replace(",", '')
        if len(price) == 0:
            price = '0'
        # deliv = x["estDeliv"].replace(' ', '_').split(',')[1]
        # deliv = "".join(deliv)
        try:
            deliv = datetime.strptime(x["estDeliv"], "%A, %d %B %Y, by %H:%M").date()
            deliv = deliv - datetime.now().date()
            deliv = deliv.days
        except ValueError:
            try:
                deliv = datetime.strptime(x["estDeliv"].split(',')[1].strip(), "%d %B %Y").date()
                deliv = deliv - datetime.now().date()
                deliv = deliv.days
            except:
                deliv = ""
        condition = x["prodNm"] + ", самое позднее время для вызова курьера " + x["latBkg"] +", самое позднее время приезда курьера для отправки груза в тот же день " + x["latPckp"]
        print(json.dumps({ "price": price,
                            "time": deliv,
                            "condition": condition,
                            }))
else:
    x = r["quotationList"]["quotation"]
    price = x["estTotPrice"][3:]
    price = price.replace(",", '')
    deliv = x["estDeliv"].split(',')
    deliv = "".join(deliv)
    condition = x["prodNm"] + ", самое позднее время для вызова курьера " + x["latBkg"] +", самое позднее время приезда курьера для отправки груза в тот же день " + x["latPckp"]
    print(json.dumps({ "price": price,
                        "time": deliv,
                        "condition": condition,
                        }))

