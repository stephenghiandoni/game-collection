<html>
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
?>
<form method="post">
<input type="submit" name="editdb" class="button" value="Consoles"/>
<input type="submit" name="browsedb" class="button" value="Games"/>
<input type="submit" name="home" class="button" value="Home"/>
</form>

</html>
