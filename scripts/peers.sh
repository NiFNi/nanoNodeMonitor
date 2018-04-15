DIR="$( cd "$(dirname "$0")" ; pwd -P )"
url=$(jq -r '.fullurl' $DIR"/config.json")
repaddr=$(jq -r '.repaddress' $DIR"/config.json")
json=$(curl -s --data '{"action": "peers"}' $url)
peers=$(echo $json | jq -r '.peers | length')

DIR="$( cd "$(dirname "$0")" ; pwd -P )"
echo $peers > $DIR"/../data/peers"
