<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>Steve's Domain</title>
<link rel="stylesheet" href="../css/header_bar.css?version=1" type="text/css">
<link rel="stylesheet" href="css/index.css?version=1" type="text/css">
</head>
<body>
<?php
include('header_bar.php');

if(isset($_POST['opendb'])){
	header("Location:php/db_options.php");
	exit;
}
if(isset($_POST['opengarden'])){
	header("Location:php/garden.php");
	exit;
}
if(isset($_POST['openmonster'])){
	header("Location:php/monster_madness.php");
	exit;
}
if(isset($_POST['opentest'])){
	header("Location:php/test.php");
	exit;
}
?>
<div class="container" id="form_container">
<form method="post" id="main_form">
<input type="submit" name="opendb" id="game_db_btn" class="button" value="Game Collection"/><br/><br/>
<input type="submit" name="opengarden" id="garden_btn" class="button" value="The Garden of Stephen"/><br/><br/>
<input type="submit" name="openmonster" id="monster_btn" class="button" value="Shows"/><br/><br/>
<input type="submit" name="opentest" id="test_btn" class="button" value="Testing Page"/>
</form>
</div>
</body>
</html>
