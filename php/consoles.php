<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>Console Entry</title>
<link rel="stylesheet" href="css/consoles.css?version=1" type="text/css">
</head>
<body>
<?php
include('def.php');
include('/var/www/sensitive.php');

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
	header("Location:$db_options");
	exit;
}
if(isset($_POST['platform_entry'])){
	platform_db_entry($conn);
	header('Location: consoles.php');
	exit();
}

$oid = array();
$onames = array();
$pid = array();
$pnames = array();
$owner_db = array(array());

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

?>

<!---------------------- 
FORM FOR CONSOLE ENTRY
---------------------->
<header><h1>Console Entry Field</h1></header>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

<label for="pname">Platform: </label>
<select name="pname_drop" id="pname">
<?php
for($i = 0; $i < count($platform_list); $i++){
	$p = "$platform_list[$i]";
	$platform_clean = "$p";//cleaner version of platform name 
	$delimiter_pos = strpos($platform_clean, '/');
	if($delimiter_pos) $platform_clean = substr($platform_clean, $delimiter_pos + 1);
	$platform_clean = str_replace(array('Console', 'System'), '', $platform_clean);
	$platform_clean = str_replace('-', ' ', $platform_clean);
	echo "<option value=$p ";
	echo (isset($_POST['pname_drop']) && $_POST['pname_drop'] == "$p") ? 'selected' : '';
	echo ">" . (($i == 0) ? "Select a Platform" : $platform_clean) . "</option>";
}
?>
</select>
<br>
<label for="owner">Owner: </label>
<select name="owner_drop" id="owner">
<?php
//fill owner drop box
for($i = 0; $i < count($oid); $i++){
	$o = "$oid[$i]";
	echo "<option value=$o ";
	echo (isset($_POST['owner_drop']) && $_POST['owner_drop'] == "$o") ? 'selected' : '';
	echo ">$onames[$i]</option>";
}
?>
</select>
<br>
<label for="region">Region: </label>
<select name="region_drop" id="region">
<?php
for($i = 0; $i < count($region_list); $i++){
	$r = "$region_list[$i]";
	echo "<option value=$r ";
	echo (isset($_POST['region_drop']) && $_POST['region_drop'] == "$o") ? 'selected' : '';
	echo ">$r</option>";
}
?>
</select>

<br>
<label for="boxed">Boxed: </label>
<input type="checkbox" id="boxed" name="boxed" value="Boxed"><br>
<input type="submit" name="platform_entry">
</form>

<?php
//enter new record into platform table from entry field
function platform_db_entry($conn){
	//gather form results 
	$pname_result = $_POST['pname_drop'];
	$owner_result = $_POST['owner_drop'];
	$region_result = $_POST['region_drop'];
	$boxed_result = 0;
	$num_result = 1;
	if(isset($_POST['boxed']))
		$boxed_result = 1;

	//check if there is already a record with same platform owner id, cib
	//increment num owned if so
	$sql = "SELECT platform_id, owner_id, name, cib, region, num_owned from Platform";
	$result = $conn->query($sql);

	if($result->num_rows > 0){
		$i = 0;
		while($row = $result->fetch_assoc()){
			//record exists in db already
			if($row["owner_id"] == $owner_result && $row["name"] == $pname_result && $row["region"] == $region_result && $row["cib"] == $boxed_result){
				$num_result = $row["num_owned"];
				$num_result++;
				delete_row($conn, $row["platform_id"]);
			}
			$i++;
		}	
	}else{
		echo "Platform table empty...";
	}
	$sql = "INSERT INTO Platform (owner_id, name, cib, region, num_owned) VALUES ('$owner_result', '$pname_result', '$boxed_result', '$region_result', '$num_result')";
	echo "<br>" . $sql . "<br>";
	if ($conn->query($sql) === TRUE){
		echo "Record inserted successfully!";
	}else{
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
}
?>
<form method="post">
<input type="submit" name="home" class="button" value="Home"/>
<input type="submit" name="back" class="button" value="Back"/>
</form>
<?php

//Delete a row from db
//pid = platform id to be deleted
function delete_row($conn, $pid){
	$sql = "Delete from Platform where platform_id = '$pid'";
	if($conn->query($sql) === TRUE){
		echo "Record deleted successfully!";
	}else{
		echo "Error deleting record...";
	}
}

//*******************************
//Display platform table*********
//*******************************
$sql = "SELECT * from Platform";
$result = $conn->query($sql);
if($result->num_rows > 0){
	?>
		<table>
		<tr>
		<th>Platform</th>
		<th>Owner ID</th>
		<th>Complete in Box</th>
		<th>Region</th>
		<th>Number Owned</th>
		<th>Value(USD)</th>
		<th>Value Date</th>
		</tr>
		<?php
		$i = 0;
	while($row = $result->fetch_assoc()){
		echo "<tr>";
		echo "<td>". $row['name'] . "</td>";
		//This will break if more owners are added**********************
		if($row['owner_id'] == 1)
			echo "<td>Stephen</td>";
		else if($row['owner_id'] == 2)
			echo "<td>Jordan</td>";
		else if($row['owner_id'] == 3)
			echo "<td>Shared</td>";
		if($row['cib'] == 1)
			echo "<td>Yes</td>";
		else
			echo "<td>No</td>";
		echo "<td>". $row["region"] . "</td>";
		echo "<td>". $row["num_owned"] .  "</td>";
		echo "<td>". "N/A" .  "</td>";
		echo "<td>". "N/A" .  "</td>";
		echo "</tr>";
	}
	?>
		</table>
		<?php
}else{
	echo "Platform table empty...";
}

$conn->close();

?>
</body>
</html>
