#!/bin/bash
#This script is executed by display_games.php when the user wants to appraise the list of games in collection
#It performs the appraisal on the given list of games and inserts in appropriate values into db
#dependencies: lynx

source ../../sensitive.sh
TMP_DIR="/var/www/html/sh/tmp"
LOCK_FILE="$TMP_DIR/appraise.lock"
LOG_FILE="$TMP_DIR/games.log"
ERR_LOG_FILE="$TMP_DIR/err.log"
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
printf "" > $LOG_FILE #wipe logs
printf "" > $ERR_LOG_FILE

#num_games=75  #limit/alter range of i for testing
#download, scrape and insert into db data for each game
for (( i=0; i<$num_games; i++ ))
do
	sleep_time=$((5 + RANDOM % (15 - 5 + 1) ))
	printf "Sleeping $sleep_time seconds...\n" >> $LOG_FILE
	sleep $sleep_time 
	#get info of current game
	gid=${gameid_list[$i]}
	url=${query_list[$i]}
	filename="${gameid_list[$i]}.txt" #name of the textfile to be scraped
	game_owned=${game_list[$i]}
	box_owned=${box_list[$i]}
	manual_owned=${manual_list[$i]}
	sealed=${sealed_list[$i]}
	result="" #price to insert
	current_date=$(date +"%Y-%m-%d %H:%M:%S")
	
	printf "DATE: $current_date\n" >> $LOG_FILE

	#convert y/n values to boolean for cleaner processing
	sealed=$( [[ "$sealed" == "Y" ]] && echo "true" || echo "false" )
	game_owned=$( [[ "$game_owned" == "Y" ]] && echo "true" || echo "false" )
	box_owned=$( [[ "$box_owned" == "Y" ]] && echo "true" || echo "false" )
	manual_owned=$( [[ "$manual_owned" == "Y" ]] && echo "true" || echo "false" )

	
	#printf "</br>SEALED: $sealed   GAME: $game_owned   BOX: $box_owned   MANUAL: $manual_owned</br>"	

	#download page from url
	full_url="https://www.pricecharting.com/game/$url"
	printf "Downloading $url..." >> $LOG_FILE
	lynx -dump "$full_url" > $TMP_DIR/$filename

	#parse data to extract price info
	price_str=$(cat $TMP_DIR/$filename | grep -Eo '\$[0-9]*.?[0-9]{2}' | tr -d '$')	
	if [ "$price_str" = "" ]; then
		printf	"$url not found...\n\n"	>> $ERR_LOG_FILE
		rm -f "$TMP_DIR/$filename"
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
	
	printf	"\nLOOSE: $loose_price   COMPLETE: $complete_price   NEW: $new_price   GRADED: $graded_price   BOX: $box_only_price   MANUAL: $manual_only_price\n" >> $LOG_FILE
	
	#get the appropriate pricing data based on how much of a game is owned
	if "$sealed"; then
		echo "You have this game factory sealed!" >> $LOG_FILE
		result=$new_price
	elif ! "$game_owned" && ! "$box_owned" && "$manual_owned";then
		echo "You only have the manual for $url" >> $LOG_FILE
		result=$manual_only_price
	elif ! "$game_owned" && "$box_owned" && ! "$manual_owned"; then
		echo "You only have the box for $url" >> $LOG_FILE
		result=$box_only_price
	elif "$game_owned" && ! "$box_owned" && ! "$manual_owned"; then
		echo "You only have the loose game for $url" >> $LOG_FILE
		result=$loose_price
	elif "$game_owned" && "$box_owned" && ! "$manual_owned"; then
		echo "You have the game and box but no manual for $url" >> $LOG_FILE
		result=$(echo "$loose_price + $box_only_price" | bc -l)
	elif "$game_owned" && ! "$box_owned" && "$manual_owned"; then
		echo "You have the game and manual but no box for $url"	 >> $LOG_FILE
		result=$(echo "$loose_price + $manual_only_price" | bc -l)
	elif ! "$game_owned" && "$box_owned" && "$manual_owned"; then
		echo "You have the box and manual but not the game for $url" >> $LOG_FILE
		result=$(echo "$box_only_price + $manual_only_price" | bc -l)
	elif "$game_owned" && "$box_owned" && "$manual_owned"; then
		echo "You have $url complete!" >> $LOG_FILE
		result=$complete_price
	else
		echo "Error: Neither game, box nor manual found in db for $url..." >> $LOG_FILE
	fi

	rm -f "$TMP_DIR/$filename"

	#perform sql insert
	printf "INSERTING: $gid $current_date $result\n\n" >> $LOG_FILE
	sql_insert="INSERT INTO Game_Value(game_id, search_date, value) VALUES ('$gid', '$current_date', $result);"
	mysql --user="$db_user" --password="$db_pass" "$db_name" <<END_SQL_INSERT
	$sql_insert;
END_SQL_INSERT

done #****End For Loop****

rm -f "$LOCK_FILE"

exit 0
