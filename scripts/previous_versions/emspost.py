import json
import requests
import sys

url = 'http://www.emspost.ru/api/rest'

#print("Original city:")
#originalCityName = input()
originalCityName = sys.argv[1]
#print("Deliviry city:")
#deliviryCityName = input()
deliviryCityName = sys.argv[2]
#print("Weight:")
#weight = input()
weight = sys.argv[3]

payload = {"method":"ems.get.locations", "type":"cities", "plain":"true"}
r = requests.get(url, params=payload)
r = json.loads(r.text)
cities = r["rsp"]["locations"]
cities_d = dict()
for x in cities:
    cities_d[x["name"]] = x["value"]
origId = cities_d[originalCityName]
deliId = cities_d[deliviryCityName]

payload = {"method":"ems.calculate", "from":origId, "to":deliId, "weight":weight, "value": 11000}
r = requests.get(url, params=payload)

r = json.loads(r.text)["rsp"];
print(json.dumps({ "price": r["price"],
                    "time": r["term"]["min"] + "-" + r["term"]["max"],
                 }))

