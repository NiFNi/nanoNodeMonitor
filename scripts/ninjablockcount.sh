count=$(curl -s  https://nanonode.ninja/api/blockcount | jq -r '.count')
DIR="$( cd "$(dirname "$0")" ; pwd -P )"
echo $count > $DIR"/../data/ninjablockcount"
