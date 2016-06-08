import requests
import lxml.html
import sys
import re
import json


packageTypes = ('N', 'D')

originalCityName = sys.argv[1]
deliveryCityName = sys.argv[3]
weight = sys.argv[5]
collectionPostCode = sys.argv[2]#"143000"
deliveryPostCode = sys.argv[4]#"300000"
#volume = sys.argv[6]

def getDataAndPrintPrices(packageType):
#this is pretty pity but we can\'t get the information via one request 
    ck = requests.get("http://www.tnt.com/pricing/pricingInput.do").cookies

    payloadInput = { "navigation": "",
                     "genericSiteIdent": "",
                     "collectionCountry":"RU",
                     "deliveryCountry":"RU",
                     "packageType":packageType,
                     "btnX":""}
    r = requests.post("http://www.tnt.com/pricing/pricingDetail.do", params= payloadInput, cookies = ck)
    ck = r.cookies
    #r = lxml.html.fromstring(r.text)
    #calc_form = r.forms[0]
    #calc_form.fields["collectionTown"] = originalCityName
    #calc_form.fields["collectionPostCode"] = collectionPostCode
    #calc_form.fields["deliveryTown"] = deliveryCityName
    #calc_form.fields["deliveryPostCode"] = deliveryPostCode
    #calc_form.fields["totpackageWeight"] = weight
    #calc_form.fields["unitType"] = "metric"
    #calc_form.fields["totpackageWeightMetric"] = "1"
    #calc_form.fields["totpackageWeightMetric"]
    #payload = { }
    #for x in calc_form.fields:
    #    payload[x] = calc_form.fields[x]

    payload = { "collectionCountry": "RU",             "collectionCountryName": "Russian+Federation",            "collectionCountryCurrency":"RUB",            "collectionCountryMask":"NNNNNN",            "deliveryCountry":"RU",            "deliveryCountryName":"Russian+Federation",            "deliveryCountryMask":"NNNNNN",            "packageType":packageType,            "navigation":"",            "genericSiteIdent": "",            "collectionPostCode":collectionPostCode,            "collectionTown":originalCityName,            "deliveryCountry":"RU",            "deliveryPostCode":deliveryPostCode,            "deliveryTown":deliveryCityName,             "deliveryCountry":"RU",            "resultCurrency":"RUB",            "totpackageWeight":weight,            "unitType":"metric",            "numberOfItems":"1",            "totpackageVolumeMetric":"0",            "totpackageWeightMetric":weight,            "totpackageVolume":"0" }

    r = requests.post("http://www.tnt.com/pricing/pricingRequest.do", cookies = ck, params = payload)
    result = re.finditer("<td>[^>]*EXPRESS[^>]*</td><td>\d+\\.?\d{0,2}", r.text)
    for match in result:
        try:
            t = match.group()
            price = re.search("</td><td>\d+\\.?\d{0,2}", t).group()[9:]
            cond = re.search("<td>.*</td>", t).group().replace('<td>', '').replace('</td>', '')
            print(json.dumps( { "price": price, "condition": cond }))
        except:
            pass
            
for ptype in packageTypes:
    getDataAndPrintPrices(ptype)
