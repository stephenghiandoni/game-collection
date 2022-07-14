<!DOCTYPE html>
<!-- 
Script used to display complete lists of games for each console
User selects which games to add to Collection DB
-->
<html>
<head>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
Convert <a href="https://en.wikipedia.org/wiki/Lists_of_video_games">tables from wikipedia</a> to CSV.
<br/>
<a href="https://wikitable2csv.ggor.de/">Table to CSV converter</a>
<br/>
<?php
include('def.php');
include('/var/www/sensitive.php');
$current_list = "...";

$conn = new mysqli($servername, $username, $password, $dbname);   
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['browse'])){
	header("Location:$display_games");
	exit;
}

/*PAGE FOR DATABASE INPUT */
if(isset($_POST['home'])){
	header("Location:$index");
	exit;
}
if(isset($_POST['back'])){
	header("Location:$db_options");
	exit;
}

if(isset($_POST['platform_filter'])){
	$current_list = $_POST['pname_drop'];
}

?>

</head>
<body>
<header><h1>Game Entry Field</h1></header>
<form method="post">
<label for="pname_lbl">Platform: </label>
<select name="pname_drop" id="pname">
<option value=<?php echo $gid_3ds; ?> >3DS</option>
<option value=<?php echo $gid_a2600; ?> >Atari 2600</option>
<option value=<?php echo $gid_ds; ?> >DS</option>
<option value=<?php echo $gid_famicom; ?> >Famicom</option>
<option value=<?php echo $gid_gb; ?> >Game Boy</option>
<option value=<?php echo $gid_gba; ?> >Game Boy Advance</option>
<option value=<?php echo $gid_gbc; ?> >Game Boy Color</option>
<option value=<?php echo $gid_gc; ?> >GameCube</option>
<option value=<?php echo $gid_genesis; ?> >Genesis</option>
<option value=<?php echo $gid_n64; ?> >Nintendo 64</option>
<option value=<?php echo $gid_nes; ?> >Nintendo Entertainment System</option>
<option value=<?php echo $gid_ps1; ?> >PlayStation</option>
<option value=<?php echo $gid_ps2; ?> >PlayStation 2</option>
<option value=<?php echo $gid_ps3; ?> >PlayStation 3</option>
<option value=<?php echo $gid_ps4; ?> >PlayStation 4</option>
<option value=<?php echo $gid_psp; ?> >PSP</option>
<option value=<?php echo $gid_ps_vita; ?> >PS Vita</option>
<option value=<?php echo $gid_saturn; ?> >Saturn</option>
<option value=<?php echo $gid_sms; ?> >Sega Master System</option>
<option value=<?php echo $gid_snes; ?> >Super Nintendo Entertainment System</option>
<option value=<?php echo $gid_vb; ?> >Virtual Boy</option>
<option value=<?php echo $gid_wii; ?> >Wii</option>
<option value=<?php echo $gid_wiiu; ?> >Wii U</option>
<option value=<?php echo $gid_xbox; ?> >Xbox</option>
<option value=<?php echo $gid_x360; ?> >Xbox 360</option>
<option value=<?php echo $gid_xbone; ?> >Xbox One</option>
</select>
<input type="submit" name="platform_filter" class="button" value="Filter"/>
</form>

<form method="post">
<input type="submit" name="browse" class="button" value="Browse"/>
<input type="submit" name="home" class="button" value="Home"/>
<input type="submit" name="back" class="button" value="Back"/>
<br/><br/>
<input type="submit" name="populate" class="button" value="Populate DB"><br/>
</form>

<?php
//*******************************
//Display games table*********
//*******************************
$oid = array();
//get owner ids and names from db
$sql = "SELECT owner_id, name FROM Owner";
$result = $conn->query($sql);

if($result->num_rows > 0){
	$i = 0;
	while($row = $result->fetch_assoc()){
		$oid[$i] = $row["owner_id"];
		$onames[$i] = $row["name"];
		$i++;
	}	
}else{
	echo "Owner table empty...";
}	

