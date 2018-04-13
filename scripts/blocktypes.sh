json=$(curl -s --data '{"action": "block_count_type"}' http://localhost:7076)

DIR="$( cd "$(dirname "$0")" ; pwd -P )"
echo $json > $DIR"/../data/blocktypes.json"
