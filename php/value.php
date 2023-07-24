<!DOCTYPE HTML>
<!--
Script used to appraise game collection
-->
<html>
<head>
<meta charset="UTF-8">
<title>Value Options</title>
<!--link rel="stylesheet" href="css/.css" type="text/css"-->
</head>
<body>
<?php
include('def.php');
include('/var/www/sensitive.php');
$current_list = "";
$conn = new mysqli($servername, $username, $password, $dbname);   
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

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
</body>
<header><h1>Appraise Collection</h1></header>
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
<input type="submit" name="platform_filter" class="button" value="Appraise"/>
</form>
<form method="post">
<input type="submit" name="home" class="button" value="Home"/>
<input type="submit" name="back" class="button" value="Back"/>
<br/><br/>
</form>
<?php
$conn->close();
?>
</html>

