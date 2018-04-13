import requests
import json
import os
from collections import OrderedDict

url = 'http://localhost:7076'
payload = {'action': 'peers'}

r = requests.post(url, data=json.dumps(payload))
result = json.loads(r.text)["peers"]

versions = {}

for key, val in result.items():
    if val in versions:
        versions[val] += 1
    else:
        versions[val] = 1
ordered = OrderedDict(sorted(versions.items()))

direc = os.path.dirname(os.path.realpath(__file__))
with open(direc + "/../data/networkversion.json", "w") as text_file:
    print(json.dumps(ordered), file=text_file)

