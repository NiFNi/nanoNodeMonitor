import requests
import json
import os
from collections import OrderedDict

direc = os.path.dirname(os.path.realpath(__file__))

with open(direc + "/config.json", "r") as conf:
    url = json.load(conf)["fullurl"]

payload = {'action': 'representatives_online'}
r = requests.post(url, data=json.dumps(payload))
online = json.loads(r.text)["representatives"]

payload = {'action': 'representatives'}
r = requests.post(url, data=json.dumps(payload))
reps = json.loads(r.text)["representatives"]

result = {"count": len(online), "weight": 0}

for key in online:
    if key in reps:
        result["weight"] += int(reps[key])

with open(direc + "/../data/onlinevotingweight.json", "w") as text_file:
    print(json.dumps(result), file=text_file)

