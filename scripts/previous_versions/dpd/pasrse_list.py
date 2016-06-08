import json

f = open("list", "r")

l = f.readlines()[0]

data = json.loads(l)

print(type(data["geonames"]))

for x in data["geonames"]:
    if (x["name"][0] == "-" or x["adminName1"][0] == "-"):
        continue
    l_b, r_b = x["adminName1"].split("-")
    l = []
    for i in range(int(l_b), int(r_b) + 1):
        l.append(str(i))
    print("\"" + x["reg"] + "\" \"" + x["name"] + "\" \"" + "\" \"".join(l) + "\"")

