import requests
import json
import os
from collections import OrderedDict

direc = os.path.dirname(os.path.realpath(__file__))

with open(direc + "/config.json", "r") as conf:
    url = json.load(conf)["fullurl"]
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

with open(direc + "/../data/networkversion.json", "w") as text_file:
    print(json.dumps(ordered), file=text_file)

