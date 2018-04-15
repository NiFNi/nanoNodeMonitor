DIR="$( cd "$(dirname "$0")" ; pwd -P )"
url=$(jq -r '.fullurl' $DIR"/config.json")
json=$(curl -s --data '{"action": "block_count_type"}' $url)

DIR="$( cd "$(dirname "$0")" ; pwd -P )"
echo $json > $DIR"/../data/blocktypes.json"
