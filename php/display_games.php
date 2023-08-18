<!DOCTYPE html>
<!-- 
Script used to display Collection DB
Can also run appraisals for each game
-->
<html>
<head>
<meta charset="UTF-8">
<title>Browse Game Collection</title>
<!--script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script-->
<script src="../javascript/display_games.js"></script>
<link rel="stylesheet" href="css/display_games.css?version=1" type="text/css">
<?php
include('def.php');
include('/var/www/sensitive.php');
$tmp_path = '/var/www/html/sh/tmp';
$lock_file = '/var/www/html/sh/tmp/appraise.lock';
$current_list = "";
$gameid_list = array();//arrays to pass to bash for appraisals
$query_list = array();
$game_list = array();
$box_list = array();
$manual_list = array();
$sealed_list = array();
$conn = new mysqli($servername, $username, $password, $dbname);   
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['home'])){
	header("Location:$index");
	exit;
}

if(isset($_POST['back'])){
	header("Location:$games");
	exit;
}

//sets current_list var to determine which list of games to process
if(isset($_POST['platform_filter'])){
	$current_list = $_POST['pname_drop'];
	unset($_POST['platform_filter']);
}

?>

</head>
<body>
<header><h1>Browse Game Collection</h1></header>
<form method="post">
<label for="pname_lbl">Platform: </label>
<select name="pname_drop" id="pname">
<option value=<?php echo "All"; ?> >All</option>
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
<option value=<?php echo $gid_switch; ?> >Switch</option>
<option value=<?php echo $gid_vb; ?> >Virtual Boy</option>
<option value=<?php echo $gid_wii; ?> >Wii</option>
<option value=<?php echo $gid_wiiu; ?> >Wii U</option>
<option value=<?php echo $gid_xbox; ?> >Xbox</option>
<option value=<?php echo $gid_x360; ?> >Xbox 360</option>
<option value=<?php echo $gid_xbone; ?> >Xbox One</option>
</select>
<input type="submit" name="platform_filter" class="button" value="Display"/>
<?php echo '<input type="checkbox" name="run_appraisal" value="Appraise Selection" ' . ((is_file($lock_file)) ? 'disabled' : '') . '>';
echo ((is_file($lock_file)) ? 'Appraisal already running, check back later...' : "Appraise Selection");
?>
</form>

<form method="post">
<input type="submit" name="home" class="button" value="Home"/>
<input type="submit" name="back" class="button" value="Back"/>
<br/><br/>
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

//gather totals 
$sql = "SELECT * from Games_Owned";
$result = $conn->query($sql);
$total = $result->num_rows;

$count_games = array(0, 0, 0);//stephen, jordan, shared

//set group id if a specific console is selected, otherwise display all games owned
$sql = "SELECT * from Games_Owned where" . (($current_list == "All") ? " " :  " group_id = '$current_list' and ") . "owner_id = 1";
$result = $conn->query($sql);
$count_games[0] = $result->num_rows;

$sql = "SELECT * from Games_Owned where" . (($current_list == "All") ? " " :  " group_id = '$current_list' and ") . "owner_id = 2";
$result = $conn->query($sql);
$count_games[1] = $result->num_rows;

$sql = "SELECT * from Games_Owned where" . (($current_list == "All") ? " " :  " group_id = '$current_list' and ") . "owner_id = 3";
$result = $conn->query($sql);
$count_games[2] = $result->num_rows;

$sql = "SELECT * from Games_Owned" . (($current_list == "All") ? " " :  " where group_id = '$current_list' ") . "ORDER BY title";
$result = $conn->query($sql);

if($result->num_rows > 0){	
	$num_games = 0;//param for bash 
	$all = false;
	if($current_list === 'All')
		$all = true;

	?>
		<header><h2>List of games for group: <?php echo translate_gid($current_list); ?></h2></header>
		</br>
		<!-- Display totals table -->
		<table border='1' style='border-collapse:collapse'>
		<tr>
		<th>Stephen</th>
		<th>Jordan</th>
		<th>Shared</th>
		<th>Platform Total</th>
		<th>Collection Total</th>
		</tr>
		<tr>
		<td> <?php echo $count_games[0]; ?> </td>
		<td> <?php echo $count_games[1]; ?> </td>
		<td> <?php echo $count_games[2]; ?> </td>
		<td> <?php echo $result->num_rows; ?> </td>
		<td> <?php echo $total; ?> </td>
		</tr>
		</table>
		</br></br>

		<table border='1' style='border-collapse:collapse' name="game_table" id="game_table" >
		<tr>
		<th>Title</th>
		<?php if($all) echo "<th>Platform</th>"; ?>
		<th>Owner</th>
		<th>Game</th>
		<th>Box</th>
		<th>Manual</th>
		<th>Sealed</th>
		<th>Region</th>
		</tr>

		<?php
		$i = 0;
		while($row = $result->fetch_assoc()){
		//get gid of current result if iterating through all games
		if($all)
			$current_list = $row['group_id'];

		$owner = $row['owner_id'];
		if($owner == 1) $owner = "Stephen";
		else if($owner == 2) $owner = "Jordan";
		else if($owner == 3) $owner = "Shared";
		$game = (($row['game'] == 0) ? "N" : "Y");
		$box = (($row['box'] == 0) ? "N" : "Y");
		$manual = (($row['manual'] == 0) ? "N" : "Y");
		$sealed = (($row['sealed'] == 0) ? "N" : "Y");

		?>
			<tr>
			<td><?php echo $row['title']; ?></td>
			<?php if($all) echo "<td>" . translate_gid($current_list) . "</td>"; ?>
			<td><?php echo $owner; ?></td>
			<td><?php echo $game; ?></td>
			<td><?php echo $box; ?></td>
			<td><?php echo $manual; ?></td>
			<td><?php echo $sealed; ?></td>
			<td><?php echo $row['region']; ?></td>
			</tr>
			<?php
		$url_title = adjust_title($row['title'], $row['region']);
		$url_platform = (($row['region'] == "NTSC" ) ? "" : translate_region($row['region'])) . translate_gid($current_list);
		$appraisal_query = $url_platform . "/" . $url_title;

		//build arrays from current selection to pass to bash for appraisals
		array_push($gameid_list, $row['game_id']);
		array_push($query_list, $appraisal_query);		
		array_push($game_list, $game);
		array_push($box_list, $box);
		array_push($manual_list, $manual);
		array_push($sealed_list, $sealed);
		$num_games++;
	}
	?>

		</table>
		<?php

		//appraisal checkbox, if set call script and pass game data
		if (isset($_POST['run_appraisal'])){
			//dump_arr($query_list);
			$gameid_str = implode(' ', $gameid_list);
			$query_str = implode(' ', $query_list);
			$game_str = implode(' ', $game_list);
			$box_str = implode(' ', $box_list);
			$manual_str = implode(' ', $manual_list);
			$sealed_str = implode(' ', $sealed_list);
			$command = "/var/www/html/sh/appraise.sh '$num_games' '$gameid_str' '$query_str' '$game_str' '$box_str' '$manual_str' '$sealed_str' ";
			exec("$command > /dev/null 2>&1 &");
			//$output = shell_exec("$command 2>&1 ");
			//echo $output;
		}	

}else{
	echo "Please select a list of games from the dropdown menu.";
}
$conn->close();

