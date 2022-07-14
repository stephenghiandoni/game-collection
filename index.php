<html>
<head>
<?php
if(isset($_POST['opendb'])){
	header("Location:php/db_options.php");
	exit;
}
?>
<form method="post">
<input type="submit" name="opendb" class="button" value="Open Database"/>
</form>
</head>
</html>
