DIR="$( cd "$(dirname "$0")" ; pwd -P )"
url=$(jq -r '.fullurl' $DIR"/config.json")
json=$(curl -s --data '{"action": "block_count"}' $url)
count=$(echo $json | jq -r '.count')
unchecked=$(echo $json | jq -r '.unchecked')

echo $count > $DIR"/../data/blockcount"
echo $unchecked > $DIR"/../data/unchecked"
