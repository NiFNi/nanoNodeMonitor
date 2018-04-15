DIR="$( cd "$(dirname "$0")" ; pwd -P )"
path=$(jq -r '.dataldbPath' $DIR"/config.json")
FILENAME=$path"/data.ldb"
FILESIZE=$(stat --printf="%s" $FILENAME)
DIR="$( cd "$(dirname "$0")" ; pwd -P )"
echo $FILESIZE > $DIR"/../data/ldbsize"