//alters the title of each game that is to be passed to bash script for scraping pricecharting.com
//some titles have special characters or slightly different title from what is in db
function adjust_title($title, $region){
	//add specific title exceptions here
	$title = str_replace('\'s Pro Skater', '', $title);
	$title = str_replace(' (2002)', '', $title);
	$title = str_replace(' Version: Special Pikachu Edition', '', $title);
	$title = str_replace(': Diddy\'s Kong Quest', '', $title);
	$title = str_replace(': Dixie Kong\'s Double Trouble!', '', $title);
	$title = str_replace(': The Official Game of the Movie', '', $title);
	$title = str_replace('358/2', '3582', $title);
	$title = str_replace('Artillery Duel/Chuck Norris Superkicks', 'Artillery Duel & Chuck Norris Superkicks', $title);
	$title = str_replace('Brain Age 2: More Training in Minutes a Day!', 'Brain Age 2', $title);
	$title = str_replace('Bio F.R.E.A.K.S.', 'Biofreaks', $title);
	$title = str_replace('DuckTales', 'Duck Tales', $title);
	$title = str_replace('Eternal Darkness: Sanity\'s Requiem', 'Eternal Darkness', $title);
	$title = str_replace('GameBoy Player', 'GameBoy Player Start Up Disc', $title);
	$title = str_replace('Gold Version', 'Gold', $title);
	$title = str_replace('Hangtime', 'Hang Time', $title);
	$title = str_replace('HeartGold', 'HeartGold Version', $title);
	$title = str_replace('James Bond 007: NightFire', '007 NightFire', $title);
	$title = str_replace('John Romero\'s ', '', $title);
	$title = str_replace('Kingdom Hearts II', 'Kingdom Hearts 2', $title);
	$title = str_replace('LeafGreen', 'Leaf Green', $title);
	$title = str_replace('Paper Mario: The Thousand-Year Door', 'Paper Mario Thousand Year Door', $title);
	$title = str_replace('Pocket Monsters', 'Pokemon', $title);
	$title = str_replace('Road Rash 64', 'Road Rash', $title);
	$title = str_replace('Silkworm', 'Silk Worm', $title);
	$title = str_replace('Silver Version', 'Silver', $title);
	$title = str_replace('SoulSilver', 'SoulSilver Version', $title);
	$title = str_replace('Spider Man', 'Spiderman', $title);
	$title = str_replace('The Ancient Ship', 'Ancient Ship', $title);
	$title = str_replace('The Elder Scrolls', 'Elder Scrolls', $title);
	$title = str_replace('The Great Escape', 'Great Escape', $title);
	$title = str_replace('The Legend of Zelda', 'Zelda', $title);	
	$title = str_replace('The Legend of Kage', 'Legend of Kage', $title);	
	$title = str_replace('The Lord of the Rings: The Return of the King', 'Lord of the Rings: Return of the King', $title);
	$title = str_replace('The Wind Waker', 'Wind Waker', $title);
	$title = str_replace('TimeSplitters', 'Time-Splitters', $title);
	$title = str_replace('WarioWare, Inc.: Mega Party Game$', 'Wario Ware Mega Party Games', $title);
//	$title = str_replace('', '', $title);

	if ($region == "NTSC" && $title != "Donkey Konga 2") 
		$title = str_replace('Donkey Konga', 'Donkey Konga Game Only', $title);

	//replace special chars
	$title = str_replace(array('°', '.', ',', '!'), '', $title);
	$title = str_replace('é', 'e', $title);
	$title = str_replace('ü', 'u', $title);
	$title = str_replace("'", "%27", $title);

	//replace spaces and slashes with dashes	
	$title = str_replace(array(' ', '/'), '-', $title);

	return $title;
}

function dump_arr($arr){
	foreach ($arr as $element)
		echo $element . "<br>";
}

?>
</body>
</html>

