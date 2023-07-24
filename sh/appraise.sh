#!/bin/bash
#This script is executed by display_games.php when the user wants to appraise the list of games in collection
#process query passed one by one, download webpage and parse out value
#dependencies: lynx, jq
#$1 = number of games, $2 = json object of games {url,title,game,box,manual,factory_sealed}

TMP_DIR="/var/www/html/sh/tmp"
LOCK_FILE="$TMP_DIR/appraise.lock"
num_games=$1
urls=$2


#filename=$(echo "$title.txt" | sed 's/\//-/g' )

if [ -f "$LOCK_FILE" ]; then
	printf "Error: appraisal in progress..."
	exit 1
fi

printf "Process $$ is running." > "$LOCK_FILE"

printf "Arrays:</br>"


for arg in "$@"; do
	echo "$arg</br>"
done

#download webpage
#full_url="https://www.pricecharting.com/game/$title"
#printf "Downloading $url...</br>"
#printf "filename: $filename</br>"
#lynx -dump "$url" > $TMP_DIR/$filename

##parse data to extract price info
#price_list=$(cat $TMP_DIR/$filename | grep [$][0-9][0-9] | grep '^[^[:alpha:]]*$')#redo this, it's not right
#echo $price_list

##when finished scraping, insert price data into db

rm -f "$LOCK_FILE"

exit 0
