import os
import json
import psycopg2
import time

direc = os.path.dirname(os.path.realpath(__file__))

with open(direc + "/config.json", "r") as f:
    conf = json.load(f)["postgres"]
with open(direc + "/../data/txh.json", "r") as f:
    txh = json.load(f)

time = time.time() - (3 * 3600)
time = int(time*1000)
results = {}
conn_string = "host='" + conf["host"] + "' dbname='" + conf["database"] + "' user='"+ conf["user"] + "' password='" + conf["password"] + "'"
conn = psycopg2.connect(conn_string)
cursor = conn.cursor()
cursor.execute("SELECT * FROM timestamps where timestamp>" + str(time))
records = cursor.fetchall()
txh.append(int(len(records)/2))


with open(direc + "/../data/txh.json", "w") as text_file:
    print(json.dumps(txh), file=text_file)