$sql = "SELECT * from Game where group_id = '$current_list' ORDER BY title";
$result = $conn->query($sql);
if($result->num_rows > 0){
	?>

		<header><h2>List of games for group: <?php echo $current_list; ?></h2></header>
		<table name="game_table" id="game_table">
		<tr>
		<th>Title</th>
		<th>Owner</th>
		<th>Game</th>
		<th>Box</th>
		<th>Manual</th>
		<th>Region</th>
		</tr>

		<?php
		$i = 0;

	while($row = $result->fetch_assoc()){
		$game_chk = "game_chk_" . $row['title'];
		$box_chk = "box_chk_" . $row['title'];
		$manual_chk = "manual_chk_" . $row['title'];

		?>
			<tr>
			<td><input type="text" size="100" id="title_text<?php echo $i; ?>" name="title_text" value="<?php echo $row['title']; ?>" /></td>
			<td>
			<select name="owner_drop" id="owner_drop<?php echo $i; ?>">
			<?php
			//fill owner drop box
			echo "<option value='empty_owner' >Select Owner</option>";
		for($j = 0; $j < count($oid); $j++){
			$o = "$oid[$j]";
			echo "<option value=$o";
			echo ">$onames[$j]</option>";
		}
		?>
			</select>
			</td>
			<td>
			<input type='checkbox' id="game_chk<?php echo $i; ?>" name="game_chk">
			</td>
			<td>
			<input type='checkbox' id="box_chk<?php echo $i; ?>" name="box_chk">
			</td>
			<td>
			<input type='checkbox' id="manual_chk<?php echo $i; ?>" name="manual_chk">
			</td>
			<td>
			<select id="region_drop<?php echo $i; ?>" name="region_drop">
			<?php
			for($j = 0; $j < count($region_list); $j++){
				$r = "$region_list[$j]";
				echo "<option value=$r ";
				echo (isset($_POST['region_drop']) && $_POST['region_drop'] == "$o") ? 'selected' : '';
				echo ">$r</option>";
			}
		?>
			</select>
			</td>
			</tr>
			<?php
			$i++;	
	}
	?>
		</table>
		<?php

}else{
	echo "Please select a console to display a list of games.";
}

?>
<button id="parse_btn">Input</button><br/>
<textarea readonly id="selection" cols="60" rows="20"></textarea>

<script type="text/javascript">
$(document).ready(function(){
		$("#parse_btn").click(function(){
				dataToSend = {results: parse_game_table()};
				$.post("update_game_table.php", dataToSend, function(dataReceived){
				$("#selection").val(dataReceived);
		});
	});
});

//function to gather results of selection in game table and insert them into database
function parse_game_table(){
	var myTab = document.getElementById('game_table');
	var err = "<?php echo $err_owner_msg; ?>";
	var group = "<?php echo $current_list;?>";
	var sql_insert_game = "";
	// LOOP THROUGH EACH ROW OF THE TABLE AFTER HEADER.
	for (i = 1; i < myTab.rows.length; i++) {
		//Get selections from game table
		var title = document.getElementById("title_text" + (i-1)).value;
		var owner = document.getElementById("owner_drop" + (i-1)).value;
		var game = document.getElementById("game_chk" + (i-1));
		//reset check boxes that are clicked, store results first
		if(game.checked){
			game = "1";
			document.getElementById("game_chk" + (i-1)).click();
		}else{
			game = "0";
		}
		var box = document.getElementById("box_chk" + (i-1));
		if(box.checked){
			box = "1";
			document.getElementById("box_chk" + (i-1)).click();
		}else{
			box = "0";
		}
		var manual = document.getElementById("manual_chk" + (i-1));
		if(manual.checked){
			manual = "1";
			document.getElementById("manual_chk" + (i-1)).click();
		}else{
			manual = "0";
		}
		var region = document.getElementById("region_drop" + (i-1)).value;

		//insert valid selections, send error for improper selections
		if(game == 1 || box == 1 || manual == 1){
			if(owner == 'empty_owner'){
				sql_insert_game = sql_insert_game + err + title + "\n";
			}else{
				sql_insert_game = sql_insert_game + "\'" + title + "\'" + ', ' + "\'" + group + "\'" + ', ' + owner + ', ' + game + ', ' + box + ', ' + manual + ', ' +  "\'" + region + "\'" + "\n";
			}
		}
	}
	return sql_insert_game;
}
</script>
</body>

<?php
if (isset($_POST['results'])) {
	echo $_POST['results'];
}

