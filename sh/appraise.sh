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
loose_price=""
complete_price=""
new_price=""
graded_price=""
box_only_price=""
manual_only_price=""

#prevent script from running more than once
if [ -f "$LOCK_FILE" ]; then
	printf "Error: appraisal in progress..."
	exit 1
fi

printf "Process $$ is running." > "$LOCK_FILE"

#download, scrape and insert into db data for each game
for (( i=0; i<$num_games; i++ ))
do
	#get info of current game
	gid=${gameid_list[$i]}
	url=${query_list[$i]}
	filename="${gameid_list[$i]}.txt" #name of the textfile to be scraped
	game_owned=${game_list[$i]}
	box_owned=${box_list[$i]}
	manual_owned=${manual_list[$i]}
	sealed=${sealed[$i]}
	match_str="Loose Price Complete Price New Price Graded Price"

	#download page from url
	full_url="https://www.pricecharting.com/game/$url"
	printf "Downloading $url...</br>"
	lynx -dump "$full_url" > $TMP_DIR/$filename

	#parse data to extract price info
	price_str=$(cat $TMP_DIR/$filename | grep -A 5 "$match_str" | grep -v '[a-zA-Z]' )
	echo "$price_str"
	if [ "$price_str" = "" ]; then
		printf	"Game not found..."	
		rm "$TMP_DIR/$filename"
		continue
	else
		price_list=($price_str) #convert string of prices to array 
		loose_price="${price_list[0]}"
		complete_price="${price_list[2]}"
		new_price="${price_list[4]}"
		graded_price="${price_list[6]}"
		box_only_price="${price_list[8]}"
		manual_only_price="${price_list[10]}"
	fi	
	
	printf	"<br/>LOOSE: $loose_price   COMPLETE: $complete_price   NEW: $new_price   GRADED: $graded_price   BOX: $box_only_price   MANUAL: $manual_only_price<br/>"

	printf "Removing $filename"

#	rm "$TMP_DIR/$filename"

#perform sql insert
#......

	break #just for testing, run loop only once*****************

	done

	rm -f "$LOCK_FILE"

	exit 0
