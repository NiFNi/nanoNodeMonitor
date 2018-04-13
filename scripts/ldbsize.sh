FILENAME="/root/RaiBlocks/data.ldb"
FILESIZE=$(stat --printf="%s" $FILENAME)
DIR="$( cd "$(dirname "$0")" ; pwd -P )"
echo $FILESIZE > $DIR"/../data/ldbsize"
