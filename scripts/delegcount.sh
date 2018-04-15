DIR="$( cd "$(dirname "$0")" ; pwd -P )"
url=$(jq -r '.fullurl' $DIR"/config.json")
repaddr=$(jq -r '.repaddress' $DIR"/config.json")
count=$(curl -s --data '{"action": "delegators_count", "account": "'$repaddr'"}' $url | jq -r '.count')
DIR="$( cd "$(dirname "$0")" ; pwd -P )"
echo $count > $DIR"/../data/delegcount"
