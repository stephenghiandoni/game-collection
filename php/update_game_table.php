<?php
/*
This script takes the results of the games selected from table in games.php and performs sql insert with results
*/
include('def.php');
include('/var/www/sensitive.php');

$conn = new mysqli($servername, $username, $password, $dbname);   
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$selections = explode(PHP_EOL, $_POST['results']);

//go through selections, -1 because final element is empty due to line break
for($i = 0; $i < count($selections)-1; $i++){
	//ignore invalid inputmessages, else perform insert
	if(strpos($selections[$i], $err_owner_msg) !== false){
		echo $selections[$i];
	}else{
		$sql = "INSERT INTO Games_Owned (title, group_id, owner_id, game, box, manual, region) VALUES ($selections[$i])";
		if($conn->query($sql) === TRUE){
			echo "Successfully inserted record: $selections[$i]";
		}else{
			echo "Error: " . $sql . PHP_EOL . $conn->error;
		}
		echo $sql;
	}
	echo PHP_EOL;
}

$conn->close();
?>
