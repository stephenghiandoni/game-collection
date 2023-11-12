<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>Database Manager</title>
<link rel="stylesheet" href="../css/index.css?version=1" type="text/css">
</head>
<body>
<h1>Make a Selection...</h1>
<?php
include('def.php');

if(isset($_POST['home'])){
	header("Location:$index");
	exit;
}
if(isset($_POST['editdb'])){
	header("Location:$consoles");
	exit;
}
if(isset($_POST['browsedb'])){
	header("Location:$games");
	exit;
}
if(isset($_POST['peripherals'])){
	header("Location:$peripherals");
	exit;
}
?>
<div class="container" id="form_container">
<form method="post">
<input type="submit" name="editdb" class="button" value="Consoles"/><br/><br/>
<input type="submit" name="browsedb" class="button" value="Games"/><br/><br/>
<input type="submit" name="peripherals" class="button" value="Peripherals"/><br/><br/>
<input type="submit" name="home" class="button" value="Home"/>
</form>
</body>
</html>
