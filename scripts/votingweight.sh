DIR="$( cd "$(dirname "$0")" ; pwd -P )"
url=$(jq -r '.fullurl' $DIR"/config.json")
repaddr=$(jq -r '.repaddress' $DIR"/config.json")
count=$(curl -s --data '{"action": "account_info", "weight": "true", "account": "'$repaddr'"}' $url | jq -r '.weight')
DIR="$( cd "$(dirname "$0")" ; pwd -P )"
echo $count > $DIR"/../data/votingweight"
