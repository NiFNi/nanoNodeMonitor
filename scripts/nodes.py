import requests
from requests.exceptions import ConnectTimeout
import json
import os
from collections import OrderedDict

direc = os.path.dirname(os.path.realpath(__file__))

with open(direc + "/config.json", "r") as conf:
    nodes = json.load(conf)["nodes"]

results = {}

for name, url in nodes.items():
    try:
        r = requests.get(url + "/api.php", timeout=5)
    except Exception:
        continue
    if r.status_code != 200:
        continue
    try:
        result = r.json()
    except ValueError:
        continue
    if type(result) is bool:
        print(name)
        continue
    result["url"] = url
    results[name] = result

with open(direc + "/../data/nodes.json", "w") as text_file:
    print(json.dumps(results), file=text_file)

