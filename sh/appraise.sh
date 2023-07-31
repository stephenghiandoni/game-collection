#!/bin/bash
#This script is executed by display_games.php when the user wants to appraise the list of games in collection
#dependencies: lynx

TMP_DIR="/var/www/html/sh/tmp"
LOCK_FILE="$TMP_DIR/appraise.lock"
num_games=$1
gameid_list=($2) #convert params back into arrays 
query_list=($3)
game_list=($4)
box_list=($5)
manual_list=($6)
sealed_list=($7)


#filename=$(echo "$title.txt" | sed 's/\//-/g' )

#prevent script from running more than once
if [ -f "$LOCK_FILE" ]; then
	printf "Error: appraisal in progress..."
	exit 1
fi

printf "Process $$ is running." > "$LOCK_FILE"

for (( i=0; i<$num_games; i++ ))
do
	#echo ${gameid_list[$i]}
	#download page from url
	#full_url="https://www.pricecharting.com/game/$title"
	#printf "Downloading $url...</br>"
	#printf "filename: $filename</br>"
	#lynx -dump "$url" > $TMP_DIR/$filename

	#parse data to extract price info
	#price_list=$(cat $TMP_DIR/$filename | grep [$][0-9][0-9] | grep '^[^[:alpha:]]*$')#redo this, it's not right
	#echo $price_list

	#perform sql insert

done

rm -f "$LOCK_FILE"

exit 0
