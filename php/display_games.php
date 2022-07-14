<!DOCTYPE html>
<!-- 
Script used to display Collection DB
-->
<html>
<head>
<?php
include('def.php');
include('/var/www/sensitive.php');
$current_list = "";
$conn = new mysqli($servername, $username, $password, $dbname);   
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

/*PAGE FOR DATABASE INPUT */
if(isset($_POST['home'])){
	header("Location:$index");
	exit;
}
if(isset($_POST['back'])){
	header("Location:$games");
	exit;
}

if(isset($_POST['platform_filter'])){
	$current_list = $_POST['pname_drop'];
}

?>

</head>
<body>
<header><h1>Browse Game Collection</h1></header>
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
<input type="submit" name="platform_filter" class="button" value="Display"/>
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

$sql = "SELECT * from Games_Owned where group_id = '$current_list' ORDER BY title";
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
		$owner = $row['owner_id'];
		if($owner == 1) $owner = "Stephen";
		else if($owner == 2) $owner = "Jordan";
		else if($owner == 3) $owner = "Shared";
		$game = $row['game'];
		if($game == 1) $game = 'Y';
		else $game = 'N';
		$box = $row['box'];
		if($box == 1) $box = 'Y';
		else $box = 'N';
		$manual = $row['manual'];
		if($manual == 1) $manual = 'Y';
		else $manual = 'N';
		?>
			<tr>
			<td><?php echo $row['title']; ?></td>
			<td><?php echo $owner; ?></td>
			<td><?php echo $game; ?></td>
			<td><?php echo $box; ?></td>
			<td><?php echo $manual; ?></td>
			<td><?php echo $row['region']; ?></td>
			</tr>
			<?php
	}
	?>

		</table>
		<?php
}else{
	echo "Nothing to display...";
}

$conn->close();
?>


