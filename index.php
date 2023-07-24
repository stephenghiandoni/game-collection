<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>Steve's Domain</title>
<link rel="stylesheet" href="css/index.css?version=1" type="text/css">
</head>
<body>
<h1 id="title_header">Steve's Domain</h1>
<?php
if(isset($_POST['opendb'])){
	header("Location:php/db_options.php");
	exit;
}
if(isset($_POST['opengarden'])){
	header("Location:php/garden.php");
	exit;
}
?>
<div class="container" id="form_container">
<form method="post" id="main_form">
<input type="submit" name="opendb" id="game_db_btn" class="button" value="Game Collection"/><br/><br/>
<input type="submit" name="opengarden" id="garden_btn" class="button" value="The Garden of Stephen"/>
</form>
</div>
</body>
</html>
