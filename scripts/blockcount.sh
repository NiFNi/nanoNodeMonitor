json=$(curl -s --data '{"action": "block_count"}' http://localhost:7076)
count=$(echo $json | jq -r '.count')
unchecked=$(echo $json | jq -r '.unchecked')

DIR="$( cd "$(dirname "$0")" ; pwd -P )"
echo $count > $DIR"/../data/blockcount"
echo $unchecked > $DIR"/../data/unchecked"
