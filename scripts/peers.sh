json=$(curl -s --data '{"action": "peers"}' http://localhost:7076)
peers=$(echo $json | jq -r '.peers | length')

DIR="$( cd "$(dirname "$0")" ; pwd -P )"
echo $peers > $DIR"/../data/peers"