if(isset($_POST['variable']) && isset($_POST['insert_games'])){
	$jqueryVariable = $_POST['variable'];
	echo $jqueryVariable;
}
//Button populates the db with new titles from csv
//manually add new entries from csv files here
if(isset($_POST['populate'])){
	//LOAD CSV FILES
//	pop_from_csv($conn, $csv_path_3ds, $gid_3ds);
//	pop_from_csv($conn, $csv_path_a2600_1, $gid_a2600);
//	pop_from_csv($conn, $csv_path_a2600_2, $gid_a2600);
//	pop_from_csv($conn, $csv_path_ds_1, $gid_ds);
//	pop_from_csv($conn, $csv_path_ds_2, $gid_ds);
//	pop_from_csv($conn, $csv_path_ds_3, $gid_ds);
//	pop_from_csv($conn, $csv_path_ds_4, $gid_ds);
//	pop_from_csv($conn, $csv_path_famicom, $gid_famicom);
//	pop_from_csv($conn, $csv_path_gb, $gid_gb);
//	pop_from_csv($conn, $csv_path_gba, $gid_gba);
//	pop_from_csv($conn, $csv_path_gbc, $gid_gbc);
//	pop_from_csv($conn, $csv_path_gc, $gid_gc);
//	pop_from_csv($conn, $csv_path_genesis, $gid_genesis);
//	pop_from_csv($conn, $csv_path_n64, $gid_n64);
//	pop_from_csv($conn, $csv_path_nes, $gid_nes);
//	pop_from_csv($conn, $csv_path_ps1_1, $gid_ps1);
//	pop_from_csv($conn, $csv_path_ps1_2, $gid_ps1);
	pop_from_csv($conn, $csv_path_ps2_1, $gid_ps2);
	pop_from_csv($conn, $csv_path_ps2_2, $gid_ps2);
//	pop_from_csv($conn, $csv_path_ps3_1, $gid_ps3);
//	pop_from_csv($conn, $csv_path_ps3_2, $gid_ps3);
//	pop_from_csv($conn, $csv_path_ps3_3, $gid_ps3);
//	pop_from_csv($conn, $csv_path_ps3_4, $gid_ps3);
//	pop_from_csv($conn, $csv_path_ps4_1, $gid_ps4);
//	pop_from_csv($conn, $csv_path_ps4_2, $gid_ps4);
//	pop_from_csv($conn, $csv_path_psp, $gid_psp);
//	pop_from_csv($conn, $csv_path_ps_vita_1, $gid_ps_vita);
//	pop_from_csv($conn, $csv_path_ps_vita_2, $gid_ps_vita);
//	pop_from_csv($conn, $csv_path_ps_vita_3, $gid_ps_vita);
//	pop_from_csv($conn, $csv_path_ps_vita_4, $gid_ps_vita);
//	pop_from_csv($conn, $csv_path_ps_vita_5, $gid_ps_vita);
//	pop_from_csv($conn, $csv_path_ps_vita_6, $gid_ps_vita);
//	pop_from_csv($conn, $csv_path_saturn, $gid_saturn);
//	pop_from_csv($conn, $csv_path_sms, $gid_sms);
//	pop_from_csv($conn, $csv_path_snes, $gid_snes);
//	pop_from_csv($conn, $csv_path_vb, $gid_vb);
//	pop_from_csv($conn, $csv_path_wii, $gid_wii);
//	pop_from_csv($conn, $csv_path_wiiu, $gid_wiiu);
//	pop_from_csv($conn, $csv_path_xbox, $gid_xbox);
//	pop_from_csv($conn, $csv_path_x360_1, $gid_x360);
//	pop_from_csv($conn, $csv_path_x360_2, $gid_x360);
//	pop_from_csv($conn, $csv_path_xbone_1, $gid_xbone);
//	pop_from_csv($conn, $csv_path_xbone_2, $gid_xbone);
	unset($_POST['populate']);
	//	header("Location:$games_page");
	exit;
}

//Populate database from csv files
function pop_from_csv($conn, $path, $gid){
	echo "<br/>Searching CSV files for new titles to add...<br/>";
	$row = 1;
	if (($handle = fopen("$path", "r")) !== FALSE) {
		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
			$num = count($data);
			$title = $data[0];
			$row++;
			insert_game($conn, $title, $gid);
		}
		fclose($handle);
	}else{
		echo "<br/>Error: No CSV file found at $path...";
	}
}

//check if game exists in db, add it if not
//this is for adding to the list of games, not what is in the actual collection
function insert_game($conn, $title, $gid){
	$title = str_replace('\'', '\'\'', $title);//sanitize string to please sql 

	echo "<br>Attempting to add " . $gid . " " . $title . "... ";
	$sql = "SELECT title FROM Game WHERE group_id = '$gid' AND title = '$title' ";//determine if game already exists in db
	$result = $conn->query($sql) or die($conn->error);
	$new_game = 0;

	if($result->num_rows > 0){
		//Title already in database 
		echo " it already exists!";
	}	
	else{
		$new_game = 1;
	}
	if($new_game == 1){
		//Title not found in library add from csv entry
		echo "<br/>Adding $title to $gid library...<br>";
		$sql = "INSERT INTO Game (group_id, owner_id, title, game, manual, box, num_owned) values ('$gid', 1, '$title', 0, 0, 0, 0)" ;
		if($conn->query($sql) === TRUE){
			echo "$title inserted into collection with group_id $gid<br/>";
		}else{
			echo "Error inserting $title " . $sql . "<br/>" . $conn->error;
		}
	}
}

$conn->close();

?>
</html>
